{{-- resources/views/admin/stagiaires/create.blade.php --}}
<div class="modal fade stagiaire-create-modal" id="createStagiaireModal" tabindex="-1" aria-labelledby="createStagiaireModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <form action="{{ route('personnel.stagiaires.store') }}" method="POST" class="needs-validation stagiaire-create-form" novalidate enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-3 bg-white me-2">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                        <!-- Avatar Upload -->
                        <div class="stagiaire-create-avatar-container me-sm-3 mb-2 mb-sm-0">
                            <img id="avatarPreview" 
                                 src="https://ui-avatars.com/api/?name=S+T&background=ffffff&color=000000&size=50" 
                                 class="stagiaire-create-avatar border border-dark" 
                                 alt="Stagiaire photo placeholder"
                                 aria-label="Click to upload stagiaire photo">
                            <input type="file" name="avatar" id="avatarInput" 
                                   class="d-none" accept="image/*">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="stagiaire-create-title mb-0 text-black" id="createStagiaireModalLabel">
                                <i class="fas fa-user-plus me-2 text-black"></i>
                                Add New Stagiaire
                            </h5>
                            <small class="stagiaire-create-subtitle text-muted">Complete the information</small>
                            @error('avatar')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="cin" class="form-label text-black">
                                <i class="fas fa-id-card me-1 text-black"></i>CIN
                            </label>
                            <input type="text" name="cin" id="cin" 
                                   class="form-control bg-white text-black border border-secondary @error('cin') is-invalid @enderror" 
                                   value="{{ old('cin') }}" required
                                   placeholder="AB123456">
                            @error('cin')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="full_name" class="form-label text-black">
                                <i class="fas fa-user me-1 text-black"></i>Full Name
                            </label>
                            <input type="text" name="full_name" id="full_name" 
                                   class="form-control bg-white text-black border border-secondary @error('full_name') is-invalid @enderror" 
                                   value="{{ old('full_name') }}" required
                                   placeholder="First and Last Name">
                            @error('full_name')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="birth_date" class="form-label text-black">
                                <i class="fas fa-calendar-alt me-1 text-black"></i>Birth Date
                            </label>
                            <input type="date" name="birth_date" id="birth_date" 
                                   class="form-control bg-white text-black border border-secondary @error('birth_date') is-invalid @enderror" 
                                   value="{{ old('birth_date') }}" required
                                   max="{{ date('Y-m-d') }}">
                            @error('birth_date')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="genre" class="form-label text-black">
                                <i class="fas fa-venus-mars me-1 text-black"></i>Gender
                            </label>
                            <select name="genre" id="genre" 
                                    class="form-select bg-white text-black border border-secondary @error('genre') is-invalid @enderror" required>
                                <option value="" disabled selected>Select</option>
                                <option value="male" {{ old('genre') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('genre') == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('genre')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="phone_number" class="form-label text-black">
                                <i class="fas fa-phone me-1 text-black"></i>Phone Number
                            </label>
                            <input type="tel" name="phone_number" id="phone_number" 
                                   class="form-control bg-white text-black border border-secondary @error('phone_number') is-invalid @enderror" 
                                   value="{{ old('phone_number') }}" required
                                   placeholder="12345678"
                                   pattern="[0-9]{8}">
                            @error('phone_number')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="education_level" class="form-label text-black">
                                <i class="fas fa-graduation-cap me-1 text-black"></i>Education Level
                            </label>
                            <select name="education_level" id="education_level" 
                                    class="form-select bg-white text-black border border-secondary @error('education_level') is-invalid @enderror" required>
                                <option value="" disabled selected>Select</option>
                                <option value="bac" {{ old('education_level') == 'bac' ? 'selected' : '' }}>Baccalaureate</option>
                                <option value="bac_1" {{ old('education_level') == 'bac_1' ? 'selected' : '' }}>Bac+1</option>
                                <option value="bac_2" {{ old('education_level') == 'bac_2' ? 'selected' : '' }}>Bac+2</option>
                                <option value="bac_3" {{ old('education_level') == 'bac_3' ? 'selected' : '' }}>Bac+3</option>
                                <option value="bac_4" {{ old('education_level') == 'bac_4' ? 'selected' : '' }}>Bac+4</option>
                                <option value="bac_5" {{ old('education_level') == 'bac_5' ? 'selected' : '' }}>Bac+5</option>
                            </select>
                            @error('education_level')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="address" class="form-label text-black">
                            <i class="fas fa-map-marker-alt me-1 text-black"></i>Address
                        </label>
                        <textarea name="address" id="address" 
                                  class="form-control bg-white text-black border border-secondary @error('address') is-invalid @enderror" 
                                  rows="2" required
                                  placeholder="Complete address">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- School Information Section -->
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="school" class="form-label text-black">
                                <i class="fas fa-school me-1 text-black"></i>School/University
                            </label>
                            <input type="text" name="school" id="school" 
                                   class="form-control bg-white text-black border border-secondary @error('school') is-invalid @enderror" 
                                   value="{{ old('school') }}" required
                                   placeholder="School or University name">
                            @error('school')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="field_of_study" class="form-label text-black">
                                <i class="fas fa-book me-1 text-black"></i>Field of Study
                            </label>
                            <input type="text" name="field_of_study" id="field_of_study" 
                                   class="form-control bg-white text-black border border-secondary @error('field_of_study') is-invalid @enderror" 
                                   value="{{ old('field_of_study') }}" required
                                   placeholder="Field of study">
                            @error('field_of_study')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Internship Dates -->
                    <div class="row g-2">
                        <div class="col-12 col-sm-6">
                            <label for="start_date" class="form-label text-black">
                                <i class="fas fa-calendar-plus me-1 text-black"></i>Start Date
                            </label>
                            <input type="date" name="start_date" id="start_date" 
                                   class="form-control bg-white text-black border border-secondary @error('start_date') is-invalid @enderror" 
                                   value="{{ old('start_date') }}" required>
                            @error('start_date')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="end_date" class="form-label text-black">
                                <i class="fas fa-calendar-minus me-1 text-black"></i>End Date
                            </label>
                            <input type="date" name="end_date" id="end_date" 
                                   class="form-control bg-white text-black border border-secondary @error('end_date') is-invalid @enderror" 
                                   value="{{ old('end_date') }}" required>
                            @error('end_date')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-dark stagiaire-create-submit-btn">
                            <i class="fas fa-save me-1"></i>Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Stagiaire Create Modal Styles */
    .stagiaire-create-modal .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .stagiaire-create-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Avatar Upload */
    .stagiaire-create-avatar-container {
        width: 60px;
        height: 60px;
        position: relative;
        margin-right: 1rem;
    }

    .stagiaire-create-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .stagiaire-create-avatar:hover {
        opacity: 0.8;
    }

    /* Form Elements */
    .stagiaire-create-form .form-label {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .stagiaire-create-form .form-control,
    .stagiaire-create-form .form-select {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    .stagiaire-create-form .form-control:focus,
    .stagiaire-create-form .form-select:focus {
        border-color: #3f80ea;
        box-shadow: 0 0 0 0.25rem rgba(63, 128, 234, 0.25);
        background-color: #fff;
    }

    /* Submit Button */
    .stagiaire-create-submit-btn {
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .stagiaire-create-avatar-container {
            width: 50px;
            height: 50px;
        }
        
        .stagiaire-create-form .form-label {
            font-size: 0.75rem;
        }
        
        .stagiaire-create-form .form-control,
        .stagiaire-create-form .form-select {
            font-size: 0.85rem;
            padding: 0.4rem 0.65rem;
        }
    }

    @media (max-width: 767.98px) {
        .stagiaire-create-modal .modal-dialog {
            max-width: 100%;
            margin: 0.5rem auto;
        }
    }

    @media (max-width: 575.98px) {
        .stagiaire-create-modal .modal-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 1rem;
        }
        
        .stagiaire-create-avatar-container {
            margin-bottom: 0.75rem;
            margin-right: 0;
        }
        
        .stagiaire-create-form .row > div {
            margin-bottom: 0.75rem;
        }
        
        .stagiaire-create-submit-btn {
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Avatar upload functionality
    const avatarInput = document.getElementById('avatarInput');
    const avatarPreview = document.getElementById('avatarPreview');
    if (avatarPreview) {
        avatarPreview.addEventListener('click', function() {
            avatarInput.click();
        });
    }
    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    alert('Image size must not exceed 2MB');
                    this.value = '';
                    return;
                }
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Only JPEG, PNG and GIF files are allowed');
                    this.value = '';
                    return;
                }
                const reader = new FileReader();
                reader.onload = function(event) {
                    avatarPreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Form validation
    const form = document.querySelector('#createStagiaireModal form.needs-validation');
    if (form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }
    
    // Update avatar initials when name changes
    const fullNameInput = document.getElementById('full_name');
    if (fullNameInput && avatarPreview) {
        fullNameInput.addEventListener('input', function() {
            if (!avatarInput.files.length && this.value) {
                const names = this.value.split(' ');
                const initials = (names[0].charAt(0) + (names[1] ? names[1].charAt(0) : '').toUpperCase();
                avatarPreview.src = `https://ui-avatars.com/api/?name=${initials}&background=3f80ea&color=ffffff&size=50`;
            }
        });
    }
    
    // Date validation - end date must be after start date
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');
    
    if (startDateInput && endDateInput) {
        startDateInput.addEventListener('change', function() {
            endDateInput.min = this.value;
        });
        
        endDateInput.addEventListener('change', function() {
            if (startDateInput.value && this.value < startDateInput.value) {
                alert('End date must be after start date');
                this.value = '';
            }
        });
    }
});
</script>