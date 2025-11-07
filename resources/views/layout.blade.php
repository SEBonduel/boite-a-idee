<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'La Boîte à Idées')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .navbar-brand {
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .nav-link {
            transition: color .2s ease-in-out;
        }

        .nav-link:hover,
        .nav-link.active {
            color: #0d6efd !important;
        }

        .btn-logout {
            border: none;
            background: transparent;
            color: #dc3545;
            text-decoration: none;
            transition: color .2s ease-in-out;
        }

        .btn-logout:hover {
            color: #b02a37;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ auth()->check() ? route('dashboard') : url('/') }}">Boîte à Idées</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="mainNav">
                <ul class="navbar-nav align-items-lg-center gap-lg-3">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('connexion') ? 'active' : '' }}"
                                href="{{ url('/connexion') }}">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('inscription') ? 'active' : '' }}"
                                href="{{ url('/inscription') }}">S'inscrire</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}"
                                href="{{ route('dashboard') }}">Tableau de bord</a>
                        </li>
                        <li class="nav-item">
                            <form method="post" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn-logout nav-link p-0">Déconnexion</button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-5">
        <div class="container">
            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
