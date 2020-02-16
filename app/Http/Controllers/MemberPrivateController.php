<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Foto;

class MemberPrivateController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $id = Auth::user()->id;
        $user = \App\User::where('id', $id)->get();
        $fotos= \App\Foto::where("userId", "=", $id)->get();

        return view('pages.memberPrivate')->with(["user" => $user[0], "fotos" => $fotos]);
    }

    public function edit($id)
{
    $edituser= User::findOrFail($id);
    return view('pages.useredit', compact('edituser'));
}

public function update(Request $request, $id)
{
    $message = [
        "userAvatar.required" => "Schermnaam is verplicht",
        "email.required" => "E-mailadres is verplicht",
        "email.max" => "E-mailadres mag niet langer zijn dan 255 karakters",
        "userVoornaam.required" => "Voornaam is verplicht",
        "userVoornaam.max" => "Voornaam mag niet langer zijn dan 255 karakters",
        "userAchternaam.required" => "Achternaam is verplicht",
        "userAchternaam.max" => "Achternaam mag niet langer zijn dan 255 karakters",
    ];

    $validatedData = $request->validate([
        'userAvatar'  => 'required',
        'email' => 'required|max:255',
        'userVoornaam' => 'required|max:255',
        'userAchternaam' => 'required|max:255',
    ], $message);
    User::whereId($id)->update($validatedData);
    return redirect('/instellingen')->with('uploaden', 'Uw data is aangepast');
}

    public function requestData(){
        $id = Auth::user()->id;
        $user = \App\User::where('id', $id)->get();

        return view('pages.requestData')->with(["user" => $user[0]]);
    }

}
