<link rel="stylesheet" href="{{ asset('css/auth/login.css') }}">
    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0" style="background-color: rgba(255, 255, 255, 0);">
                <div class="modal-body p-0">
                    <!-- Login Container -->
                    <div class="container-fluid d-flex flex-column justify-content-start align-items-center py-4 px-3">

                        <!-- Close Button -->
                        <div class="w-100 d-flex justify-content-end pe-1">
                            <button type="button" class="btn-close-modal btn btn-link text-light fs-3" 
                                    data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>

                        <!-- Title -->
                        <h2 class="fw-bold mb-4 text-center" style="color:rgb(255, 255, 255);">Welcome Back</h2>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}" class="w-100 mt-3" id="loginForm">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-4">
                                <div class="position-relative w-100">
                                    <input type="email" 
                                        class="form-control fs-6 fw-semibold py-3 px-4 bg-white text-dark"
                                        name="email" 
                                        value="{{ old('email') }}"
                                        placeholder="Email Address"
                                        style="border-radius: 12px; border: 1px solid #eee; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);"
                                        required autofocus>
                                    <i class="fas fa-envelope position-absolute top-50 end-0 translate-middle-y me-3 fs-6 text-dark"></i>
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <div class="position-relative w-100">
                                    <input type="password" 
                                        class="form-control fs-6 fw-semibold py-3 px-4 bg-white text-dark"
                                        name="password" 
                                        placeholder="Password"
                                        style="border-radius: 12px; border: 1px solid #eee; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);"
                                        required>
                                    <i class="fas fa-lock position-absolute top-50 end-0 translate-middle-y me-3 fs-6 text-dark"></i>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                            </div>

                            <!-- Remember Me & Forgot Password -->
                            <div class="mb-4 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember_me" name="remember" style="border-radius: 4px;">
                                    <label class="form-check-label text-light" for="remember_me">
                                        Remember me
                                    </label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none text-light">
                                        Forgot password?
                                    </a>
                                @endif
                            </div>

                            <!-- Submit Button with Loading Indicator -->
                            <button type="submit" 
                                    class="btn w-100 py-3 fw-bold text-white login-submit-btn"
                                    style="background-color: #212529; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.66);">
                                <span class="login-btn-text">
                                    <i class="fas fa-sign-in-alt me-2"></i> Login
                                </span>
                                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            </button>

                            <!-- Register Link -->
                            <div class="mt-4 text-center">
                                <p class="mb-0 text-secondary">Don't have an account? 
                                    <a href="{{ route('register') }}" class="text-decoration-none text-light fw-bold register-trigger">Register here</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modals
            const loginModal = new bootstrap.Modal(document.getElementById('loginModal'));
            const registerModal = document.getElementById('registerModal') ? 
                new bootstrap.Modal(document.getElementById('registerModal')) : null;

            // Handle register trigger clicks
            document.querySelectorAll('.register-trigger').forEach(trigger => {
                trigger.addEventListener('click', function(e) {
                    e.preventDefault();
                    loginModal.hide();
                    if (registerModal) {
                        setTimeout(() => registerModal.show(), 300);
                    } else {
                        window.location.href = "{{ route('register') }}";
                    }
                });
            });

            // Clean up modal backdrop (corrected version)
            document.getElementById('loginModal').addEventListener('hidden.bs.modal', function() {
                const backdrops = document.querySelectorAll('.modal-backdrop');
                if (backdrops.length > 1) {
                    backdrops.forEach(backdrop => backdrop.remove());
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = 'visible';
                    document.body.style.paddingRight = '0';
                }
            });

            // Add loading indicator to login button
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('.login-submit-btn');
                    const btnText = submitBtn.querySelector('.login-btn-text');
                    const spinner = submitBtn.querySelector('.spinner-border');
                    
                    // Disable button and show spinner
                    submitBtn.disabled = true;
                    btnText.classList.add('d-none');
                    spinner.classList.remove('d-none');
                });
            }
        });
    </script>