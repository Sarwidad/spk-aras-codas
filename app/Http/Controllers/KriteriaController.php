<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('kriteria.index', compact('kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kriteria = new Kriteria();
        $kriteria->nama = $request->input('nama');
        $kriteria->bobot = $request->input('bobot');
        $kriteria->jenis = $request->input('jenis');
        $kriteria->save();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kriteria = Kriteria::find($id);
        return view('kriteria.index', compact('kriteria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kriteria = Kriteria::find($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->nama = $request->input('nama');
        $kriteria->bobot = $request->input('bobot');
        $kriteria->jenis = $request->input('jenis');
        $kriteria->save();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria deleted successfully');
    }
}
