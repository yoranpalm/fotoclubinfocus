<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MemberOpenController extends Controller
{
    public function index($id){

        $recensies = \App\Recensie::where("userId", "=", "$id")->get();
        $user = \App\User::where('id', $id)->get();
        if(!\Auth::id() || date_diff(date_create(\Auth::user()->birthdate), date_create('today'))->y < 21){
            $fotos = \App\Foto::where([
                ["epRating", "=", 0],
                ["userId", "=", $id]
            ])->get();

            foreach ($recensies as $key => $recensie) {
                $delete = true;

                foreach ($fotos as $foto){
                    if($foto->id === $recensie->fotoId){
                        $delete = false;
                    }
                }

                if($delete){
                    $recensies->forget($key);
                }
            }

        } else {
            $fotos = \App\Foto::where("userId", "=", $id)->get();
        }

        return view('pages.memberOpen')->with(["user" => $user[0], "fotos" => $fotos, "recensies" => $recensies]);
    }
}
