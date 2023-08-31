<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-light shadow bg-white">
    <div class="container-fluid">

    <a class="py-1 navbar-brand" href="{{ url('/') }}" >
        <img src="/img/logo-alerj-projeto.png" class="img-fluid logo-alerj " alt="">
    </a>

    <div class="d-flex ml-auto">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#globalNavbar" aria-controls="globalNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse" id="globalNavbar" style="">
         <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link">
                    @if (Route::has('login'))
                        <div class="">
                        @auth
                                <a href="{{ url('/dashboard') }}" class="text-muted">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-muted">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ms-4 text-muted">Register</a>
                            @endif
                        @endif
                        </div>
                    @endif
                        Entrar
                </a>
            </li>
        </ul>
    </div>
</nav>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">{{ config('app.name') }} - {{ config('app.description') }}</h1>
</div>

</body>
</html>
