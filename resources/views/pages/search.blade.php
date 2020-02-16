@extends('layouts.continuation')

@section('title', "Zoekresultaten voor $value")

@section('crud')
    <div class="buttons is-centered">
        <a class="button is-dark is-outlined is-rounded"><i class="material-icons-outlined">edit</i> Bewerken</a>
        <a class="button is-dark is-outlined is-rounded"><i class="material-icons-outlined">delete</i> Verwijderen</a>
        <a class="button is-dark is-outlined is-rounded"><i class="material-icons-outlined">add</i> Toevoegen</a>
    </div>
@endsection

@section('sidebar')
    <p><strong>Acties</strong></p>
    <p class="detail-item"><i class="material-icons-outlined">edit</i> Bewerken</p>
    <p class="detail-item"><i class="material-icons-outlined">delete</i> Verwijderen</p>
    <p class="detail-item"><i class="material-icons-outlined">add</i> Toevoegen</a>
@endsection

@section('content')
    @if ($fotos->isEmpty() && $fotosFromCategory->isEmpty() && $users->isEmpty())
    <i>Er is niks gevonden</i>

    <hr />
    @endif

    @if (!$fotos->isEmpty())
    <br/>

    <h3>Foto's</h3>
    <br/>

    @foreach ($fotos as $foto)
            <div class="validation-wrapper">
                <a href="/foto/{{$foto->id}}"><strong>{{ $foto->fotoTitel }} </strong> | {{ $foto->fotoOmschrijving }}</a>
            </div>
            <hr/>
    @endforeach
    @endif

    @if (!$fotosFromCategory->isEmpty())
        <br/>

        <h3>Foto's in gerelateerd categorie</h3>
        @foreach ($categorien as $categorie)
            <i>{{$categorie->categorieNaam}} | {{$categorie->categorieOmschrijving}} </i>         
        @endforeach
        <hr />
        <br/>

        @foreach ($fotosFromCategory as $cFoto)
                <div class="validation-wrapper">
                    <a href="/foto/{{$cFoto->id}}"><strong>{{ $cFoto->fotoTitel }} </strong> | {{ $cFoto->fotoOmschrijving }}</a>
                </div>
                <hr/>
        @endforeach
    @endif

    <br/>

    @if(!$users->isEmpty())
    <h3>Leden</h3>
    <br/>
        
        @foreach ($users as $user)
            <div class="validation-wrapper">
                <a href="/profiel/{{$user->id}}"><strong>{{ $user->userVoornaam }} {{ $user->userAchternaam }}</strong> | {{ $user->userAvatar }}</a href="/profiel"> 
            </div>
            <hr/>
        @endforeach
    @endif
@endsection
