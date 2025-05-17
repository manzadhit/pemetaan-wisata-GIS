<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Wisata')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">WisataKita</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a></li>
                    <li class="nav-item"><a href="{{ route('pemetaan.index') }}" class="nav-link {{ request()->routeIs('pemetaan.*') ? 'active' : '' }}">Pemetaan</a></li>
                    <li class="nav-item"><a href="{{ route('pariwisata.index') }}" class="nav-link {{ request()->routeIs('pariwisata.*') ? 'active' : '' }}">Daftar Wisata</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-fill py-4 container">
        @yield('content')
    </main>

    <footer class="bg-light py-3 mt-auto">
        <div class="container text-center">
            <small>&copy; {{ date('Y') }} Sistem Informasi Tempat Wisata</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
