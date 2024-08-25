<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;

class CodasController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

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
                $weightedNormalizedNilai = $normalizedNilai * $kriteria->bobot;

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

        return view('codas', compact('alternatifs', 'kriterias', 'penilaians', 'normalizedData', 'nilaiNS', 'euclideanDistances', 'taxicabDistances', 'relativeAssessmentMatrix', 'assessmentScores', 'ranking'));
    }
}
