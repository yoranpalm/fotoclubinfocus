<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('userSearch');
        $users = \App\User::where('userAvatar', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('userAchternaam', 'LIKE', "%$search%")
            ->orWhere('userVoornaam', 'LIKE', "%$search%")
            ->get();

        $fotos = \App\Foto::where('fotoTitel', 'LIKE', "%$search%")
            ->orWhere('fotoOmschrijving', 'LIKE', "%$search%")
            ->orWhere('keywords', 'LIKE', "%$search%")
            ->get();

        $fotosFromCategory = new \Illuminate\Database\Eloquent\Collection;
        $categories = \App\Categorie::where("categorieNaam", 'LIKE', "%$search%")
            ->orWhere('categorieOmschrijving', 'LIKE', "%$search%")
            ->get();
        
        foreach($categories as $categorie){
            $fotoCategories = \App\FotoCategorie::where('categorieId', '=', $categorie->id)->get();

            foreach ($fotoCategories as $foto) {
                if(!empty($foto)){
                    $fotosFromCategory = $fotosFromCategory->merge(\App\Foto::where("id", '=', $foto->fotoId)->get());
                }
            }
        }
       
        return view('pages.search')->with(["users" => $users, "fotosFromCategory" => $fotosFromCategory, "fotos" => $fotos, "value" => $search, "categorien" => $categories]);
    } 
}
