<?php

namespace App\Http\Controllers;

use App\Models\banieres;
use App\Http\Requests\StorebanieresRequest;
use App\Http\Requests\UpdatebanieresRequest;

class BanieresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banieres = banieres::all();
        return view('admin.banieres.index', compact('banieres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banieres.creat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebanieresRequest $request)
    {
        $request->validated();

        $baniere = new banieres();
        $baniere->lien1 = $request->lien1;
        if ($request->hasFile('image1')) {
            $baniere->image1 = $request->file('image1')->store('images', 'public');
        }
        $baniere->lien2 = $request->lien2;
        if ($request->hasFile('image2')) {
            $baniere->image2 = $request->file('image2')->store('images', 'public');
        }
        $baniere->lien3 = $request->lien3;
        if ($request->hasFile('image3')) {
            $baniere->image3 = $request->file('image3')->store('images', 'public');
        }
        $baniere->save();

        return redirect()->route('Banière.index')->with('success', 'Bannière créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(banieres $banieres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $banieres = banieres::find($id);
        return view('admin.banieres.edit', compact('banieres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebanieresRequest $request,  $id)
    {
        $banieres = banieres::find($id);

        $request->validated();

        $banieres->lien1 = $request->lien1;
        if ($request->hasFile('image1')) {
            $banieres->image1 = $request->file('image1')->store('images', 'public');
        }
        $banieres->lien2 = $request->lien2;
        if ($request->hasFile('image2')) {
            $banieres->image2 = $request->file('image2')->store('images', 'public');
        }
        $banieres->lien3 = $request->lien3;
        if ($request->hasFile('image3')) {
            $banieres->image3 = $request->file('image3')->store('images', 'public');
        }
        $banieres->save();

        return redirect()->route('Banière.index')->with('success', 'Bannière mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(banieres $banieres)
    {
        $banieres->delete();
        return redirect()->route('Banière.index')->with('success', 'Bannière supprimée avec succès.');
    }
}