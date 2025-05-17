<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Informasi Wisata')</title>

    {{-- Bootstrap CSS (optional) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">WisataKita</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="#" class="nav-link">Beranda</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Pemetaan</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Daftar Wisata</a></li>
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

    {{-- Bootstrap JS (optional) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Leaflet JS --}}
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    {{-- Custom JS --}}
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
