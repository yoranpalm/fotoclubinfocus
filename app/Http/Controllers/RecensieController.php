<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Recensie;
use App\Foto;
use Illuminate\Http\Request;

class RecensieController extends Controller
{
    public function index()
    {
        $recensies = \App\Recensie::all();

        return view ('pages.foto')->with(["recensies" => $recensies]);
    }

    public function create()
    {
        return view('pages.newRecensieForm');     
    }

    public function store(Request $request)
    {
        $errors = [];

        $recensie = new \App\Recensie();
        $recensie->fotoId = $request->input('fotoId');
        if($request->input("rating")){
            $recensie->starRating = $request->input('rating');
        } else {
            $errors["rating"] = ["Rating is veplicht"];
        }
        if(\Auth::id()){
            $recensie->userId = \Auth::id();
            if($request->input("recensieText")){
                $recensie->recensieTekst = $request->input('recensieText');
            }
        } else {
            $recensie->userId = 1;
        }

        try {
            $recensie->saveOrFail();
        } catch (\Illuminate\Database\QueryException $exception) {
            return back()->withErrors($errors)->withInput();
        }

        return back()->with("upload", "Recensie succesvol geplaatst");
    }

    public function show(Recensie $recensie, Foto $foto)
    {
        //
    }

    public function edit(Recensie $recensie)
    {
        //
    }

    public function update(Request $request, Recensie $recensie)
    {
        //
    }

    public function destroy(Recensie $recensie)
    {
        //
    }
}