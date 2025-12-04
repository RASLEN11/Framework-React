<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password - Food Donation Platform</title>
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
        }
        
        .form-control-lg {
            padding: 0.75rem 1rem;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section -->
    <section class="hero text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Secure Area</h1>
            <p class="lead mb-0">
                Please confirm your password to continue
            </p>
        </div>
    </section>

    <!-- Confirmation Form -->
    <div class="container">
        <div class="card auth-card">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-4">
                    <p class="text-muted">
                        <i class="fas fa-shield-alt me-2"></i>
                        This is a secure area of the application. Please confirm your password before continuing.
                    </p>
                </div>

                <!-- Password Input -->
                <div class="mb-4">
                    <label for="password" class="form-label fw-bold">
                        <i class="fas fa-lock form-icon"></i> Password
                    </label>
                    <input type="password" 
                           class="form-control form-control-lg" 
                           id="password" 
                           name="password"
                           required
                           autocomplete="current-password">
                </div>

                <!-- Confirm Button -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-donate">
                        <i class="fas fa-check-circle me-2"></i> Confirm
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