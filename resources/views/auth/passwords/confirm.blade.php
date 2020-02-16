@extends('layouts.continuation')

@section('title', 'Wachtwoord veranderen')

@section('content')
<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div class="field">
        <label class="label">{{ __('Bevestig wachtwoord') }}</label>
        <input class="input is-rounded" type="password" name="wachtwoord" id="wachtwoord" placeholder="Bevestig hier uw wachtwoord"autofocus>
    </div>

    <div class="field is-grouped">
        <div class="control">
        <input class="button is-success is-rounded button-green" type="submit" value="{{ __('Wachtwoord bevestigen') }}"/>
        </div>
        <div class="control">
        <button class="button is-success is-light is-rounded" onclick="window.location.href = '/';">Annuleren</button>
        </div>
    </div>

@endsection
