<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pakar Kejang Demam') | Febrile Seizure Expert</title>
    <!-- Bizland Bootstrap 5 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&family=Raleway:wght@400;500;700;800&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --primary: #106eea;
            --secondary: #e84545;
            --dark: #1e1e1e;
            --light-bg: #f8f9fa;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            color: #555;
        }

        /* ── Topbar ── */
        #topbar {
            background: var(--primary);
            font-size: 13px;
            padding: 8px 0;
            color: #fff;
        }

        #topbar a {
            color: rgba(255, 255, 255, .8);
            text-decoration: none;
        }

        #topbar a:hover {
            color: #fff;
        }

        /* ── Navbar ── */
        #header {
            background: #fff;
            box-shadow: 0 2px 15px rgba(0, 0, 0, .1);
            position: sticky;
            top: 0;
            z-index: 997;
            padding: 15px 0;
        }

        #header .logo {
            font-family: 'Raleway', sans-serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
        }

        #header .logo span {
            color: var(--secondary);
        }

        .navbar-nav .nav-link {
            font-family: 'Raleway', sans-serif;
            font-weight: 600;
            font-size: 14px;
            color: #555;
            padding: 8px 16px;
            letter-spacing: .5px;
            transition: .3s;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: var(--primary);
        }

        .btn-get-started {
            background: var(--primary);
            color: #fff !important;
            border-radius: 4px;
            padding: 8px 20px !important;
        }

        .btn-get-started:hover {
            background: #0d58c0;
        }

        /* ── Hero ── */
        #hero {
            background: linear-gradient(135deg, #e8f1fd 0%, #f0f7ff 50%, #e8f1fd 100%);
            padding: 80px 0 60px;
            min-height: 85vh;
            display: flex;
            align-items: center;
        }

        #hero h1 {
            font-family: 'Raleway', sans-serif;
            font-size: 48px;
            font-weight: 800;
            color: #1a1a2e;
            line-height: 1.2;
        }

        #hero h1 span {
            color: var(--primary);
        }

        #hero p {
            font-size: 17px;
            color: #666;
            margin: 20px 0 30px;
            line-height: 1.8;
        }

        .hero-img {
            position: relative;
        }

        .hero-img img {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(16, 110, 234, .2);
        }

        .badge-float {
            position: absolute;
            background: #fff;
            border-radius: 12px;
            padding: 12px 18px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge-float.top {
            top: -20px;
            right: -20px;
        }

        .badge-float.bottom {
            bottom: -20px;
            left: -20px;
        }

        .badge-float .icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        /* ── Section defaults ── */
        section {
            padding: 60px 0;
        }

        .section-title h2 {
            font-family: 'Raleway', sans-serif;
            font-size: 36px;
            font-weight: 700;
            color: #1a1a2e;
        }

        .section-title h2::after {
            content: '';
            width: 60px;
            height: 3px;
            background: var(--primary);
            display: block;
            margin: 12px auto 0;
        }

        .section-title p {
            color: #777;
            font-size: 15px;
            margin-top: 16px;
        }

        /* ── Cards ── */
        .feature-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .06);
            transition: .3s;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 35px rgba(16, 110, 234, .15);
        }

        .feature-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            background: rgba(16, 110, 234, .1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: var(--primary);
            margin-bottom: 20px;
        }

        /* ── CTA section ── */
        #cta {
            background: linear-gradient(135deg, var(--primary), #0d58c0);
            color: #fff;
            text-align: center;
        }

        #cta h3 {
            font-family: 'Raleway', sans-serif;
            font-size: 28px;
            font-weight: 700;
        }

        .btn-cta {
            background: #fff;
            color: var(--primary);
            font-weight: 700;
            border-radius: 4px;
            padding: 12px 35px;
            transition: .3s;
        }

        .btn-cta:hover {
            background: #e8f1fd;
            color: var(--primary);
        }

        /* ── Footer ── */
        #footer {
            background: #0a0a0a;
            color: #aaa;
            padding: 40px 0 20px;
        }

        #footer h4 {
            color: #fff;
            font-family: 'Raleway', sans-serif;
            font-weight: 700;
            margin-bottom: 16px;
        }

        #footer a {
            color: #aaa;
            text-decoration: none;
            transition: .3s;
        }

        #footer a:hover {
            color: #fff;
        }

        #footer .copyright {
            border-top: 1px solid #222;
            padding-top: 20px;
            margin-top: 30px;
            text-align: center;
            font-size: 13px;
        }

        /* ── Breadcrumb hero ── */
        .page-hero {
            background: linear-gradient(135deg, var(--primary), #0d58c0);
            padding: 60px 0 40px;
            color: #fff;
        }

        .page-hero h1 {
            font-family: 'Raleway', sans-serif;
            font-size: 36px;
            font-weight: 800;
        }

        .page-hero .breadcrumb-item a {
            color: rgba(255, 255, 255, .8);
            text-decoration: none;
        }

        .page-hero .breadcrumb-item.active {
            color: #fff;
        }

        .page-hero .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, .6);
        }

        /* Checklist style */
        .check-list li {
            padding: 6px 0;
            list-style: none;
            padding-left: 28px;
            position: relative;
        }

        .check-list li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: 700;
        }

        /* Step badge */
        .step-badge {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 18px;
            flex-shrink: 0;
        }

        @media (max-width: 768px) {
            #hero h1 {
                font-size: 32px;
            }

            .badge-float {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    {{-- Topbar --}}
    <div id="topbar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-3">
                <span><i class="bi bi-envelope me-1"></i> info@febrileseizure.id</span>
                <span><i class="bi bi-phone me-1"></i> +62 812-3456-7890</span>
            </div>
            <div class="d-flex gap-3">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>

    {{-- Header / Navbar --}}
    <header id="header">
        <div class="container">
            <nav class="navbar navbar-expand-lg p-0">
                <a class="logo" href="{{ route('home') }}">
                    Febrile<span>Seizure</span>
                </a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navMenu">
                    <ul class="navbar-nav align-items-center gap-1">
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                                href="{{ route('home') }}">Beranda</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}"
                                href="{{ route('about') }}">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}"
                                href="{{ route('articles.index') }}">Artikel</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('hospitals.*') ? 'active' : '' }}"
                                href="{{ route('hospitals.index') }}">Rumah Sakit</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('diseases') ? 'active' : '' }}"
                                href="{{ route('diseases') }}">Penyakit</a></li>
                        <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}"
                                href="{{ route('contact') }}">Kontak</a></li>
                        <li class="nav-item ms-2">
                            <a class="nav-link btn-get-started" href="{{ route('login') }}">
                                <i class="bi bi-shield-lock me-1"></i> Login Admin
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </header>

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer id="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h4>FebrileSeizure Expert</h4>
                    <p style="font-size:14px">Sistem pakar berbasis web untuk mendiagnosis penyakit kejang demam pada
                        anak menggunakan metode Dempster-Shafer.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#"><i class="bi bi-facebook fs-5"></i></a>
                        <a href="#"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#"><i class="bi bi-youtube fs-5"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4>Link Cepat</h4>
                    <ul class="list-unstyled" style="font-size:14px">
                        <li class="mb-2"><a href="{{ route('home') }}"><i
                                    class="bi bi-chevron-right text-primary me-1"></i>Beranda</a></li>
                        <li class="mb-2"><a href="{{ route('about') }}"><i
                                    class="bi bi-chevron-right text-primary me-1"></i>Tentang Sistem</a></li>
                        <li class="mb-2"><a href="{{ route('diseases') }}"><i
                                    class="bi bi-chevron-right text-primary me-1"></i>Informasi Penyakit</a></li>
                        <li class="mb-2"><a href="{{ route('diagnosis.create') }}"><i
                                    class="bi bi-chevron-right text-primary me-1"></i>Mulai Konsultasi</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4>Informasi</h4>
                    <ul class="list-unstyled" style="font-size:14px">
                        <li class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>Medan, Sumatera Utara</li>
                        <li class="mb-2"><i class="bi bi-phone text-primary me-2"></i>+62 812-3456-7890</li>
                        <li class="mb-2"><i class="bi bi-envelope text-primary me-2"></i>info@febrileseizure.id</li>
                        <li class="mb-2"><i class="bi bi-clock text-primary me-2"></i>24 Jam / 7 Hari</li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h4>Admin</h4>
                    <ul class="list-unstyled" style="font-size:14px">
                        <li class="mb-2"><a href="{{ route('login') }}"><i
                                    class="bi bi-shield-lock text-primary me-1"></i>Login Admin</a></li>
                    </ul>
                    <div class="mt-3 p-3 rounded" style="background:#111;font-size:12px;color:#666">
                        <i class="bi bi-shield-check text-primary me-1"></i>
                        Sistem ini menggunakan metode Dempster-Shafer yang telah divalidasi oleh dokter spesialis anak.
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; {{ date('Y') }} <strong>FebrileSeizure Expert System</strong> — Dikembangkan oleh STMIK
                    Triguna Dharma</p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
