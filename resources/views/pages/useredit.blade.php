@extends('layouts.continuation')

@section('title', 'Lid bewerken')

@section('content')
<form method="post" action="{{ route('mPrivateUpdate', $edituser->id) }}">
    @csrf
    @method('PUT')

    @error("userVoornaam")
        <div>
            <p><strong class="has-text-danger">{{ $message }}</strong></p>
        </div>
        <hr/>
    @enderror

    <div class="field">
        <label class="label">Voornaam</label>
        <input type="text" class="input is-rounded" name="userVoornaam" value="{{ $edituser->userVoornaam }}"/>
    </div>

    @error("userAchternaam")
    <div>
        <p><strong class="has-text-danger">{{ $message }}</strong></p>
    </div>
    <hr/>
    @enderror

    <div class="field">
        <label class="label">Achternaam</label>
        <input type="text" class="input is-rounded" name="userAchternaam" value="{{ $edituser->userAchternaam }}"/>
    </div>

    @error("userAvatar")
        <div>
            <p><strong class="has-text-danger">{{ $message }}</strong></p>
        </div>
        <hr/>
    @enderror

    <div class="field">
        <label class="label" for="quantity">Schermnaam</label>
        <input type="text" class="input is-rounded" name="userAvatar" value="{{ $edituser->userAvatar }}"/>
    </div>

    @error("email")
        <div>
            <p><strong class="has-text-danger">{{ $message }}</strong></p>
        </div>
    @enderror

    <div class="field">
        <label class="label" for="quantity">E-mailadres</label>
        <input type="text" class="input is-rounded" name="email" value="{{ $edituser->email }}"/>
    </div>
    <br/>
    <div class="field">
        <input type="submit" class="button button-green is-rounded" />
    </div>
</form>
@endsection

 