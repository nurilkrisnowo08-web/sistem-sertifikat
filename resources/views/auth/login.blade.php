<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - ARQI</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { 
            background-color: #e8e6e1; 
            color: #222222; 
            font-family: 'Segoe UI', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        body::before {
            content: "";
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url("{{ asset(app()->environment('production') ? 'public/murai.png' : 'murai.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover; 
            opacity: 0.35; 
            z-index: -1;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid #444444;
            border-radius: 16px;
            backdrop-filter: blur(5px);
            max-width: 400px;
            width: 100%;
            padding: 35px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .form-control {
            background-color: #ffffff;
            border: 2px solid #444444;
            border-radius: 8px;
            font-weight: 600;
            padding: 0.65rem 0.75rem;
        }
        .btn-dark-custom {
            background-color: #222222;
            color: #ffffff;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            padding: 0.7rem;
            border: none;
            transition: all 0.2s;
        }
        .btn-dark-custom:hover {
            background-color: #000000;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-uppercase" style="letter-spacing: 1px;"><i class="fa-solid fa-shield-halved me-2"></i>ARQI FARM</h4>
            <p class="text-muted small mb-0">Masuk untuk mengakses sistem managemen</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 small fw-bold mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold">Email Admin</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-4">
                <label class="form-label small fw-bold">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark-custom">Masuk Sistem</button>
        </form>
    </div>
</body>
</html>