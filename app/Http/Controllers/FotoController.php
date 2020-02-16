<?php

namespace App\Http\Controllers;

use App\Foto;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FotoController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth')->except(['index', 'home', 'show']);
        $this->middleware("UAC");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!\Auth::id() || date_diff(date_create(\Auth::user()->birthdate), date_create('today'))->y < 21){
            $fotos = \App\Foto::where("epRating", "=", 0)->get();
        } else {
            $fotos = \App\Foto::all();
        }

        return view('pages.foto')->with(["fotos" => $fotos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorien = \App\Categorie::all();
        $cameras = \App\Camera::all();
        return view('pages.users.newFotoForm')->with(["cameras" => $cameras, "categorien" => $categorien]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $errors = [];

        if($request->file('file')){
            $path = Storage::putFileAs("public/" . \Auth::id(), $request->file('file'), date("YmdHis") . \Auth::id() . '.' . $request->file('file')->extension());
        } else {
            $errors["file"] = ["foto is verplicht"];
        }

        $newFoto = new \App\Foto();
        if($request->input("cameraId")){
            $newFoto->cameraId = $request->input('cameraId');
        } else {
            $errors["camera"] = ["camera is verplicht"];

        }
        $newFoto->userId = \Auth::id();
        if(isset($path)){
            $newFoto->fotoFileName = $path;
        }
        $newFoto->fotoTitel = $request->input('fotoTitel');
        $newFoto->fotoOmschrijving = $request->input('fotoOmschrijving');
        $newFoto->fotoBeheerderblock = false;
        //verander dit later naar een input van de custom form handler, en check of het een valid array van keywords is
        $newFoto->keywords = $request->input('keywordsJSON');

        if($request->input('epRating') === "off"){
            $newFoto->epRating = false;
        }

        try {
            $newFoto->saveOrFail();
        } catch (\Illuminate\Database\QueryException $exception) {
            if(empty($newFoto->fotoTitel)){
                $errors["titel"] = ["Titel is verplicht"];
                
            }
        }

        if($request->input("fotoCategorien")){
            foreach($request->input('fotoCategorien') as $categorie) {
                $newFotoCategorie = new \App\FotoCategorie();
                $newFotoCategorie->fotoId = $newFoto->id;
                $newFotoCategorie->categorieId = $categorie;
                $newFotoCategorie->save();
            }
        } else {
            $errors["categorie"] = ["Categorie is verplicht"];

        }

        if(empty($errors)){
            return redirect("/foto/$newFoto->id")->with("uploaden", "Foto is aangemaakt");
        } else {
            return back()->withErrors($errors)->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Foto $foto, User $user)
    {
        $fotoCategorien = \App\FotoCategorie::where('fotoId', $foto->id)->get();
        $recensies = DB::table('recensies')->where('fotoId', '=', $foto->id)->get();

        return view('pages.photoDetail')->with(['foto' => $foto, 'fotoCategorien' => $fotoCategorien, 'recensies' => $recensies]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function edit(Foto $foto)
    {
        $fotoCategorien = \App\FotoCategorie::where('fotoId', $foto->id)->get();
        $categorien = \App\Categorie::all();
        $cameras = \App\Camera::all();
        return view('pages.users.newFotoForm')->with(['foto' => $foto, 'fotoCategorien' => $fotoCategorien, 'cameras' => $cameras, 'categorien' => $categorien]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Foto $foto)
    {
        if(!empty($request->file('file'))){
            $foto->cameraId = $request->input('cameraId');
        }
        if(!empty($request->file('file'))){
            Storage::delete($foto->fotoFileName);
            $foto->fotoFileName = Storage::putFileAs("public/" . \Auth::id(), $request->file('file'), date("YmdHis") . \Auth::id() . '.' . $request->file('file')->extension());
        }
        if(!empty($request->input('fotoTitel'))){
            $foto->fotoTitel = $request->input('fotoTitel');
        }
        if(!empty($request->input('fotoOmschrijving'))){
            $foto->fotoOmschrijving = $request->input('fotoOmschrijving');
        }
        // als beheerders geimplementeerd zijn, dan ervoor zorgen dat dit niet automatisch false is maar naar de keuze van de beheerder
        $foto->fotoBeheerderblock = false;

        // zorg voor keyword update logica die ook check of er een valid array van keywords is gegeven
        if(!empty($request->input("keywordsJSON"))){
            $foto->keywords = $request->input('keywordsJSON');
        } else {
            $foto->keywords = "";
        }

        if($request->input('epRating') === "off"){
            $foto->epRating = false;
        } else if ($request->input("epRating") === "on") {
            $foto->epRating = true;
        }

        $foto->update();

        if(!empty($request->input('fotoCategorien'))){
            $fotoCategorien = \App\FotoCategorie::where('fotoId', $foto->id)->get();

            foreach ($fotoCategorien as $categorie) {
                $delete = true;
                foreach ($request->input('fotoCategorien') as $newCategorie) {
                    if($categorie->id === $newCategorie) {
                        $delete = false;
                    }
                }
                if($delete){
                    DB::table('foto_categorie')->where([
                        ['fotoId', '=', $categorie->fotoId],
                        ['categorieId', '=', $categorie->categorieId]
                    ])->delete();
                }
            }

            foreach ($request->input('fotoCategorien') as $newCategorie) {
                $create = true;
                foreach ($fotoCategorien as $categorie) {
                    if($categorie->id === $newCategorie){
                        $create = false;
                    }
                }
                if($create) {
                    $newFotoCategorie = new \App\FotoCategorie();
                    $newFotoCategorie->fotoId = $foto->id;
                    $newFotoCategorie->categorieId = $newCategorie;
                    $newFotoCategorie->save();
                }
            }
        }


        return redirect("/foto/$foto->id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foto $foto)
    {
        Storage::delete($foto->fotoFileName);
        DB::table('foto_categorie')->where('fotoId', '=', $foto->id)->delete();
        DB::table('recensies')->where('fotoId', '=', $foto->id)->delete();
        $foto->delete();
        return redirect('/')->with("upload", "Foto is verwijderd");
    }

    public function home()
    {
        if(!\Auth::id() || date_diff(date_create(\Auth::user()->birthdate), date_create('today'))->y < 21){
            $fotos = \App\Foto::where("epRating", "=", 0)->get();
        } else {
            $fotos = \App\Foto::all();
        }
        
        return view('pages.home')->with(["fotos" => $fotos]);
    }
}
