<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penilaians = Penilaian::all();
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        return view('penilaian.index', compact('penilaians', 'kriterias', 'alternatifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penilaian.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alternatif_id = $request->input('alternatif_id');
        $nilai_list = $request->input('nilai');

        foreach ($nilai_list as $kriteria_id => $nilai) {
            $penilaian = new Penilaian();
            $penilaian->alternatif_id = $alternatif_id;
            $penilaian->kriteria_id = $kriteria_id;
            $penilaian->nilai = $nilai;
            $penilaian->save();
        }

        return redirect()->route('penilaian.index')->with('success', 'Penilaian created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penilaian = Penilaian::find($id);
        return view('penilaian.index', compact('penilaian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penilaian = Penilaian::find($id);
        // $kriteria = Kriteria::find($id);
        // $alternatif = Alternatif::find($id);
        $penilaians = Penilaian::all();
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();
        return view('penilaian.edit', compact('penilaian', 'kriterias', 'alternatifs', 'penilaians'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $alternatif_id = $request->input('alternatif_id');
        $nilai_list = $request->input('nilai');

        foreach ($nilai_list as $kriteria_id => $nilai) {
            $penilaian = Penilaian::where('alternatif_id', $alternatif_id)
                                ->where('kriteria_id', $kriteria_id)
                                ->first();

            if ($penilaian) {
                // Jika penilaian sudah ada, perbarui nilainya
                $penilaian->nilai = $nilai;
            } else {
                // Jika penilaian tidak ada, buat yang baru
                $penilaian = new Penilaian();
                $penilaian->alternatif_id = $alternatif_id;
                $penilaian->kriteria_id = $kriteria_id;
                $penilaian->nilai = $nilai;
            }

            $penilaian->save();
        }

        return redirect()->route('penilaian.index')->with('success', 'Penilaian updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find all Penilaian records with the given alternatif_id
        $penilaians = Penilaian::where('alternatif_id', $id)->get();

        // Delete each found Penilaian record
        foreach ($penilaians as $penilaian) {
            $penilaian->delete();
        }

        // Redirect back with a success message
        return redirect()->route('penilaian.index')->with('success', 'Penilaian records deleted successfully');
    }

}
