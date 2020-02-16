@extends('layouts.continuation')

@section('title', 'Registreren')

@section('content')
<form method="POST" action="{{ route('register') }}">
  @csrf

  @error('name')
    <div>
      <p><strong class="has-text-danger">{{ $message }}</strong></p>
    </div>
  @enderror

  <div class="field">
    <label class="label">{{ __('Schermnaam') }}</label>
    <div class="control has-icons-left">
      <span class="icon is-small is-left">
        <i class="fas fa-user"></i>
      </span>
      <input class="input is-rounded @error('name') is-danger @enderror" type="text" name="name" id="name" placeholder="Vul hier je schermnaam in">
    </div>
  </div>

  @error('voornaam')
    <div>
      <p><strong class="has-text-danger">{{ $message }}</strong></p>
    </div>
  @enderror

  <div class="field">
    <label class="label">{{ __('Voornaam') }}</label>
    <div class="control has-icons-left">
      <span class="icon is-small is-left">
        <i class="fas fa-user"></i>
      </span>
      <input class="input is-rounded @error('voornaam') is-danger @enderror" type="text" name="voornaam" id="voornaam" placeholder="Vul hier je voornaam in">
    </div>
  </div>

  @error('achternaam')
    <div>
      <p><strong class="has-text-danger">{{ $message }}</strong></p>
    </div>
  @enderror

  <div class="field">
    <label class="label">{{ __('Achternaam') }}</label>
    <div class="control has-icons-left">
      <span class="icon is-small is-left">
        <i class="fas fa-user"></i>
      </span>
      <input class="input is-rounded @error('achternaam') is-danger @enderror" type="text" name="achternaam" id="achternaam" placeholder="Vul hier je achternaam in">
    </div>
  </div>

  @error('birthdate')
    <div>
      <p><strong class="has-text-danger">{{ $message }}</strong></p>
    </div>
  @enderror

  <div class="field">
    <label class="label" for='birthdate'>Geboortedatum</label>
    <input type='date' name="birthdate" class="input is-rounded @error('birthdate') is-danger @enderror" id='birthdate' placeholder="vul hier je geboorte datum in" />
  </div>

  @error('email')
  <div>
    <p><strong class="has-text-danger">{{ $message }}</strong></p>
  </div>
  @enderror

  <div class="field">
    <label class="label">{{ __('E-mailadres') }}</label>
    <div class="control has-icons-left">
      <span class="icon is-small is-left">
        <i class="fas fa-at"></i>
      </span>
      <input class="input is-rounded @error('email') is-danger @enderror" type="email" name="email" id="email" placeholder="Vul hier je e-mailadres in">
    </div>
  </div>

  @error('password')
    <div>
      <p><strong class="has-text-danger">{{ $message }}</strong></p>
    </div>
  @enderror

  <div class="field">
    <label class="label">{{ __('Wachtwoord') }}</label>
    <div class="control has-icons-left">
      <span class="icon is-small is-left">
        <i class="fas fa-lock"></i>
      </span>
      <input class="input is-rounded @error('password') is-danger @enderror" type="password" name="password" id="password" placeholder="Vul hier je wachtwoord in" onKeyUp="checkPasswordStrength();">
      <div id="password-strength-status"></div>
    </div>
  </div>

  <div class="field">
    <label class="label">{{ __('Wachtwoord bevestigen') }}</label>
    <div class="control has-icons-left">
      <span class="icon is-small is-left">
        <i class="fas fa-lock"></i>
      </span>
      <input class="input is-rounded" type="password" name="password_confirmation" id="password_confirmation" placeholder="Bevestig je wachtwoord" onKeyUp="checkPasswordStrength();">
    </div>
  </div>

  <br/>

  <div class="field is-grouped">
    <div class="control">
      <input class="button is-success is-rounded button-green" type="submit" value="Registreren"/>
    </div>
    <div class="control">
      <button class="button is-success is-light is-rounded" href="/">Annuleren</button>
    </div>
  </div>
  </form>

  <br/>

  <div>
    <a href="/login">Al lid? Log dan hier in</a>
  </div>
@endsection

<script src="js/passwordcheck.js"></script>
