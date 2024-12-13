<?php

namespace App\Http\Controllers;

use App\Models\letter;
use App\Http\Requests\StoreletterRequest;
use App\Http\Requests\UpdateletterRequest;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreletterRequest $request)
    {
        $request->validated();

        $mail = letter::create([
            'mail' => $request->mail
        ]);


        // Redirection vers la même page avec un message de succès
        return redirect()->back()->with('success', 'Inscription effectuée avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(letter $letter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(letter $letter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateletterRequest $request, letter $letter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(letter $letter)
    {
        //
    }
}
