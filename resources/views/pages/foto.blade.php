@extends('layouts.gallery')

@section('title', 'Fotogalerij')

@section('content')
  <?php
    if(isset($fotos)){
  ?>
    @foreach ($fotos as $foto)
      <div class="column is-3 has-text-centered" data-aos="fade-up">
        @if($foto->epRating == 1)
            <span class="tag is-danger is-light tag-rating">21+</span>
          @endif
        <a href="/foto/{{$foto->id}}">
          <div class="image-box">
            <figure class="image">
              <img src="{{ Storage::url($foto->fotoFileName) }}">
            </figure>
          </div>
          <h4 style="display:unset;">{{ $foto->fotoTitel }}</h4>
        </a><br/>
      </div>

    @endforeach
  <?php } ?>
@endsection
