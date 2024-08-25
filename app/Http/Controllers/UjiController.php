<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class UjiController extends Controller
{   
    public function index()
    {
        // Ambil data kriteria dari database
        $kriterias = Kriteria::all();
        
        // Membuat array bobot dari data kriteria
        $weights = $kriterias->pluck('bobot', 'nama')->toArray();
        
        // Panggil fungsi untuk menyesuaikan dan menormalisasi bobot
        $adjustedWeights = $this->adjustAndNormalizeWeights($weights);
        
        // Inisialisasi array untuk menyimpan hasil
        $arasResults = [];
        $codasResults = [];
        
        // Loop melalui setiap skenario bobot dan hitung ARAS dan CODAS
        foreach ($adjustedWeights as $scenario => $weights) {
            $arasResults[$scenario] = $this->ARAS($weights);
            $codasResults[$scenario] = $this->CODAS($weights);
        }
        
        // Initialize arrays to hold max values
        $maxAras = [];
        $maxCodas = [];
        
        // Calculate maxAras
        foreach ($arasResults as $scenario => $result) {
            if (isset($result['results'])) {
                foreach ($result['results'] as $kriteriaName => $data) {
                    if (isset($data['kValues']) && is_array($data['kValues'])) {
                        $maxAras[$scenario . '_' . $kriteriaName] = max($data['kValues']);
                    }
                }
            }
        }
        
        // Calculate maxCodas
        foreach ($codasResults as $scenario => $result) {
            if (isset($result)) {
                foreach ($result as $kriteriaName => $criteriaData) {
                    if (isset($criteriaData['assessmentScores']) && is_array($criteriaData['assessmentScores'])) {
                        $maxCodas[$scenario . '_' . $kriteriaName] = max($criteriaData['assessmentScores']);
                    }
                }
            }
        }
    
        // Calculate perubahan ARAS
        $aksesibilitasDataAras = [];
        foreach ($maxAras as $key => $value) {
            if (str_ends_with($key, 'Aksesibilitas')) {
                $aksesibilitasDataAras[] = $value;
            }
        }
    
        $perubahanAras = [];
        $countAras = count($aksesibilitasDataAras);
    
        for ($i = 0; $i < $countAras - 1; $i++) {
            $difference = $aksesibilitasDataAras[$i] - $aksesibilitasDataAras[$i + 1];
            $perubahanAras[] = $difference;
        }
        
        // Calculate total change for ARAS
        $totalPerubahanAras = array_sum($perubahanAras);
    
        // Calculate perubahan CODAS
        $aksesibilitasDataCodas = [];
        foreach ($maxCodas as $key => $value) {
            if (str_ends_with($key, 'Aksesibilitas')) {
                $aksesibilitasDataCodas[] = $value;
            }
        }
    
        $perubahanCodas = [];
        $countCodas = count($aksesibilitasDataCodas);
    
        for ($i = 0; $i < $countCodas - 1; $i++) {
            $difference = $aksesibilitasDataCodas[$i] - $aksesibilitasDataCodas[$i + 1];
            $perubahanCodas[] = $difference;
        }
    
        // Calculate total change for CODAS
        $totalPerubahanCodas = array_sum($perubahanCodas);
        
        // dd($perubahanAras, $perubahanCodas, $totalPerubahanAras, $totalPerubahanCodas);
        
        // Return hasil ke view 'uji'
        return view('uji', compact('adjustedWeights', 'kriterias', 'arasResults', 'codasResults', 'maxAras', 'maxCodas', 'perubahanAras', 'perubahanCodas', 'totalPerubahanAras', 'totalPerubahanCodas'));
    }
      
    public function adjustAndNormalizeWeights($weights)
    {
        $results = [];
        $totalWeights = array_sum($weights);

        // Simpan bobot asli
        $results['original'] = $this->normalizeWeights($weights, $totalWeights);

        // Loop melalui setiap kriteria untuk menambahkan 0.5 dan 1 secara bergantian
        foreach ($weights as $index => $weight) {
            // Tambah 0.5 pada bobot saat ini
            $modifiedWeights = $weights;
            $modifiedWeights[$index] += 0.5;
            $results["kriteria_{$index}_0_5"] = $this->normalizeWeights($modifiedWeights, array_sum($modifiedWeights));

            // Tambah 1 pada bobot saat ini
            $modifiedWeights = $weights;
            $modifiedWeights[$index] += 1;
            $results["kriteria_{$index}_1"] = $this->normalizeWeights($modifiedWeights, array_sum($modifiedWeights));
        }

        return $results;
    }

    private function normalizeWeights($weights, $total)
    {
        return array_map(function($weight) use ($total) {
            return $weight / $total;
        }, $weights);
    }
    
    public function ARAS($adjustedWeights)
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();
        
        $totalKriteria = [];
        foreach ($kriterias as $kriteria) {
            $totalKriteria[$kriteria->id] = $penilaians->where('kriteria_id', $kriteria->id)->sum('nilai');
        }
    
        $results = [];
    
        foreach ($adjustedWeights as $weightKey => $weights) {
            $normalizedMinMaxValues = [];
            $weightedNormalizedMinMaxValues = [];
            $optimumValue = 0;
    
            foreach ($kriterias as $kriteria) {
                $values = $penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai');
                $minMaxValue = $kriteria->jenis == 'Benefit' ? $values->max() : $values->min();
                $totalAlternatif = $totalKriteria[$kriteria->id];
    
                $normalizedMinMaxValue = 0;
                if ($totalAlternatif != 0) {
                    if ($kriteria->jenis == 'Benefit') {
                        $normalizedMinMaxValue = $minMaxValue / $totalAlternatif;
                    } elseif ($kriteria->jenis == 'Cost') {
                        $normalizedMinMaxValue = (1 / $minMaxValue) / $totalAlternatif;
                    }
                }
    
                $normalizedMinMaxValues[$kriteria->id] = $normalizedMinMaxValue;
    
                // Updated section: Calculate weighted normalized min/max values
                if (is_array($adjustedWeights) && isset($adjustedWeights[$kriteria->nama])) {
                    $weightedNormalizedMinMaxValue = $normalizedMinMaxValue * $adjustedWeights[$kriteria->nama];
                } else {
                    $weightedNormalizedMinMaxValue = 1; // Handle missing or incorrect weights
                }

                $weightedNormalizedMinMaxValues[$kriteria->id] = $weightedNormalizedMinMaxValue;
                $optimumValue += $weightedNormalizedMinMaxValue;
            }
    
            // Calculate S values
            $sValues = [];
            foreach ($alternatifs as $alternatif) {
                $sValue = 0;
                foreach ($kriterias as $kriteria) {
                    $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                    $nilai = $penilaian ? $penilaian->nilai : 0;
                    $total = $totalKriteria[$kriteria->id];
    
                    $normalizedNilai = 0;
                    if ($total != 0) {
                        if ($kriteria->jenis == 'Benefit') {
                            $normalizedNilai = $nilai / $total;
                        } elseif ($kriteria->jenis == 'Cost') {
                            $normalizedNilai = (1 / $nilai) / $total;
                        }
                    }
    
                    if (is_array($adjustedWeights) && isset($adjustedWeights[$kriteria->nama])) {
                        $weightedNormalizedNilai = $normalizedNilai * $adjustedWeights[$kriteria->nama];
                    } elseif (is_numeric($adjustedWeights)) {
                        // Menggunakan is_numeric untuk menangani baik float maupun integer
                        $weightedNormalizedNilai = $normalizedNilai * $adjustedWeights;
                    } else {
                        $weightedNormalizedNilai = 1; // Menangani bobot yang hilang atau tidak sesuai
                    }                    
    
                    $normalizedData[$alternatif->id][$kriteria->id] = [
                        'normalized' => $normalizedNilai,
                        'weighted_normalized' => $weightedNormalizedNilai,
                    ];
    
                    $sValue += $weightedNormalizedNilai;
                }
                $sValues[$alternatif->id] = $sValue;
            }
    
            // Calculate K values
            $kValues = [];
            foreach ($alternatifs as $alternatif) {
                $kValue = $sValues[$alternatif->id] / $optimumValue;
                $kValues[$alternatif->id] = $kValue;
            }
    
            // Ranking
            $ranking = [];
            $sortedKValues = $kValues;
            arsort($sortedKValues); // Sort K values in descending order
    
            $rank = 1;
            foreach ($sortedKValues as $alternatifId => $kValue) {
                $ranking[$alternatifId] = $rank;
                $rank++;
            }
    
            // Store results for this weight scenario
            $results[$weightKey] = [
                'normalizedData' => $normalizedData,
                'normalizedMinMaxValues' => $normalizedMinMaxValues,
                'weightedNormalizedMinMaxValues' => $weightedNormalizedMinMaxValues,
                'optimumValue' => $optimumValue,
                'sValues' => $sValues,
                'kValues' => $kValues,
                'ranking' => $ranking,
            ];
        }
        // Pass results to the view
        return view('aras', compact('alternatifs', 'kriterias', 'penilaians', 'results'));
    }
    
    public function CODAS($adjustedWeights)
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();
    
        $results = [];
    
        // Loop untuk setiap set bobot yang disesuaikan
        foreach ($adjustedWeights as $weightSetName => $weights) {
            // Calculate normalized data
            $normalizedData = [];
            $weightedNormalizedData = []; // To store all weighted normalized values
    
            foreach ($alternatifs as $alternatif) {
                foreach ($kriterias as $kriteria) {
                    $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                    $nilai = $penilaian ? $penilaian->nilai : 0;
                    $minMax = $kriteria->jenis == 'Benefit' ? $penilaians->where('kriteria_id', $kriteria->id)->max('nilai') : $penilaians->where('kriteria_id', $kriteria->id)->min('nilai');
                    $total = $penilaians->where('kriteria_id', $kriteria->id)->sum('nilai');
    
                    // Calculate normalized value
                    $normalizedNilai = 0;
                    if ($total != 0) {
                        if ($kriteria->jenis == 'Benefit') {
                            $normalizedNilai = $nilai / $minMax;
                        } elseif ($kriteria->jenis == 'Cost') {
                            $normalizedNilai = $minMax / $nilai;
                        }
                    }
    
                    // Calculate weighted normalized value
                    if (is_array($adjustedWeights) && isset($adjustedWeights[$kriteria->nama])) {
                        $weightedNormalizedNilai = $normalizedNilai * $adjustedWeights[$kriteria->nama];
                    } elseif (is_numeric($adjustedWeights)) {
                        // Menggunakan is_numeric untuk menangani baik float maupun integer
                        $weightedNormalizedNilai = $normalizedNilai * $adjustedWeights;
                    } else {
                        $weightedNormalizedNilai = 1; // Menangani bobot yang hilang atau tidak sesuai
                    }                    
    
                    // Store normalized and weighted normalized values in data structure
                    $normalizedData[$alternatif->id][$kriteria->id] = [
                        'normalized' => $normalizedNilai,
                        'weighted_normalized' => $weightedNormalizedNilai,
                    ];
    
                    // Store weighted normalized value in an array for each kriteria
                    $weightedNormalizedData[$kriteria->id][] = $weightedNormalizedNilai;
                }
            }
    
            // Calculate the minimum weighted normalized value for each kriteria
            $nilaiNS = [];
            foreach ($kriterias as $kriteria) {
                $nilaiNS[$kriteria->id] = min($weightedNormalizedData[$kriteria->id]);
            }
    
            // Calculate Euclidean and Taxicab distances for each alternatif
            $euclideanDistances = [];
            $taxicabDistances = [];
    
            foreach ($alternatifs as $alternatif) {
                $euclideanSum = 0;
                $taxicabSum = 0;
    
                foreach ($kriterias as $kriteria) {
                    $weightedNormalizedNilai = $normalizedData[$alternatif->id][$kriteria->id]['weighted_normalized'];
                    $difference = $weightedNormalizedNilai - $nilaiNS[$kriteria->id];
                    $euclideanSum += pow($difference, 2);
                    $taxicabSum += abs($difference);
                }
    
                // Store Euclidean and Taxicab distances for each alternatif
                $euclideanDistances[$alternatif->id] = sqrt($euclideanSum);
                $taxicabDistances[$alternatif->id] = $taxicabSum;
            }
    
            // Calculate Relative Assessment Matrix
            $psi = 0.01;
            $relativeAssessmentMatrix = [];
            $assessmentScores = []; // To store the assessment scores for each alternatif
    
            foreach ($alternatifs as $alternatif_i) {
                $relativeAssessmentMatrix[$alternatif_i->id] = [];
                $assessmentScores[$alternatif_i->id] = 0;
    
                foreach ($alternatifs as $alternatif_k) {
                    if ($alternatif_i->id == $alternatif_k->id) {
                        $relativeAssessmentMatrix[$alternatif_i->id][$alternatif_k->id] = 0;
                        continue;
                    }
    
                    $E_i = $euclideanDistances[$alternatif_i->id];
                    $E_k = $euclideanDistances[$alternatif_k->id];
                    $T_i = $taxicabDistances[$alternatif_i->id];
                    $T_k = $taxicabDistances[$alternatif_k->id];
    
                    $h_ik = ($E_i - $E_k) + ($psi * ($E_i - $E_k) * ($T_i - $T_k));
    
                    // Store the h_ik value for the current pair of alternatives
                    $relativeAssessmentMatrix[$alternatif_i->id][$alternatif_k->id] = $h_ik;
    
                    // Sum up the h_ik values for the assessment score
                    $assessmentScores[$alternatif_i->id] += $h_ik;
                }
            }
    
            // Ranking
            $ranking = [];
            $sortedAssessmentScores = $assessmentScores;
            arsort($sortedAssessmentScores); // Sort assessment scores in descending order
    
            $rank = 1; // Initial rank
            foreach ($sortedAssessmentScores as $alternatifId => $assessmentScore) {
                $ranking[$alternatifId] = $rank;
                $rank++;
            }
    
            // Store the results for the current weight set
            $results[$weightSetName] = [
                'normalizedData' => $normalizedData,
                'nilaiNS' => $nilaiNS,
                'euclideanDistances' => $euclideanDistances,
                'taxicabDistances' => $taxicabDistances,
                'relativeAssessmentMatrix' => $relativeAssessmentMatrix,
                'assessmentScores' => $assessmentScores,
                'ranking' => $ranking,
            ];
        }
    
        // Return results for all weight sets
        return $results;
    }      
       
}
