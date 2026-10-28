<?php

namespace App\Http\Controllers;

use App\Mail\BienContactMail;
use App\Models\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        confirmDelete('Supprimer cette option ?', 'Cette action est irreversible.');

        return view('options.CreateOption', ['options' => Option::all()]);
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('options.create', ['success' => 'L\'option a été ajoutée avec succès !']);
    }




    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',

        ]);

        $option = Option::create($validatedData);

        return redirect('options')->with('success', 'L\'option a été ajoutée avec succès !');
    }




    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        $option = Option::query()->where('id', $option->id)->first();


        return view('options.showoption', ['option' => $option]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        return view('options.editoption', ['option' => $option]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',

        ]);

        $option->update($validatedData);



        return redirect()->route('options.index')->with('success', 'L\'option a été mise à jour avec succès !');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return redirect()->route('options.index')->with('success', 'L\'option a été supprimée avec succès !');
    }


}
