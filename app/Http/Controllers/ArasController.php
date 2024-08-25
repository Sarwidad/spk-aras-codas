<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;

class ArasController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        // Calculate the total for each criterion
        $totalKriteria = [];
        foreach ($kriterias as $kriteria) {
            $totalKriteria[$kriteria->id] = $penilaians->where('kriteria_id', $kriteria->id)->sum('nilai');
        }

        // Prepare normalized and weighted normalized values
        $normalizedData = [];
        $normalizedMinMaxValues = [];
        $weightedNormalizedMinMaxValues = [];
        $optimumValue = 0;

        foreach ($kriterias as $kriteria) {
            $values = $penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai');
            $minMaxValue = $kriteria->jenis == 'Benefit' ? $values->max() : $values->min();
            $totalAlternatif = $penilaians->where('kriteria_id', $kriteria->id)->sum('nilai');

            $normalizedMinMaxValue = 0;
            if ($totalAlternatif != 0) {
                if ($kriteria->jenis == 'Benefit') {
                    $normalizedMinMaxValue = $minMaxValue / $totalAlternatif;
                } elseif ($kriteria->jenis == 'Cost') {
                    $normalizedMinMaxValue = (1 / $minMaxValue) / $totalAlternatif;
                }
            }

            $normalizedMinMaxValues[$kriteria->id] = $normalizedMinMaxValue;

            $weightedNormalizedMinMaxValue = $normalizedMinMaxValue * $kriteria->bobot;
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

                $weightedNormalizedNilai = $normalizedNilai * $kriteria->bobot;

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

        $rank = 1; // Initial rank
        foreach ($sortedKValues as $alternatifId => $kValue) {
            $ranking[$alternatifId] = $rank;
            $rank++;
        }

        return view('aras', compact('alternatifs', 'kriterias', 'normalizedData', 'normalizedMinMaxValues', 'weightedNormalizedMinMaxValues', 'optimumValue', 'penilaians', 'sValues', 'kValues', 'ranking'));
    }
}
