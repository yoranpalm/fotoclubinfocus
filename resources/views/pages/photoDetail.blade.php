@extends('layouts.photo')

@section('title', "$foto->fotoTitel")

@auth
    @section('crud')
        <div class="buttons is-centered">
            @if (auth::id() === $foto->userId || auth::user()->beheerderStatus === 1)    
                <button onclick="window.location.href = '/foto/{{$foto->id}}/edit';" class="button is-rounded">Bewerken</button>
                <form action='' method="POST">
                    @method("DELETE")
                    @csrf

                    <button class="button is-rounded">Verwijderen</button>
                </form>
            @endif
            <button onclick="window.location.href = '/foto/create'" class="button is-rounded">Toevoegen</button>
        </div>
    @endsection
@endauth

@section('content')
    @if(session("upload"))
    <div class="container has-text-centered">
        <p><strong class="has-text-success">{{ session("upload") }}</strong></p>
        <br/>
    </div>
    @endif

    <figure class="image">
        @if($foto->epRating == 1)
            <span class="tag is-danger is-light tag-rating">21+</span>
        @endif
        <img src="{{Storage::url($foto->fotoFileName)}}">
    </figure>
    <br/>
    <div class="profile-info _detail">
        <a class="has-material-icon" href="/profiel/{{ $foto->user->id }}"><i class="material-icons-outlined">account_circle</i> {{ $foto->user->userVoornaam }} {{ $foto->user->userAchternaam }}</a>
        <p class="has-material-icon"><i class="material-icons-outlined" href="{{ $foto->user->id }}">date_range</i> {{ date('d-m-Y', strtotime($foto->created_at)) }}</p>
        <p class="has-material-icon"><i class="material-icons-outlined" href="{{ $foto->user->id }}">camera</i> {{ $foto->camera->cameraMerk }} {{ $foto->camera->cameraType }}</p>
        @if(!empty($foto->keywords))<p class="has-material-icon"><i class="material-icons-outlined">local_offer</i>
            @foreach(json_decode($foto->keywords) as $keyword)
                <span class="tag is-success is-light" style="margin-right:5px;">{{ $keyword }}</span>
            @endforeach
        </p>
        @endif
        @if(!empty($fotoCategorien))
            <p class="has-material-icon"><i class="material-icons-outlined" href="{{ $foto->user->id }}">list_alt</i>
                @foreach ($fotoCategorien as $categorie)
                    {{ $categorie->categorie->categorieNaam }} @if (count($fotoCategorien) > 1 && !$loop->last) - @endif
                @endforeach
            </p>
        @endif
        <p class="has-material-icon"><i class="material-icons-outlined" href="{{ $foto->user->id }}">star_border</i> {{ round($recensies->avg('starRating'), 2) }}</p>
    </div>

    <hr/>

    <p> {{$foto->fotoOmschrijving}}</p>

    <hr/>

    <div class="field">
        <label class="label">Recensies</label>

        @foreach ($recensies as $recensie)
            @if ($recensie->recensieTekst)
                <div>
                <?php
                    $user = \App\User::find($recensie->userId);

                    echo "<p><a href='/profiel/".$user->id."'>".$user->userVoornaam."</a>:";
                ?>
                
                {{ $recensie->recensieTekst }}</p>
                </div>
            
            @endif
        @endforeach

        <hr/>
        <h4>Recensie plaatsen</h4>
        <p>Laat hieronder een recensie achter voor deze foto.</p>
        <form action="/recensie" method="POST">
            @csrf

            <input type="hidden" name="fotoId" id="fotoId" value="{{ $foto->id }}" hidden /><br/>

            @error("rating")
                <div>
                    <p><strong class="has-text-danger">{{ $message }}</strong></p>
                </div>
            @enderror

            <div class="control"><h4>Foto rating</h4>
                <label class="radio">
                    <input type="radio" name="rating" value="1">
                    1
                </label>
                <label class="radio">
                    <input type="radio" name="rating" value="2">
                    2
                </label>
                <label class="radio">
                    <input type="radio" name="rating" value="3">
                    3
                </label>
                <label class="radio">
                    <input type="radio" name="rating" value="4">
                    4
                </label>
                <label class="radio">
                    <input type="radio" name="rating" value="5">
                    5
                </label>
            </div><br/>
            <h4>Recensie tekst</h4>
            <div class="field" style="margin-top: 15px;">
              <div class="control">
                <textarea class="textarea" placeholder="Geef hier een recensie op" name="recensieText"></textarea>
                <br/>
                <div style="display:flex;justify-content:space-between;align-items:center;"><input class="button is-success is-rounded button-green" value="Recensie plaatsen" type="submit"/> @if(isset(auth::user()->id)) <p>Recensies worden geplaatst als <a href="/profiel/{{ auth::user()->id }}">{{ auth::user()->userVoornaam }}</a></p> @endif </div>
              </div>
          </div>
        </form>
    </div>
@endsection
