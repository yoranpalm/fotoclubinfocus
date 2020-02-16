<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
    <title>Fotoclub InFocus</title>
</head>
<body>
<div id="app">
    <div class="with-circle">
        @include('includes.navigation')

        @if (session("status"))
            <div class="container has-text-centered">
                <br/>
                <p><strong class="has-text-danger">{{ session("status") }}</strong></p>
            </div>
        @endif
        @if (session("upload"))
            <div class="container has-text-centered">
                <br/>
                <p><strong class="has-text-success">{{ session("upload") }}</strong></p>
            </div>
        @endif

        <section class="hero">
            <div class="hero-body has-text-centered">
                <div class="container">
                    <div class="columns is-centered">
                        <div class="column is-7" data-aos="fade-down">
                            <h1>Fotoclub InFocus</h1>
                            <br/>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus turpis enim, maximus
                                quis mollis nec, tincidunt vel ex. Cras vestibulum nibh nec ipsum bibendum, eu sodales
                                sem varius. Phasellus est velit, accumsan sed turpis vel, pretium volutpat libero. Nulla
                                facilisi. Vestibulum odio est, venenatis quis elit vel, blandit viverra odio. Sed porta
                                diam sit amet libero sagittis pretium. Suspendisse tempus tempus odio eu condimentum.
                                Donec vehicula luctus venenatis. Vestibulum et accumsan diam</p>
                            <br/>
                            @auth
                                <button class="button is-success is-rounded button-green" onclick="window.location.href = '/foto/create';">
                                    <strong>Upload een foto</strong>
                                </button>
                            @endauth
                            @guest
                                <button class="button is-success is-rounded button-green" onclick="window.location.href = 'register';">
                                    <strong>Meld je nu aan</strong>
                                </button>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="with-oval oval-bottom">
        </div>
    </div>

    <section class="hero">
        <div class="hero-body usp-wrapper content-body">
            <div class="container">
                <div class="columns is-centered has-text-centered">
                        <div class="column" data-aos="fade-down" data-aos-delay="250">
                            <i class="material-icons-outlined">camera_alt</i>
                            <h3 class="has-text-grey-dark">USP 1</h3>
                            <br/>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec non leo ut orci faucibus convallis. Aenean blandit mi placerat dapibus condimentum. Vestibulum rutrum vel lorem in venenatis.</p>
                        </div>
                        <div class="column" data-aos="fade-down" data-aos-delay="500">
                            <i class="material-icons-outlined">favorite_border</i>
                            <h3 class="has-text-grey-dark">USP 2</h3>
                            <br/>
                            <p>Maecenas auctor tincidunt ipsum eget fermentum. Vestibulum sapien orci, mollis eu elit vel, vulputate porttitor ligula.</p>
                        </div>
                        <div class="column" data-aos="fade-down" data-aos-delay="750">
                            <i class="material-icons-outlined">lock</i>
                            <h3 class="has-text-grey-dark">USP 3</h3>
                            <br/>
                            <p>Pellentesque ut purus ipsum. Mauris ac vehicula nibh, vitae ultricies velit. In non sollicitudin nisl. Cras finibus vestibulum iaculis. Sit amet vestibulum eros tincidunt.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    if(isset($fotos)){
    ?>
    <section class="hero">
        <div class="hero-body">
            <div class="container is-fluid">
                <h2 class="has-text-centered">Uitgelichte foto's</h2>
                <br/><br/>
                <div class="columns is-centered">
                    <div class="owl-carousel owl-theme">
                        @foreach ($fotos as $foto)
                        <div class="column item">
                            <a href="/foto/{{$foto->id}}">
                                <figure class="image is-16by9">
                                    <img src="{{ Storage::url($foto->fotoFileName) }}">
                                </figure>
                            </a>
                            <span class="has-material-icon"><i class="material-icons-outlined">account_circle</i>{{$foto->user->userVoornaam}} {{$foto->user->userAchternaam}}</span><br/>
                            <h4 style="display:unset;">{{ $foto->fotoTitel }}</h4><br/>
                            <p>{{$foto->fotoOmschrijving}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php } ?>
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
@include('includes/footer')
</html>
