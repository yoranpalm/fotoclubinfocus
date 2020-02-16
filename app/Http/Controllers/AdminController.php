<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('is.admin');
    }
    
    public function index()
    {
        $users = \App\User::all();
        $categorien = \App\Categorie::all();
        return view('pages.admin')->with(["users" => $users, "categorien" => $categorien]);
    }

    public function update(Request $request, User $user) 
    {
        $user->beheerderAkkoord = 1;
        
        if($request->input('makeAdmin')) {
            $user->beheerderStatus = 1;
        }

        if($request->input('deleteAdmin')) {
            $admins = \App\User::where("beheerderStatus", "=", 1);

            if($admins->count() < 2){
                return back()->withErrors(["nea" => ["Er moeten minimaal twee administratoren zijn"]]);
            } else {
                $user->beheerderStatus = 0;
            }
        }

        if($request->input('blockUser')) {
            $user->blokkeerStatus = 1;
        }

        if($request->input('deblockUser')) {
            $user->blokkeerStatus = 0;
        }

        $user->update();

        return redirect('/admin');
    }

    public function delete(Request $request, User $user) 
    {
        $user->delete();

        return redirect('/admin');
    }
}
