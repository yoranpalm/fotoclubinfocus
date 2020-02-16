@extends('layouts.continuation')

@section('title', 'Wachtwoord vergeten')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="field">
        @error('email')
        <div>
            <p><strong class="has-text-danger">{{ $message }}</strong></p>
        </div>
        <hr/>
        @enderror
        
        <label class="label">{{ __('E-mailadres') }}</label>
        <div class="control has-icons-left">
        <span class="icon is-small is-left">
            <i class="fas fa-at"></i>
        </span>
        <input class="input is-rounded @error('email') is-danger @enderror" type="email" name="email" id="email" placeholder="Vul hier je e-mailadres in" value="{{ old('email') }}" required autocomplete="email" autofocus>
        </div>
    </div>

    <br/>

    <div class="field is-grouped">
        <div class="control">
        <input class="button is-success is-rounded button-green" type="submit" value="{{ __('Stuur nieuw wachtwoord') }}"/>
        </div>
        <div class="control">
        <button class="button is-success is-light is-rounded" onclick="window.location.href = '/';">Annuleren</button>
        </div>
    </div>
</form>
@endsection

