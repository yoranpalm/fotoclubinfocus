@extends('layouts.continuation')

@section('title', 'Beheerspagina')

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

    @error("nea")
    <div>
        <p><strong class="has-text-danger">{{ $message }}</strong></p>
        <br/>
    </div>
    @enderror

    <h3>Beheerders</h3>
    <br/>

    @foreach ($users as $user)
        @if($user->beheerderStatus != 0)
            <div class="validation-wrapper">
                <p><strong>{{ $user->userVoornaam }} {{ $user->userAchternaam }}</strong> | {{ $user->userAvatar }}</p>
                <form method="POST" action='/admin/{{ $user->id }}'>
                    @method('PUT')
                    @csrf
                    <input type="submit" id="deleteAdmin" name="deleteAdmin" class="button is-rounded is-small is-light is-light" value="Verwijder admin"/>
                </form>
            </div>
            <hr/>
        @endif
    @endforeach

    <br/>

    <h3>Validatie leden</h3>
    <br/>
    <?php $exists = false; ?>
    @foreach ($users as $user)
        @if($user->beheerderAkkoord != 1)
            <?php $exists = true; ?>
            <div class="validation-wrapper">
                <p><strong>{{ $user->userVoornaam }} {{ $user->userAchternaam }}</strong> | {{ $user->userAvatar }}</p>
                <div class="buttons">
                    <form method="POST" action='/admin/{{ $user->id }}'>
                        @method('PUT')
                        @csrf
                        
                        <input type="submit" class="button is-rounded is-small is-success is-light" value="Goedkeuren"/>
                    </form>
                    <form method="POST" action='/admin/{{ $user->id }}'>
                        @method('DELETE')
                        @csrf
                        
                        <input type="submit" class="button is-rounded is-small is-danger is-light" value="Afwijzen"/>
                    </form>
                    <form method="POST" action='/admin/{{ $user->id }}'>
                        @method('PUT')
                        @csrf
                        
                        <input type="submit" id="makeAdmin" name="makeAdmin" class="button is-rounded is-small is-info is-light" value="Maak admin"/>
                    </form>
                </div>
            </div>
            <hr/>
        @endif
    @endforeach
    @if(!$exists)
        <i>Er zijn geen leden om te valideren</i>

        <hr />
    @endif

    <br/>

    <h3>Leden</h3>
    <br/>

    @foreach ($users as $user)
        <div class="validation-wrapper">
            <p><strong>{{ $user->userVoornaam }} {{ $user->userAchternaam }}</strong> | {{ $user->userAvatar }}</p>
        
            <div class="buttons">
                @if($user->beheerderStatus != 1 && $user->blokkeerStatus != 1)
                    <form method="POST" action='/admin/{{ $user->id }}'>
                        @method('PUT')
                        @csrf
                        
                        <input type="submit" id="makeAdmin" name="makeAdmin" class="button is-rounded is-small is-info is-light" value="Maak admin"/>
                    </form>
                @endif

                @if($user->blokkeerStatus != 1 && $user->beheerderStatus != 1)
                    <form method="POST" action='/admin/{{ $user->id }}'>
                        @method('PUT')
                        @csrf
                        
                        <input type="submit" id="blockUser" name="blockUser" class="button is-rounded is-small is-danger is-light" value="Blokkeren"/>
                    </form>
                @elseif($user->beheerderStatus != 1)
                    <form method="POST" action='/admin/{{ $user->id }}'>
                        @method('PUT')
                        @csrf
                        
                        <input type="submit" id="deblockUser" name="deblockUser" class="button is-rounded is-small is-white is-light" value="Deblokkeren"/>
                    </form>
                @endif
            </div>
        </div>
        <hr/>
    @endforeach

    <br/>

    <div style="display:flex;justify-content:space-between;align-items:center;"><h3>Categorieën</h3><a href="/categorie/create">+ Categorie toevoegen</a></div>
    <br/>

    @foreach ($categorien as $categorie)
        <div class="validation-wrapper">
            <p><strong>{{ $categorie->categorieNaam }}</strong> <br/> {{ $categorie->categorieOmschrijving }}</p>
        
            <div class="buttons">
                <button class="button is-rounded is-small is-info is-light" style="margin-right:0;" onclick="window.location.href = '/categorie/{{ $categorie->id }}/edit';">Bewerken</button>
            </div>
        </div>
        <hr/>
    @endforeach
@endsection
