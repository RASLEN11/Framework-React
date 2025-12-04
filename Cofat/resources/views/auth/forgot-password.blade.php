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
            color: dark;
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
        
        .info-text {
            color: #343a40;
            font-size: 1rem;
            margin-bottom: 1.5rem;
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
                Get back to making a difference
            </p>
        </div>
    </section>
    
    <!-- Password Reset Form -->
    <div class="container">
        <div class="card password-card">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4 alert alert-success" :status="session('status')" />

            <p class="info-text">
                <i class="fas fa-info-circle me-2"></i>
                Forgot your password? No problem. Just let us know your email address and we'll email you a password reset link.
            </p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="form-label fw-bold">
                        <i class="fas fa-envelope form-icon"></i> Email Address
                    </label>
                    <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-reset">
                        <i class="fas fa-paper-plane me-2"></i> Email Password Reset Link
                    </button>
                </div>

                <div class="mt-4 text-center">
                    <p class="mb-0">Remember your password? 
                        <a href="{{ route('login') }}" class="text-decoration-none fw-bold">Login here</a>
                    </p>
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