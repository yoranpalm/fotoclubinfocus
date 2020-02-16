@extends('layouts.continuation')

@if(isset($camera))
  @section('title', 'Bewerk een camera')
@else
  @section('title', 'Maak een camera aan')
@endif

@section('content')

<form method="POST" <?php echo (isset($camera))?"action='/camera/$camera->id'":"action='/camera'" ?> >
  <?php echo (isset($camera))?"<input type='hidden' name='_method' value='PUT' />":""; ?>
  @csrf
  
  @error('cameraMerk')
  <div>
      <p><strong class="has-text-danger">{{ $message }}</strong></p>
  </div>
  @enderror

  <div class="field">
    <label class="label" for="cameraMerk">Camera merk</label>
    <input class="input is-rounded @error('cameraMerk') is-danger @enderror" type="text" id="cameraMerk" name="cameraMerk" placeholder="Vul het merk van de camera in"<?php echo (isset($camera))?"value='$camera->cameraMerk'":'';?> />
  </div>

  <br/>
  

  <div class="field">
    <label class="label" for="cameraType">Camera type</label>
    <input class="input is-rounded" type="text" id="cameraType" name="cameraType" placeholder="Vul het type van de camera in"<?php echo (isset($camera))?"value='$camera->cameraType'":'';?> />
  </div>

  <br/>

  <div class="field is-grouped">
    <div class="control">
      @if(isset($camera))
        <input class="button is-success is-rounded button-green" type="submit" value="Camera bewerken"/>
      @else
        <input class="button is-success is-rounded button-green" type="submit" value="Camera toevoegen"/>
      @endif
    </div>
  </div>
</form>

@endsection