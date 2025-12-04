<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Food Donation Platform</title>
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
        
        .auth-card {
            max-width: 600px;
            margin: -50px auto 5rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border: none;
            padding: 2rem;
        }
        
        .btn-donate {
            background-color: #343a40;
            color: white;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-donate:hover {
            background-color: #23272b;
            transform: translateY(-2px);
            color: white;
        }
        
        .verification-message {
            font-size: 1.1rem;
            color: #6c757d;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section -->
    <section class="hero text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Verify Your Email</h1>
            <p class="lead mb-0">
                Secure access to your donation account
            </p>
        </div>
    </section>

    <!-- Verification Card -->
    <div class="container">
        <div class="card auth-card">
            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success alert-dismissible fade show">
                    {{ __('A new verification link has been sent to your email address.') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="verification-message mb-4">
                <i class="fas fa-envelope-open-text me-2"></i>
                {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking the link we just emailed you. If you didn\'t receive the email, we\'ll gladly send another.') }}
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-donate">
                        <i class="fas fa-paper-plane me-2"></i> 
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none text-dark">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('components.footer')

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>