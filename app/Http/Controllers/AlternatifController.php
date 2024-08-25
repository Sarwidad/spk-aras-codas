<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alternatifs = Alternatif::all();
        return view('alternatif.index', compact('alternatifs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alternatif.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $alternatif = new Alternatif();
        $alternatif->nama = $request->input('nama');
        $alternatif->save();

        return redirect()->route('alternatif.index')->with('success', 'Alternatif created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $alternatif = Alternatif::find($id);
        return view('alternatif.index', compact('alternatif'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $alternatif = Alternatif::find($id);
        return view('alternatif.edit', compact('alternatif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::find($id);
        $alternatif->nama = $request->input('nama');
        $alternatif->save();

        return redirect()->route('alternatif.index')->with('success', 'Alternatif updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alternatif = Alternatif::find($id);
        $alternatif->delete();
        return redirect()->route('alternatif.index')->with('success', 'Alternatif deleted successfully');
    }
}
