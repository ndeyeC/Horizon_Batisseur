<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Immobilier App</title>
    @yield('css')


    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{--  <link rel="stylesheet" href="{{ asset('css/style.css') }}">  --}}
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-icons/font/bootstrap-icons.css') }}">

       <style>
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-custom .navbar-brand {
            color: #007bff;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #555;
            margin-right: 1rem;
        }

        .navbar-custom .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .card-custom {
            border-radius: 10px;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }

        .card-custom:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .card-custom img {
            transition: transform 0.3s ease;
        }

        .card-custom img:hover {
            transform: scale(1.05);
        }

        .btn-custom {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .badge-custom {
            font-size: 0.875rem;
            padding: 0.5em 0.75em;
        }
    </style>
</head>
<body class="bg-gray-100">
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('immobiliers.index') }}">Immobilier App</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('immobiliers.create') }}">Ajouter un Bien</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="form-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Déconnexion</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Inscription</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-5">
        @yield('content')
    </main>
</body>
</html>
