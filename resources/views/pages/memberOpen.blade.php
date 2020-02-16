@extends('layouts.member')

@section('title', 'Openbaar profiel')

@section('profile-info')
<div class="columns is-centered">
    <!--post details-->
    <div class="column is-8" data-aos="fade-up">
        <div class="profile">
            <figure class="image is-96x96">
                <img src="/images/profile-placeholder.png">
            </figure>
            <div>
                
              <h3>{{ $user->userVoornaam }} {{ $user->userAchternaam }}</h3>
              {{ $user->userAvatar }} <br/>
          
            </div>
        </div>
    </div>
</div>
@endsection
@section('profile-foto')
        <?php
    if(isset($fotos)){
  ?>
  <hr data-aos="fade-up">
  <br />
  <div class="columns is-centered gallery-wrapper">
    @foreach ($fotos as $foto)
      <div class="column is-3 has-text-centered" data-aos="fade-up">
        @if($foto->epRating == 1)
        <span class="tag is-danger is-light tag-rating">
            21+
        </span>
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
  </div>
  <?php } ?>
  <div>
      <!--Recensie Data-->
  </div>
@endsection
@section('profile-recensie')
  <hr data-aos="fade-up">
  <div class="columns is-centered gallery-wrapper">
  @foreach ($recensies as $recensie)
    <div class="column is-3 has-text-left" data-aos="fade-up">
      <p><b>Recensie:</b> {{ $recensie->recensieTekst }}</p>
      <a href="/foto/{{$recensie->fotoId}}">
        Bekijk foto ›
      </a>
    </div>
  @endforeach
  </div>
@endsection
