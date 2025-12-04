<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COFAT Kairouan | Job Application</title>
    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style">
    
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/pages/apply/jobapply.css') }}">
    
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/apply.svg') }}" type="image/svg+xml">
</head>
<body class="job-apply-page">
    <!-- Skip to main content link for accessibility -->
    <a href="#main-content" class="visually-hidden-focusable">Skip to main content</a>
    
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section -->
    <section class="hero text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Job Application</h1>
            <p class="lead mb-0">
                Apply for office or factory positions
            </p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="card application-card">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Position Type Selection -->
            <div class="text-center mb-5">
                <h4 class="mb-4">Select the type of position:</h4>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <button id="office-btn" class="btn btn-outline-dark position-selector-btn active">
                        <i class="fas fa-briefcase me-2"></i> Office
                    </button>
                    <button id="factory-btn" class="btn btn-outline-dark position-selector-btn">
                        <i class="fas fa-industry me-2"></i> Factory
                    </button>
                </div>
            </div>

            <!-- Office Form -->
            <form action="{{ route('apply.submit') }}" method="POST" enctype="multipart/form-data" class="form-section {{ (request()->get('type') ?? 'office') === 'office' ? 'active' : '' }}">
                @csrf
                <input type="hidden" name="application_type" value="office">
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="cin" class="form-label fw-bold">
                            <i class="fas fa-id-card form-icon"></i> CIN
                        </label>
                        <input type="text" class="form-control form-control-lg" id="cin" name="cin" value="{{ old('cin') }}" required>
                        @if($errors->has('cin'))
                            <div class="text-danger mt-2">{{ $errors->first('cin') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="first_name" class="form-label fw-bold">
                            <i class="fas fa-user form-icon"></i> First Name
                        </label>
                        <input type="text" class="form-control form-control-lg" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @if($errors->has('first_name'))
                            <div class="text-danger mt-2">{{ $errors->first('first_name') }}</div>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label fw-bold">
                            <i class="fas fa-user form-icon"></i> Last Name
                        </label>
                        <input type="text" class="form-control form-control-lg" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @if($errors->has('last_name'))
                            <div class="text-danger mt-2">{{ $errors->first('last_name') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="age" class="form-label fw-bold">
                            <i class="fas fa-calendar-alt form-icon"></i> Age
                        </label>
                        <input type="number" min="18" max="65" class="form-control form-control-lg" id="age" name="age" value="{{ old('age') }}" required>
                        @if($errors->has('age'))
                            <div class="text-danger mt-2">{{ $errors->first('age') }}</div>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="phone" class="form-label fw-bold">
                            <i class="fas fa-phone form-icon"></i> Phone Number
                        </label>
                        <input type="tel" class="form-control form-control-lg" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @if($errors->has('phone'))
                            <div class="text-danger mt-2">{{ $errors->first('phone') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label fw-bold">
                            <i class="fas fa-envelope form-icon"></i> Email
                        </label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" value="{{ old('email') }}" required>
                        @if($errors->has('email'))
                            <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="education_level" class="form-label fw-bold">
                            <i class="fas fa-graduation-cap form-icon"></i> Education Level
                        </label>
                        <select class="form-select form-control-lg" id="education_level" name="education_level" required>
                            <option value="">Select education level</option>
                            <option value="primary" {{ old('education_level') == 'primary' ? 'selected' : '' }}>Primary School</option>
                            <option value="secondary" {{ old('education_level') == 'secondary' ? 'selected' : '' }}>Secondary School</option>
                            <option value="high_school" {{ old('education_level') == 'high_school' ? 'selected' : '' }}>High School</option>
                            <option value="bachelor" {{ old('education_level') == 'bachelor' ? 'selected' : '' }}>Bachelor's Degree</option>
                            <option value="master" {{ old('education_level') == 'master' ? 'selected' : '' }}>Master's Degree</option>
                            <option value="phd" {{ old('education_level') == 'phd' ? 'selected' : '' }}>PhD</option>
                        </select>
                        @if($errors->has('education_level'))
                            <div class="text-danger mt-2">{{ $errors->first('education_level') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="office_position" class="form-label fw-bold">
                            <i class="fas fa-briefcase form-icon"></i> Office Position
                        </label>
                        <select class="form-select form-control-lg" id="office_position" name="position" required>
                            <option value="">Select office position</option>
                            <option value="accountant" {{ old('position') == 'accountant' ? 'selected' : '' }}>Accountant</option>
                            <option value="hr_manager" {{ old('position') == 'hr_manager' ? 'selected' : '' }}>HR Manager</option>
                            <option value="admin_assistant" {{ old('position') == 'admin_assistant' ? 'selected' : '' }}>Administrative Assistant</option>
                            <option value="sales_representative" {{ old('position') == 'sales_representative' ? 'selected' : '' }}>Sales Representative</option>
                            <option value="it_specialist" {{ old('position') == 'it_specialist' ? 'selected' : '' }}>IT Specialist</option>
                            <option value="other_office" {{ old('position') == 'other_office' ? 'selected' : '' }}>Other Office Position</option>
                        </select>
                        @if($errors->has('position'))
                            <div class="text-danger mt-2">{{ $errors->first('position') }}</div>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <label for="cv" class="form-label fw-bold">
                        <i class="fas fa-file-pdf form-icon"></i> Upload CV (PDF)
                    </label>
                    <input type="file" class="form-control form-control-lg" id="cv" name="cv" accept=".pdf" required>
                    @if($errors->has('cv'))
                        <div class="text-danger mt-2">{{ $errors->first('cv') }}</div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="cover_letter" class="form-label fw-bold">
                        <i class="fas fa-file-alt form-icon"></i> Cover Letter (Optional)
                    </label>
                    <textarea class="form-control form-control-lg" id="cover_letter" name="cover_letter" rows="5">{{ old('cover_letter') }}</textarea>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="terms" name="terms" required>
                    <label class="form-check-label" for="terms">
                        I certify that the information provided is accurate and complete
                    </label>
                    @if($errors->has('terms'))
                        <div class="text-danger mt-2">You must certify the information</div>
                    @endif
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-apply">
                        <i class="fas fa-paper-plane me-2"></i> Submit Application
                    </button>
                </div>
            </form>

            <!-- Factory Form -->
            <form id="factory-form" method="POST" action="{{ route('apply.submit') }}" enctype="multipart/form-data" class="form-section {{ request()->get('type') === 'factory' ? 'active' : '' }}">
                @csrf
                <input type="hidden" name="application_type" value="factory">
                
                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="factory_cin" class="form-label fw-bold">
                            <i class="fas fa-id-card form-icon"></i> CIN
                        </label>
                        <input type="text" class="form-control form-control-lg" id="factory_cin" name="cin" value="{{ old('cin') }}" required>
                        @if($errors->has('cin'))
                            <div class="text-danger mt-2">{{ $errors->first('cin') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="factory_first_name" class="form-label fw-bold">
                            <i class="fas fa-user form-icon"></i> First Name
                        </label>
                        <input type="text" class="form-control form-control-lg" id="factory_first_name" name="first_name" value="{{ old('first_name') }}" required>
                        @if($errors->has('first_name'))
                            <div class="text-danger mt-2">{{ $errors->first('first_name') }}</div>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="factory_last_name" class="form-label fw-bold">
                            <i class="fas fa-user form-icon"></i> Last Name
                        </label>
                        <input type="text" class="form-control form-control-lg" id="factory_last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @if($errors->has('last_name'))
                            <div class="text-danger mt-2">{{ $errors->first('last_name') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="factory_age" class="form-label fw-bold">
                            <i class="fas fa-calendar-alt form-icon"></i> Age
                        </label>
                        <input type="number" min="18" max="65" class="form-control form-control-lg" id="factory_age" name="age" value="{{ old('age') }}" required>
                        @if($errors->has('age'))
                            <div class="text-danger mt-2">{{ $errors->first('age') }}</div>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <label for="factory_phone" class="form-label fw-bold">
                            <i class="fas fa-phone form-icon"></i> Phone Number
                        </label>
                        <input type="tel" class="form-control form-control-lg" id="factory_phone" name="phone" value="{{ old('phone') }}" required>
                        @if($errors->has('phone'))
                            <div class="text-danger mt-2">{{ $errors->first('phone') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="factory_email" class="form-label fw-bold">
                            <i class="fas fa-envelope form-icon"></i> Email
                        </label>
                        <input type="email" class="form-control form-control-lg" id="factory_email" name="email" value="{{ old('email') }}" required>
                        @if($errors->has('email'))
                            <div class="text-danger mt-2">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <label for="factory_education_level" class="form-label fw-bold">
                            <i class="fas fa-graduation-cap form-icon"></i> Education Level
                        </label>
                        <select class="form-select form-control-lg" id="factory_education_level" name="education_level" required>
                            <option value="">Select education level</option>
                            <option value="primary" {{ old('education_level') == 'primary' ? 'selected' : '' }}>Primary School</option>
                            <option value="secondary" {{ old('education_level') == 'secondary' ? 'selected' : '' }}>Secondary School</option>
                            <option value="high_school" {{ old('education_level') == 'high_school' ? 'selected' : '' }}>High School</option>
                            <option value="bachelor" {{ old('education_level') == 'bachelor' ? 'selected' : '' }}>Bachelor's Degree</option>
                            <option value="master" {{ old('education_level') == 'master' ? 'selected' : '' }}>Master's Degree</option>
                            <option value="phd" {{ old('education_level') == 'phd' ? 'selected' : '' }}>PhD</option>
                        </select>
                        @if($errors->has('education_level'))
                            <div class="text-danger mt-2">{{ $errors->first('education_level') }}</div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="factory_position" class="form-label fw-bold">
                            <i class="fas fa-industry form-icon"></i> Factory Position
                        </label>
                        <select class="form-select form-control-lg" id="factory_position" name="position" required>
                            <option value="">Select factory position</option>
                            <option value="machine_operator" {{ old('position') == 'machine_operator' ? 'selected' : '' }}>Machine Operator</option>
                            <option value="quality_control" {{ old('position') == 'quality_control' ? 'selected' : '' }}>Quality Control</option>
                            <option value="production_supervisor" {{ old('position') == 'production_supervisor' ? 'selected' : '' }}>Production Supervisor</option>
                            <option value="warehouse_worker" {{ old('position') == 'warehouse_worker' ? 'selected' : '' }}>Warehouse Worker</option>
                            <option value="maintenance_technician" {{ old('position') == 'maintenance_technician' ? 'selected' : '' }}>Maintenance Technician</option>
                            <option value="other_factory" {{ old('position') == 'other_factory' ? 'selected' : '' }}>Other Factory Position</option>
                        </select>
                        @if($errors->has('position'))
                            <div class="text-danger mt-2">{{ $errors->first('position') }}</div>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <label for="factory_cv" class="form-label fw-bold">
                        <i class="fas fa-file-pdf form-icon"></i> Upload CV (PDF)
                    </label>
                    <input type="file" class="form-control form-control-lg" id="factory_cv" name="cv" accept=".pdf" required>
                    @if($errors->has('cv'))
                        <div class="text-danger mt-2">{{ $errors->first('cv') }}</div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="factory_cover_letter" class="form-label fw-bold">
                        <i class="fas fa-file-alt form-icon"></i> Cover Letter (Optional)
                    </label>
                    <textarea class="form-control form-control-lg" id="factory_cover_letter" name="cover_letter" rows="5">{{ old('cover_letter') }}</textarea>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="factory_terms" name="terms" required>
                    <label class="form-check-label" for="factory_terms">
                        I certify that the information provided is accurate and complete
                    </label>
                    @if($errors->has('terms'))
                        <div class="text-danger mt-2">You must certify the information</div>
                    @endif
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-apply">
                        <i class="fas fa-paper-plane me-2"></i> Submit Application
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    @include('components.footer')

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get references to all elements we need
            const officeBtn = document.getElementById('office-btn');
            const factoryBtn = document.getElementById('factory-btn');
            const officeForm = document.querySelector('form[action="{{ route('apply.submit') }}"]');
            const factoryForm = document.getElementById('factory-form');
            
            // Function to switch to office form
            function showOfficeForm() {
                officeForm.classList.add('active');
                factoryForm.classList.remove('active');
                officeBtn.classList.add('active');
                factoryBtn.classList.remove('active');
            }
            
            // Function to switch to factory form
            function showFactoryForm() {
                factoryForm.classList.add('active');
                officeForm.classList.remove('active');
                factoryBtn.classList.add('active');
                officeBtn.classList.remove('active');
            }
            
            // Set up event listeners
            officeBtn.addEventListener('click', showOfficeForm);
            factoryBtn.addEventListener('click', showFactoryForm);
            
            // Initialize the correct form based on URL parameter or default to office
            const urlParams = new URLSearchParams(window.location.search);
            const type = urlParams.get('type');
            
            if (type === 'factory') {
                showFactoryForm();
            } else {
                showOfficeForm();
            }
            
            // Form validation
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const terms = form.querySelector('[name="terms"]');
                    const cv = form.querySelector('[name="cv"]');
                    
                    if (!terms.checked) {
                        alert('Please certify that the information provided is accurate');
                        e.preventDefault();
                    }
                    
                    if (cv.files.length > 0) {
                        const fileSize = cv.files[0].size / 1024 / 1024; // in MB
                        if (fileSize > 5) {
                            alert('CV file size should not exceed 5MB');
                            e.preventDefault();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>