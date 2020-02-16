@extends('layouts.continuation')

@section('title', 'Inloggen')

@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf

  <div class="field">
    @error('email')
      <div>
        <p><strong class="has-text-danger">{{ $message }}</strong></p>
      </div>
    @enderror

    <label class="label">{{ __('E-mailadres') }}</label>
    <div class="control has-icons-left">
      <span class="icon is-small is-left">
        <i class="fas fa-at"></i>
      </span>
      <input class="input is-rounded @error('email') is-danger @enderror" type="email" name="email" id="email" placeholder="Vul hier je e-mailadres in" value="{{ old('email') }}" required autocomplete="email" autofocus>
    </div>
  </div>

  <div class="field">
    <label class="label">{{ __('Wachtwoord') }}</label>
    <div class="control has-icons-left">
      <span class="icon is-small is-left">
        <i class="fas fa-lock"></i>
      </span>
      <input class="input is-rounded @error('password') is-danger @enderror" type="password" name="password" id="password" placeholder="Vul hier je wachtwoord in" required>
    </div>
  </div>

  @if (Route::has('password.request'))
    <a href="{{ route('password.request') }}">
      {{ __('Wachtwoord vergeten?') }}
    </a>
  @endif

  <br/><br/>

  <div class="field is-grouped">
    <div class="control">
      <input class="button is-success is-rounded button-green" type="submit" value="{{ __('Inloggen') }}"/>
    </div>
    <div class="control">
      <button class="button is-success is-light is-rounded" onclick="window.location.href = '/';">Annuleren</button>
    </div>
  </div>
</form>

<br/>

<div>
  <a href="/register">Nog geen lid? Maak dan nu een account aan</a>
</div>
@endsection
