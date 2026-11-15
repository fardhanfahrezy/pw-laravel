<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Sistem Informasi Mahasiswa') - CRUD Eloquent ORM</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --brand-primary: #0d6efd;
            --brand-dark: #0a4aa8;
            --bg-body: #f4f6f9;
        }

        body {
            background-color: var(--bg-body);
            color: #333333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .main-content {
            flex: 1;
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 0.125rem 0.375rem rgba(0, 0, 0, 0.06), 0 0.25rem 1rem rgba(0, 0, 0, 0.04);
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            border-top-left-radius: 0.75rem !important;
            border-top-right-radius: 0.75rem !important;
            padding: 1.1rem 1.5rem;
        }

        .table th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.5px;
            vertical-align: middle;
        }

        .table td {
            vertical-align: middle;
        }

        .btn {
            border-radius: 0.5rem;
            font-weight: 500;
            padding: 0.45rem 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .footer {
            background-color: #ffffff;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('mahasiswa.index') }}">
                <i class="bi bi-mortarboard-fill fs-4"></i>
                <span>Data Mahasiswa</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-nav-item">
                        <a class="nav-link {{ request()->routeIs('mahasiswa.index') ? 'active fw-semibold' : '' }}" href="{{ route('mahasiswa.index') }}">
                            <i class="bi bi-people-fill me-1"></i> Daftar Mahasiswa
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-light text-primary btn-sm ms-lg-2" href="{{ route('mahasiswa.create') }}">
                            <i class="bi bi-person-plus-fill"></i> Tambah Mahasiswa
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-content py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer py-3 text-center">
        <div class="container">
            <span>&copy; {{ date('Y') }} <strong>Praktikum Pemrograman Web Lanjut</strong> &bull; Modul Pertemuan 11: Interaksi Database dengan Eloquent ORM</span>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
