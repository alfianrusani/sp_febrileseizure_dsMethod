<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Admin') | Febrile Seizure Admin</title>
    <!-- Tabler CSS (local) -->
    <link rel="stylesheet" href="{{ asset('css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tabler-flags.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --tblr-primary: #106eea;
            --tblr-font-sans-serif: 'Inter', sans-serif;
        }

        .navbar-brand-text {
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .nav-link-title {
            font-weight: 500;
        }

        .sidebar-nav-item.active>.nav-link {
            background: rgba(16, 110, 234, .1);
            color: var(--tblr-primary);
            border-radius: 6px;
        }

        .stat-card {
            transition: .3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .table-hover tbody tr:hover {
            background: rgba(16, 110, 234, .04);
        }

        .badge-ds {
            font-size: 11px;
            padding: 4px 8px;
        }

        thead th {
            text-align: center;
            vertical-align: middle;
        }

        .page-wrapper .page-header {
            margin-top: 0.5rem !important;
        }

        .page-header {
            padding-top: .25rem !important;
            padding-bottom: .25rem !important;
        }

        .page-header.pt-4 {
            padding-top: .5rem !important;
        }

        /* Sidebar logo: fill gap between brand and first menu item */
        aside.navbar.navbar-vertical .container-fluid {
            display: flex;
            flex-direction: column;
        }

        .sidebar-logo {
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0.25rem 0;
        }

        .sidebar-logo img {
            height: 100%;
            width: auto;
            max-width: 90%;
            display: block;
        }

        aside.navbar .collapse .d-flex.flex-column.flex-md-row.flex-fill.align-items-stretch.align-items-md-center {
            flex: 0 0 auto !important;
            align-items: flex-start !important;
        }
    </style>
    @stack('styles')
</head>

<body class="antialiased">
    <div class="wrapper">

        {{-- Sidebar --}}
        <aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
            <div class="container-fluid">
                {{-- Brand --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
                    <span class="navbar-brand-text">
                        <i class="bi bi-heart-pulse-fill text-primary me-2"></i>FS Expert
                    </span>
                </a>

                <div class="collapse navbar-collapse" id="sidebarMenu">
                    <div class="sidebar-logo">
                        <img src="{{ asset('images/logo-template.svg') }}" alt="FS Logo">
                    </div>
                    {{-- User info --}}
                    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
                        <ul class="navbar-nav pt-lg-3 flex-column">
                            {{-- Dashboard --}}
                            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                                    <span class="nav-link-icon"><i class="bi bi-speedometer2"></i></span>
                                    <span class="nav-link-title">Dashboard</span>
                                </a>
                            </li>

                            <li class="nav-item mt-2">
                                <span class="nav-link-title text-uppercase fw-bold"
                                    style="font-size:10px;color:rgba(255,255,255,.4);padding:8px 16px;display:block">Data
                                    Master</span>
                            </li>

                            {{-- Diseases --}}
                            <li class="nav-item {{ request()->routeIs('admin.diseases.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.diseases.index') }}">
                                    <span class="nav-link-icon"><i class="bi bi-hospital"></i></span>
                                    <span class="nav-link-title">Data Penyakit</span>
                                </a>
                            </li>

                            {{-- Symptoms --}}
                            <li class="nav-item {{ request()->routeIs('admin.symptoms.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.symptoms.index') }}">
                                    <span class="nav-link-icon"><i class="bi bi-thermometer-half"></i></span>
                                    <span class="nav-link-title">Data Gejala</span>
                                </a>
                            </li>

                            {{-- Knowledge Base --}}
                            <li class="nav-item {{ request()->routeIs('admin.knowledge.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.knowledge.index') }}">
                                    <span class="nav-link-icon"><i class="bi bi-diagram-3"></i></span>
                                    <span class="nav-link-title">Basis Pengetahuan</span>
                                </a>
                            </li>

                            <li class="nav-item mt-2">
                                <span class="nav-link-title text-uppercase fw-bold"
                                    style="font-size:10px;color:rgba(255,255,255,.4);padding:8px 16px;display:block">Laporan</span>
                            </li>

                            {{-- Diagnoses --}}
                            <li class="nav-item {{ request()->routeIs('admin.diagnoses.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.diagnoses.index') }}">
                                    <span class="nav-link-icon"><i class="bi bi-clipboard2-pulse"></i></span>
                                    <span class="nav-link-title">Laporan Diagnosa</span>
                                </a>
                            </li>

                            {{-- Articles --}}
                            <li class="nav-item {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.articles.index') }}">
                                    <span class="nav-link-icon"><i class="bi bi-journal-text"></i></span>
                                    <span class="nav-link-title">Data Artikel</span>
                                </a>
                            </li>

                            {{-- Hospitals --}}
                            <li class="nav-item {{ request()->routeIs('admin.hospitals.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.hospitals.index') }}">
                                    <span class="nav-link-icon"><i class="bi bi-hospital"></i></span>
                                    <span class="nav-link-title">Data Hospitals</span>
                                </a>
                            </li>

                            {{-- Patients --}}
                            <li class="nav-item {{ request()->routeIs('admin.patients.*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.patients.index') }}">
                                    <span class="nav-link-icon"><i class="bi bi-people"></i></span>
                                    <span class="nav-link-title">Data Pasien</span>
                                </a>
                            </li>

                            <li class="nav-item mt-auto pt-4">
                                <a class="nav-link" href="{{ route('home') }}" target="_blank">
                                    <span class="nav-link-icon"><i class="bi bi-globe"></i></span>
                                    <span class="nav-link-title">Lihat Website</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="nav-link w-100 text-start border-0 bg-transparent text-danger">
                                        <span class="nav-link-icon"><i class="bi bi-box-arrow-left"></i></span>
                                        <span class="nav-link-title">Logout</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>

        {{-- Main content --}}
        <div class="page-wrapper">
            {{-- Top navbar --}}
            <div class="navbar-expand-md">
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <div class="navbar">
                        <div class="container-xl">
                            <ul class="navbar-nav">
                                <li class="nav-item d-none d-md-flex me-3">
                                    <div class="page-pretitle">Admin Panel</div>
                                </li>
                            </ul>
                            <div class="my-2 my-md-0 flex-md-grow-0 order-first order-md-last">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="nav-item dropdown">
                                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0"
                                            data-bs-toggle="dropdown">
                                            <div class="avatar avatar-sm"
                                                style="background:var(--tblr-primary);color:#fff;border-radius:50%;width:32px;height:32px;display:flex;align-items:center;justify-content:center;font-weight:700;">
                                                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                                            </div>
                                            <div class="d-none d-xl-block ps-2">
                                                <div style="font-size:13px;font-weight:600">
                                                    {{ auth()->user()->name ?? 'Admin' }}</div>
                                                <div class="mt-1 small text-secondary">Administrator</div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="page-body">
                <div class="container-xl">

                    {{-- Flash messages --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>

            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center">
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <p class="text-secondary mb-0">
                                &copy; {{ date('Y') }} <strong>Febrile Seizure Expert System</strong> — STMIK
                                Triguna Dharma
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="{{ asset('js/tabler.min.js') }}"></script>
    @stack('scripts')
</body>

</html>
