@extends('layouts.continuation')

@if(isset($categorie))
  @section('title', 'Bewerk een categorie')
@else
  @section('title', 'Maak een categorie aan')
@endif

@section('content')

<form method="POST" <?php echo (isset($categorie))?"action='/categorie/$categorie->id'":"action='/categorie'" ?> >
  <?php echo (isset($categorie))?"<input type='hidden' name='_method' value='PUT' />":""; ?>
  @csrf

  @error('categorieNaam')
    <div>
        <p><strong class="has-text-danger">{{ $message }}</strong></p>
    </div>
  @enderror
  
  <div class="field">
    <label class="label" for="categorieNaam">Categorie naam</label>
    <input class="input is-rounded @error('categorieNaam') is-danger @enderror" type="text" id="categorieNaam" name="categorieNaam" placeholder="Geef de categorie een naam" <?php echo (isset($categorie))?"value='$categorie->categorieNaam'":'';?> />
  </div>

  <br/>

  @error('categorieOmschrijving')
    <div>
        <p><strong class="has-text-danger">{{ $message }}</strong></p>
    </div>
  @enderror

  <div class="field">
    <label class="label" for="categorieOmschrijving">Categorie omschrijving</label>
    <input class="input is-rounded @error('categorieOmschrijving') is-danger @enderror" type="text" id="categorieOmschrijving" name="categorieOmschrijving" placeholder="Geef een omschrijving van de categorie" <?php echo (isset($categorie))?"value='$categorie->categorieOmschrijving'":'';?> />
  </div>

  <br/>

  <div class="field is-grouped">
    <div class="control">
      @if(isset($categorie))
        <input class="button is-success is-rounded button-green" type="submit" value="Categorie bewerken"/>
      @else
        <input class="button is-success is-rounded button-green" type="submit" value="Categorie toevoegen"/>
      @endif
    </div>
  </div>
</form>

@endsection