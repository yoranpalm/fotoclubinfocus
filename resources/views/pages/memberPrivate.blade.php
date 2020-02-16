@extends('layouts.member')

@section('title', 'Instellingen')

@section('profile-info')

@if(session("uploaden"))
    <div>
        <p><strong class="has-text-success">{{ session("uploaden") }}</strong></p>
    </div>
    <hr/>
@endif

<div class="columns is-centered">
    <div class="column is-8" data-aos="fade-up">
        <!-- overzicht gebruikers posts, compactere stijl als openbaar profiel-->
         @foreach ($fotos as $foto)
        <div id="upload" class="column is-3 has-text-centered" data-aos="fade-up">
            <a href="/foto/{{ $foto->id }}">
            <h3 style="display:unset;">{{ $foto->fotoTitel }}</h3><br/>
            <h4 style="display:unset;">{{ $foto->created_at }}</h4>
            </a>
            @if($foto->epRating == 1)
                <span class="tag is-danger is-light" data-aos="fade-up">
                    21+
                </span>
            @endif
        </div>
        @endforeach
    </div>
    <div class="column is-one-quarter" data-aos="fade-up">

    </div>
    <div class="column is-one-quarter" data-aos="fade-up">
        <!-- overzicht persoonsdata van de gebruiker-->
        <h2>persoons gegevens</h2>
        <div><h4>Voornaam:</h4> <p>{{$user->userVoornaam}}</p></div>
        <div><h4>Achternaam:</h4> <p>{{$user->userAchternaam}}</p></div>
        <div><h4>Gebruikersnaam:</h4> <p>{{$user->userAvatar}}</p></div>
        <div><h4>E-mailadres:</h4> <p>{{$user->email}}</p></div>

        <br/><a href="/instellingen/{{ $user->id }}" class="btn btn-primary">Edit</a><br>
        <a href="{{ route('password.request') }}">Wachtwoord wijzigen?</a><br/><br/>
        <a href="/instellingen/{{$user->id}}/request">Opgeslagen data opvragen</a>
    </div>
</div>
@endsection
