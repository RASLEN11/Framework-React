<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Food Donation Platform</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .hero {
            background-color: #212529;
            height: 50vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .password-card {
            max-width: 600px;
            margin: -50px auto 5rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            padding: 2rem;
        }
        
        .form-icon {
            font-size: 1.25rem;
            margin-right: 10px;
            color: #6c757d;
        }
        
        .btn-reset {
            background-color: #343a40;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-reset:hover {
            background-color: #23272b;
            color: white;
            transform: translateY(-2px);
        }
        
        .form-control-lg {
            padding: 0.75rem 1rem;
            font-size: 1.1rem;
        }
        
        body {
            background-color: #f8f9fa;
        }
        
        .login-link {
            color: #343a40;
            transition: color 0.3s ease;
        }
    </style>
</head>
<body>
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section -->
    <section class="hero text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Reset Your Password</h1>
            <p class="lead mb-0">
                Create a new secure password
            </p>
        </div>
    </section>
    
    <!-- Password Reset Form -->
    <div class="container">
        <div class="card password-card">
            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="form-label fw-bold">
                        <i class="fas fa-envelope form-icon"></i> Email Address
                    </label>
                    <input type="email" class="form-control form-control-lg" 
                           id="email" name="email" 
                           value="{{ old('email', $request->email) }}" 
                           required autofocus>
                    @if($errors->has('email'))
                        <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">
                        <i class="fas fa-lock form-icon"></i> New Password
                    </label>
                    <input type="password" class="form-control form-control-lg" 
                           id="password" name="password" required>
                    @if($errors->has('password'))
                        <div class="text-danger mt-2">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="form-label fw-bold">
                        <i class="fas fa-check-circle form-icon"></i> Confirm Password
                    </label>
                    <input type="password" class="form-control form-control-lg" 
                           id="password_confirmation" name="password_confirmation" required>
                    @if($errors->has('password_confirmation'))
                        <div class="text-danger mt-2">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('login') }}" class="login-link text-decoration-none">
                        <i class="fas fa-sign-in-alt me-2"></i> Back to Login
                    </a>
                    
                    <button type="submit" class="btn btn-reset">
                        <i class="fas fa-redo me-2"></i> Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    @include('components.footer')

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>