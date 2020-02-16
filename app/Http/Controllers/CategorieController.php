<?php

namespace App\Http\Controllers;

use App\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is.admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorien = \App\Categorie::all();
        return view('pages.home')->with(["categorien" => $categorien]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.newCategorieForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $message = [
            "categorieNaam.required" => "Naam van categorie is verplicht",
            "categorieNaam.max" => "Naam van categorie mag niet langer zijn dan 30 karakters",
            "categorieOmschrijving.max" => "Naam van categorie mag niet langer zijn dan 255 karakters"
        ];

        $data = request()->validate([
            'categorieNaam' => ['required', 'string', 'max:30'],
            'categorieOmschrijving' => ['max:255']
        ], $message);

        Categorie::create($data);
        return redirect('/admin')->With("upload", "Categorie is aangemaakt");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        return view('pages.admin')->with(['categorie' => $categorie]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        return view('pages.admin.newCategorieForm')->with(['categorie' => $categorie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        $data = request()->validate([
            'categorieNaam' => ['required', 'string', 'max:30'],
            'categorieOmschrijving' => ['string', 'max:255']
        ]);
            
        $categorie->update($data);
        return redirect('/admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();
        return redirect('/admin');
    }
}
