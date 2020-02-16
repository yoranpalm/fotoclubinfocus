<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('includes.head')
    <title>
    @section('title')
        This is the head title.
    @show
    — InFocus
    </title>
</head>
<head>
    @include('includes.head')
</head>
<body>
<div id="app">
    <div class="with-circle-small">
        @include('includes.navigation')

        <section class="hero">
            <div class="hero-body has-text-centered">
                <div class="container">
                    <div class="columns is-centered">
                        <div class="column is-7">
                        <h1>
                            @section('title')
                                This is the page title.
                            @show
                        </h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="with-oval oval-bottom">
        </div>
    </div>

    <section class="hero is-medium">
        <div class="hero-body content-body">
            <div class="container">
                @yield('profile-info')
                @yield('profile-foto')
                @yield('profile-recensie')
            </div>
        </div>
    </section>

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
@extends('includes/footer')
</html>
