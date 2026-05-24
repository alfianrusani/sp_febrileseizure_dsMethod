<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — Febrile Seizure Expert</title>
    <link rel="stylesheet" href="{{ asset('css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.min.css') }}">
    <style>
        body {
            background: linear-gradient(135deg, #106eea 0%, #0d58c0 100%);
            min-height: 100vh;
        }

        .login-card {
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .3);
        }

        .brand-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #106eea, #0d58c0);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #fff;
            margin: 0 auto 20px;
        }
    </style>
</head>

<body class="d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="card login-card border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="brand-icon"><i class="bi bi-heart-pulse-fill"></i></div>
                            <h3 style="font-weight:800;color:#1a1a2e">Login Administrator</h3>
                            <p class="text-muted" style="font-size:14px">Febrile Seizure Expert System</p>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" style="font-size:14px">
                                <i class="bi bi-exclamation-circle me-2"></i>
                                {{ $errors->first() }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:14px">Email</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        placeholder="admin@gmail.com" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold" style="font-size:14px">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="••••••••"
                                        required>
                                </div>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label" for="remember" style="font-size:14px">Ingat saya</label>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2"
                                style="border-radius:8px;font-weight:600">
                                <i class="bi bi-shield-lock me-2"></i>Login
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <a href="{{ route('home') }}" class="text-muted"
                                style="font-size:13px;text-decoration:none">
                                <i class="bi bi-arrow-left me-1"></i>Kembali ke Website
                            </a>
                        </div>
                    </div>
                </div>

                <p class="text-center mt-3" style="color:rgba(255,255,255,.6);font-size:12px">
                    &copy; {{ date('Y') }} Febrile Seizure Expert System — STMIK Triguna Dharma
                </p>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/tabler.min.js') }}"></script>
</body>

</html>
