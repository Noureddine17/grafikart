<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Agence Immobilière') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
</head>

<body style="background-color: #E7E9E6">

    <header>
        <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Agence
                    Immo
                </a>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- <li class="nav-item"><a class="nav-link active" aria-current="page" href="/">Acceuil</a></li>
                        <li class="nav-item"><a class="nav-link" href="/about">Agence</a></li> -->
                        <li class="nav-item"><a class="nav-link" href="/biens">Nos biens</a></li>

                        @if (Auth::user() && Auth::user()->role === 'admin')
                            <li class="nav-item"><a class="nav-link" href="/create">Ajouter un bien</a></li>
                            <li class="nav-item"><a class="nav-link" href="/options">Ajouter une option</a></li>

                        @endif

                    </ul>
                </div>

            
                @if (Auth::check())
                    <span class="navbar-text me-3">
                        Bonjour, {{ Auth::user()->name }}
                    </span>
                    <form action="{{ route('users.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">Se déconnecter</button>
                    </form>

                @endif

                @if (!Auth::check())
                    <a href="{{ route('users.create') }}" class="navbar-brand">Créer un compte</a>
                    <a href="/login" class="navbar-brand">Se connecter</a>
                @endif


            </div>
        </nav>
    </header>