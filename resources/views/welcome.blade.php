<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Cowork Reservation') }}</title>

    <!-- Styles -->
    @vite(['resources/sass/app.scss'])
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Cowork Reservation') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/home') }}">{{ __('Home') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Welcome to {{ config('app.name', 'Cowork Reservation') }}</h1>
            <p class="lead">The best solution to manage your reservations in a coworking space.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg mt-3">Start Now</a>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Features</h2>
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="icon my-3">
                        <i class="bi bi-calendar2-check" style="font-size: 2rem;"></i>
                    </div>
                    <h4>Easy Reservations</h4>
                    <p>Make reservations for your favorite coworking space quickly and securely.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="icon my-3">
                        <i class="bi bi-shield-lock" style="font-size: 2rem;"></i>
                    </div>
                    <h4>Security in Your Data</h4>
                    <p>We protect your information with the best security practices.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="icon my-3">
                        <i class="bi bi-people" style="font-size: 2rem;"></i>
                    </div>
                    <h4>Easy Access</h4>
                    <p>Access and manage your reservations from any device.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-4">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Cowork Reservation') }}. All rights reserved.</p>
        </div>
    </footer>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

</body>
</html>
