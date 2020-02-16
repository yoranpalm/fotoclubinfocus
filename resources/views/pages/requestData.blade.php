@extends('layouts.member')

@section('title', 'Requested Data')

@section('profile-info')
    <div><h4>AvatarNaam: </h4>{{$user->userAvatar}}</div>
    <div><h4>Email: </h4>{{$user->email}}</div>
    <div><h4>Wachtwoord: </h4>{{$user->password}}</div>
    <div><h4>Voornaam: </h4>{{$user->userVoornaam}}</div>
    <div><h4>Achternaam: </h4>{{$user->userAchternaam}}</div>
    <div><h4>Akkoord: </h4>{{$user->beheerderAkkoord}}</div>
    <div><h4>blokkeer status: </h4>{{$user->blokkeerStatus}}</div>
    <div><h4>Beheerder status: </h4>{{$user->beheerderStatus}}</div>
    <div><h4>geboortedatum: </h4>{{$user->birthdate}}</div>
    <div><h4>account creatie: </h4>{{$user->created_at}}</div>
    <div><h4>account geupdate: </h4>{{$user->updated_at}}</div>
@endsection
