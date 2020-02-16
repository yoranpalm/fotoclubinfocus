<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $message = [
            "name.required" => "Schermnaam is verplicht",
            "name.max" => "Schermnaam mag niet langer zijn dan 255 karakters",
            "password.required" => "Wachtwoord is verplicht",
            "password.min" => "Wachtwoord moet minimaal 8 karakters lang zijn",
            "voornaam.required" => "Voornaam is verplicht",
            "achternaam.required" => "Achternaam is verplicht",
            "birthdate.required" => "Geboortedatum is verplicht",
            "email.required" => "E-mail is verplicht",
            "email.max" => "E-mail mag niet langer zijn dan 255 karakters",
            "email.unique" => "Er bestaat al een lid met dit e-mailadres",
            "password.confirmed" => "Wachtwoord komt niet overeen"
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'voornaam' => ['required', 'string'],
            'achternaam' => ['required', 'string'],
            'birthdate' => ['required', 'date']
        ], $message);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'userAvatar' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'userVoornaam' => $data['voornaam'],
            'userAchternaam' => $data['achternaam'],
            'birthdate' => $data['birthdate']
        ]);
    }
}
