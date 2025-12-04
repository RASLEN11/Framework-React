<!-- Registration Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="background-color: rgba(255, 255, 255, 0);">
            <div class="modal-body p-0">
                <!-- Registration Container -->
                <div class="container-fluid d-flex flex-column justify-content-start align-items-center py-2 px-3">
                    <!-- Close Button -->
                    <div class="w-100 d-flex justify-content-end pe-1">
                        <button type="button" class="btn-close-modal btn btn-link text-light fs-3" 
                                data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <!-- Title -->
                    <h2 class="fw-bold mb-4 text-center" style="color:rgb(255, 255, 255);">Join Our Community</h2>

                    <!-- Error Messages -->
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show w-100 mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Registration Form -->
                    <form method="POST" action="{{ route('register') }}" class="w-100 mt-3" id="registerForm">
                        @csrf

                        <!-- Name and Email in one row -->
                        <div class="row mb-4">
                            <!-- Name -->
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="position-relative w-100">
                                    <input type="text" 
                                        class="form-control fs-6 fw-semibold py-3 px-4 bg-white text-dark"
                                        id="name"
                                        name="name" 
                                        value="{{ old('name') }}"
                                        placeholder="Full Name"
                                        style="border-radius: 12px; border: 1px solid #eee; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);"
                                        required autofocus>
                                    <i class="fas fa-user position-absolute top-50 end-0 translate-middle-y me-3 fs-6 text-dark"></i>
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                            </div>
                            
                            <!-- Email Address -->
                            <div class="col-md-6">
                                <div class="position-relative w-100">
                                    <input type="email" 
                                        class="form-control fs-6 fw-semibold py-3 px-4 bg-white text-dark"
                                        id="email"
                                        name="email" 
                                        value="{{ old('email') }}"
                                        placeholder="Email Address"
                                        style="border-radius: 12px; border: 1px solid #eee; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);"
                                        required>
                                    <i class="fas fa-envelope position-absolute top-50 end-0 translate-middle-y me-3 fs-6 text-dark"></i>
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                            </div>
                        </div>

                        <!-- Password and Confirm Password in one row -->
                        <div class="row mb-4">
                            <!-- Password -->
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="position-relative w-100">
                                    <input type="password" 
                                        class="form-control fs-6 fw-semibold py-3 px-4 bg-white text-dark"
                                        id="password"
                                        name="password" 
                                        placeholder="Password"
                                        style="border-radius: 12px; border: 1px solid #eee; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);"
                                        required>
                                    <i class="fas fa-lock position-absolute top-50 end-0 translate-middle-y me-3 fs-6 text-dark"></i>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                <div class="form-text ps-2 mt-1 text-light">Minimum 8 characters</div>
                            </div>
                            
                            <!-- Confirm Password -->
                            <div class="col-md-6">
                                <div class="position-relative w-100">
                                    <input type="password" 
                                        class="form-control fs-6 fw-semibold py-3 px-4 bg-white text-dark"
                                        id="password_confirmation"
                                        name="password_confirmation" 
                                        placeholder="Confirm Password"
                                        style="border-radius: 12px; border: 1px solid #eee; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);"
                                        required>
                                    <i class="fas fa-check-circle position-absolute top-50 end-0 translate-middle-y me-3 fs-6 text-dark"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Terms Checkbox -->
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms" name="terms" style="border-radius: 4px; backgrounf-color: black;" required>
                                <label class="form-check-label text-light" for="terms">
                                    I agree to the <a href="/terms" class="text-decoration-none text-light">terms and conditions</a>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button with Loading Indicator -->
                        <button type="submit" 
                                class="btn w-100 py-3 fw-bold text-white register-submit-btn"
                                style="background-color: #212529; border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.66);">
                            <span class="register-btn-text">
                                <i class="fas fa-user-plus me-2"></i> Register
                            </span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>

                        <!-- Login Link -->
                        <div class="mt-4 text-center">
                            <p class="mb-0 text-secondary">Already have an account? 
                                <a href="{{ route('login') }}" class="text-decoration-none text-light fw-bold login-trigger">Login here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize modals
        const registerModal = new bootstrap.Modal(document.getElementById('registerModal'));
        const loginModal = document.getElementById('loginModal') ? 
            new bootstrap.Modal(document.getElementById('loginModal')) : null;

        // Handle login trigger clicks
        document.querySelectorAll('.login-trigger').forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                registerModal.hide();
                if (loginModal) {
                    setTimeout(() => loginModal.show(), 300);
                } else {
                    window.location.href = "{{ route('login') }}";
                }
            });
        });

        // Clean up modal backdrop (matching login modal)
        document.getElementById('registerModal').addEventListener('hidden.bs.modal', function() {
            const backdrops = document.querySelectorAll('.modal-backdrop');
            if (backdrops.length > 1) {
                backdrops.forEach(backdrop => backdrop.remove());
                document.body.classList.remove('modal-open');
                document.body.style.overflow = 'visible';
                document.body.style.paddingRight = '0';
            }
        });

        // Add loading indicator to register button
        const registerForm = document.getElementById('registerForm');
        if (registerForm) {
            registerForm.addEventListener('submit', function() {
                const submitBtn = this.querySelector('.register-submit-btn');
                const btnText = submitBtn.querySelector('.register-btn-text');
                const spinner = submitBtn.querySelector('.spinner-border');
                
                // Disable button and show spinner
                submitBtn.disabled = true;
                btnText.classList.add('d-none');
                spinner.classList.remove('d-none');
            });
        }
    });
</script>