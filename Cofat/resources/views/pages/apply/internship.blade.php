<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Application - COFAT Kairouan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" href="{{ asset('images/apply.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="{{ asset('css/pages/apply/internship.css') }}">
</head>
<body>
    <!-- Header -->
    @include('components.header')

    <!-- Hero Section -->
    <section class="hero text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Internship Application</h1>
            <p class="lead mb-0">
                Apply for office or factory internships
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
                <h4 class="mb-4">Select the type of internship:</h4>
                <div class="d-flex justify-content-center">
                    <button id="office-btn" class="btn btn-outline-dark position-selector-btn active">
                        <i class="fas fa-briefcase me-2"></i> Office Internship
                    </button>
                    <button id="factory-btn" class="btn btn-outline-dark position-selector-btn">
                        <i class="fas fa-industry me-2"></i> Factory Internship
                    </button>
                </div>
            </div>

            <!-- Office Internship Form -->
                <form id="office-internship-form" method="POST" action="/apply/submit" enctype="multipart/form-data" class="form-section d-none">
                    @csrf
                    <input type="hidden" name="application_type" value="internship">
                    <input type="hidden" name="position_type" value="office">
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="internship_cin" class="form-label fw-bold">
                                <i class="fas fa-id-card form-icon"></i> CIN
                            </label>
                            <input type="text" class="form-control form-control-lg" id="internship_cin" name="cin" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="internship_first_name" class="form-label fw-bold">
                                <i class="fas fa-user form-icon"></i> First Name
                            </label>
                            <input type="text" class="form-control form-control-lg" id="internship_first_name" name="first_name" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="internship_last_name" class="form-label fw-bold">
                                <i class="fas fa-user form-icon"></i> Last Name
                            </label>
                            <input type="text" class="form-control form-control-lg" id="internship_last_name" name="last_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="internship_age" class="form-label fw-bold">
                                <i class="fas fa-calendar-alt form-icon"></i> Age
                            </label>
                            <input type="number" min="16" max="30" class="form-control form-control-lg" id="internship_age" name="age" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="internship_phone" class="form-label fw-bold">
                                <i class="fas fa-phone form-icon"></i> Phone Number
                            </label>
                            <input type="tel" class="form-control form-control-lg" id="internship_phone" name="phone" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="internship_email" class="form-label fw-bold">
                                <i class="fas fa-envelope form-icon"></i> Email
                            </label>
                            <input type="email" class="form-control form-control-lg" id="internship_email" name="email" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="internship_education_level" class="form-label fw-bold">
                                <i class="fas fa-graduation-cap form-icon"></i> Education Level
                            </label>
                            <select class="form-select form-control-lg" id="internship_education_level" name="education_level" required>
                                <option value="">Select education level</option>
                                <option value="high_school">High School</option>
                                <option value="bachelor">Bachelor's Degree</option>
                                <option value="master">Master's Degree</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="internship_school" class="form-label fw-bold">
                                <i class="fas fa-school form-icon"></i> School/University
                            </label>
                            <input type="text" class="form-control form-control-lg" id="internship_school" name="school" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="internship_field" class="form-label fw-bold">
                                <i class="fas fa-book form-icon"></i> Field of Study
                            </label>
                            <input type="text" class="form-control form-control-lg" id="internship_field" name="field_of_study" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="internship_duration" class="form-label fw-bold">
                                <i class="fas fa-clock form-icon"></i> Preferred Duration (weeks)
                            </label>
                            <select class="form-select form-control-lg" id="internship_duration" name="duration" required>
                                <option value="">Select duration</option>
                                <option value="4">4 weeks</option>
                                <option value="6">6 weeks</option>
                                <option value="8">8 weeks</option>
                                <option value="12">12 weeks</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="internship_cv" class="form-label fw-bold">
                            <i class="fas fa-file-pdf form-icon"></i> Upload CV (PDF)
                        </label>
                        <input type="file" class="form-control form-control-lg" id="internship_cv" name="cv" accept=".pdf" required>
                    </div>

                    <div class="mb-4">
                        <label for="internship_cover_letter" class="form-label fw-bold">
                            <i class="fas fa-file-alt form-icon"></i> Cover Letter (Optional)
                        </label>
                        <textarea class="form-control form-control-lg" id="internship_cover_letter" name="cover_letter" rows="5"></textarea>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="internship_terms" name="terms" required>
                        <label class="form-check-label" for="internship_terms">
                            I certify that the information provided is accurate and complete
                        </label>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-apply">
                            <i class="fas fa-paper-plane me-2"></i> Submit Application
                        </button>
                    </div>
                </form>

                <!-- Factory Internship Form -->
                <form id="factory-internship-form" method="POST" action="/apply/submit" enctype="multipart/form-data" class="form-section d-none">
                    @csrf
                    <input type="hidden" name="application_type" value="internship">
                    <input type="hidden" name="position_type" value="factory">
                    
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="factory_internship_cin" class="form-label fw-bold">
                                <i class="fas fa-id-card form-icon"></i> CIN
                            </label>
                            <input type="text" class="form-control form-control-lg" id="factory_internship_cin" name="cin" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="factory_internship_first_name" class="form-label fw-bold">
                                <i class="fas fa-user form-icon"></i> First Name
                            </label>
                            <input type="text" class="form-control form-control-lg" id="factory_internship_first_name" name="first_name" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="factory_internship_last_name" class="form-label fw-bold">
                                <i class="fas fa-user form-icon"></i> Last Name
                            </label>
                            <input type="text" class="form-control form-control-lg" id="factory_internship_last_name" name="last_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="factory_internship_age" class="form-label fw-bold">
                                <i class="fas fa-calendar-alt form-icon"></i> Age
                            </label>
                            <input type="number" min="16" max="30" class="form-control form-control-lg" id="factory_internship_age" name="age" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label for="factory_internship_phone" class="form-label fw-bold">
                                <i class="fas fa-phone form-icon"></i> Phone Number
                            </label>
                            <input type="tel" class="form-control form-control-lg" id="factory_internship_phone" name="phone" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="factory_internship_email" class="form-label fw-bold">
                                <i class="fas fa-envelope form-icon"></i> Email
                            </label>
                            <input type="email" class="form-control form-control-lg" id="factory_internship_email" name="email" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="factory_internship_education_level" class="form-label fw-bold">
                                <i class="fas fa-graduation-cap form-icon"></i> Education Level
                            </label>
                            <select class="form-select form-control-lg" id="factory_internship_education_level" name="education_level" required>
                                <option value="">Select education level</option>
                                <option value="high_school">High School</option>
                                <option value="vocational">Vocational Training</option>
                                <option value="bachelor">Bachelor's Degree</option>
                                <option value="master">Master's Degree</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="factory_internship_school" class="form-label fw-bold">
                                <i class="fas fa-school form-icon"></i> School/University
                            </label>
                            <input type="text" class="form-control form-control-lg" id="factory_internship_school" name="school" required>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="factory_internship_field" class="form-label fw-bold">
                                <i class="fas fa-book form-icon"></i> Field of Study
                            </label>
                            <input type="text" class="form-control form-control-lg" id="factory_internship_field" name="field_of_study" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="factory_internship_duration" class="form-label fw-bold">
                                <i class="fas fa-clock form-icon"></i> Preferred Duration (weeks)
                            </label>
                            <select class="form-select form-control-lg" id="factory_internship_duration" name="duration" required>
                                <option value="">Select duration</option>
                                <option value="4">4 weeks</option>
                                <option value="6">6 weeks</option>
                                <option value="8">8 weeks</option>
                                <option value="12">12 weeks</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="factory_internship_cv" class="form-label fw-bold">
                            <i class="fas fa-file-pdf form-icon"></i> Upload CV (PDF)
                        </label>
                        <input type="file" class="form-control form-control-lg" id="factory_internship_cv" name="cv" accept=".pdf" required>
                    </div>

                    <div class="mb-4">
                        <label for="factory_internship_cover_letter" class="form-label fw-bold">
                            <i class="fas fa-file-alt form-icon"></i> Cover Letter (Optional)
                        </label>
                        <textarea class="form-control form-control-lg" id="factory_internship_cover_letter" name="cover_letter" rows="5"></textarea>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="factory_internship_terms" name="terms" required>
                        <label class="form-check-label" for="factory_internship_terms">
                            I certify that the information provided is accurate and complete
                        </label>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the form elements
        const officeForm = document.getElementById('office-internship-form');
        const factoryForm = document.getElementById('factory-internship-form');
        const officeBtn = document.getElementById('office-btn');
        const factoryBtn = document.getElementById('factory-btn');

        // Show office form by default
        officeForm.classList.remove('d-none');
        officeForm.classList.add('active');

        // Toggle between office and factory forms
        officeBtn.addEventListener('click', function() {
            officeForm.classList.remove('d-none');
            officeForm.classList.add('active');
            factoryForm.classList.add('d-none');
            factoryForm.classList.remove('active');
            this.classList.add('active');
            factoryBtn.classList.remove('active');
        });
        
        factoryBtn.addEventListener('click', function() {
            factoryForm.classList.remove('d-none');
            factoryForm.classList.add('active');
            officeForm.classList.add('d-none');
            officeForm.classList.remove('active');
            this.classList.add('active');
            officeBtn.classList.remove('active');
        });
        
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