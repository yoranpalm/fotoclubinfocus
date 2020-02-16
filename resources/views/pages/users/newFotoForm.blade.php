@extends('layouts.continuation')

@if(isset($foto))
  @section('title', 'Bewerk een foto')
@else
  @section('title', 'Upload een foto')
@endif

@section('content')

@if(session("upload"))
    <div class="container has-text-centered">
        <p><strong class="has-text-success">{{ session("upload") }}</strong></p>
        <br/>
    </div>
@endif

<form id='fotoForm' method="POST" <?php echo (isset($foto))?"action='/foto/$foto->id'":"action='/foto'" ?> enctype='multipart/form-data' >
  <?php echo (isset($foto))?"<input type='hidden' name='_method' value='PUT' />":""; ?>
  @csrf

  @error("file")
  <div>
      <p><strong class="has-text-danger">{{ $message }}</strong></p>
  </div>
  @enderror

  <div class="file has-name is-fullwidth is-right is-light" id="file-input">
    <label class="file-label">
      <input class="file-input" type='file' name='file' id='file' />
      <span class="file-cta">
        <span class="file-icon">
          <i class="fas fa-upload"></i>
        </span>
        <span class="file-label">
          Kies een bestand…
        </span>
      </span>
      <span class="file-name">
        Geen bestand geüpload
      </span>
    </label>
  </div>
  <div class="has-text-right" style="margin-top:10px;"><p>Maximale grootte: 2MB</p></div>

  <br /> <br />

  <div class="field">
    <label class="label">{{ __('Keywords') }}</label>
    <div class="control input-wrapper">
      <input class="input is-rounded" type="text" name='addText' id='addText' placeholder="Voeg een keyword toe" />
      <input class="button is-success is-light is-rounded" type='button' name='addButton' id='addButton' value='Toevoegen' />
    </div>
  </div>

  <br />

  <h4>Uw toegevoegde keywords:</h4>
  <div class="field" id="keywords">
      @empty($foto->keywords)
        <i id="keywordsEmptyMessage">Er zijn nog geen keywords toegevoegd</i>    
      @endempty
      @if(!empty($foto->keywords))
        @foreach (json_decode($foto->keywords) as $keyword)
          <input type="hidden" name="{{$keyword}}" value="{{$keyword}}" />
          <p id='{{$keyword}}' style="display:inline-block;">{{$keyword}}</p>
          <i class='material-icons-outlined' id='{{$keyword}}' name='deleteButton' style="float:right;">delete</i>
          <hr style="margin:0.5rem 0;" id='{{$keyword}}'/>
          @endforeach
      @endif
  </div >

  <br />

  @error("titel")
  <div>
      <p><strong class="has-text-danger">{{ $message }}</strong></p>
  </div>
  @enderror

  <div class="field">
    <label class="label">{{ __('Titel van foto') }}</label>
    <div class="control">
      <input class="input is-rounded" type="text" name="fotoTitel" id="fotoTitel" placeholder="Geef een titel op voor de foto" <?php echo (isset($foto))?"value='$foto->fotoTitel'":'';?> >
    </div>
  </div>

  <br />

  <div class="field">
    <label class="label">{{ __('Omschrijving foto') }}</label>
    <div class="control">
      <textarea name='fotoOmschrijving' id='fotoOmschrijving' class="textarea" placeholder="Geef hier een omschrijving op voor de foto" ><?php echo (isset($foto))? $foto->fotoOmschrijving:'';?></textarea>
    </div>
  </div>

  <br />

  <div class="field">
    <label for class="label">Leeftijd restrictie</label>
    @if(date_diff(date_create(auth::user()->birthdate), date_create('now'))->y >= 21)<input type="radio" name='epRating' id="epRating" value="on" 
      @if (isset($foto))
        @if ($foto->epRating == 1)
            checked
          @endif
        @else 
            checked
        @endif
      /> alleen beschikbaar voor leden boven 21 jaar<br />
    @endif
    <input type="radio" name='epRating' id="epRating" value="off" 
      @if(date_diff(date_create(auth::user()->birthdate), date_create('now'))->y < 21)  
        checked
      @else
        @if (isset($foto) && $foto->epRating == 0)
            checked
        @endif
      @endif 
    /> beschikbaar voor leden onder 21 jaar
  </div>

  <br />

  @error("camera")
  <div>
      <p><strong class="has-text-danger">{{ $message }}</strong></p>
  </div>
  @enderror

  <div class="field">
    <div class="control">
      <label class="label" style="display:flex;justify-content:space-between;align-items:center;">{{ __('Camera merk') }} <a href="/camera/create">+ Camera toevoegen</a></label>
      <div class="select">
        <select id="cameraId" name="cameraId">
          <?php 
            foreach($cameras as $camera) {
              if(isset($foto) && $foto->id === $camera->id){
                echo "<option value='$camera->id'>$camera->cameraMerk - $camera->cameraType</option>";
              } else {
                echo "<option value='$camera->id'>$camera->cameraMerk - $camera->cameraType</option>";
              }
            }
          ?>
        </select>
      </div>
    </div>
  </div>

  <br />

  @error("categorie")
  <div>
      <p><strong class="has-text-danger">{{ $message }}</strong></p>
  </div>
  @enderror

  <div class="select is-multiple">
    <label class="label">{{ __('Categorieën selecteren') }}</label>
    <select multiple name="fotoCategorien[]" id="fotoCategorien">
      @foreach($categorien as $categorie)
        <option
          @if (isset($fotoCategorien))
            @foreach ($fotoCategorien as $fotoCategorie)
              @if ($fotoCategorie->categorieId === $categorie->id)
                selected
              @endif
            @endforeach
          @endif 
        value={{$categorie->id}}>{{$categorie->categorieNaam}}</option>
      @endforeach
    </select>
  </div>

  <br /><br />

  <div class="field is-grouped">
    <div class="control">
      @if(isset($foto))
        <input class="button is-success is-rounded button-green" type="submit" value="Bewerken"/>
      @else
        <input class="button is-success is-rounded button-green" type="submit" value="Uploaden"/>
      @endif
    </div>
  </div>
  </form>

  <script>
    const fileInput = document.querySelector('#file-input input[type=file]');
    fileInput.onchange = () => {
      if (fileInput.files.length > 0) {
        const fileName = document.querySelector('#file-input .file-name');
        fileName.textContent = fileInput.files[0].name;
      }
    }
  </script>
@endsection