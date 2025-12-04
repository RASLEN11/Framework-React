{{-- resources/views/admin/stagiaires/edit.blade.php --}}
<div class="modal fade stagiaire-edit-modal" id="editStagiaireModal{{ $stagiaire->id }}" tabindex="-1" aria-labelledby="editStagiaireModalLabel{{ $stagiaire->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <form action="{{ route('personnel.stagiaires.update', $stagiaire->id) }}" method="POST" class="needs-validation stagiaire-edit-form" novalidate enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body p-3 bg-white me-2">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                        <!-- Avatar Upload -->
                        <div class="stagiaire-edit-avatar-container me-sm-3 mb-2 mb-sm-0">
                            @if($stagiaire->avatar)
                                <img id="avatarPreviewEdit{{ $stagiaire->id }}" 
                                     src="{{ asset('storage/' . $stagiaire->avatar) }}" 
                                     class="stagiaire-edit-avatar border border-dark" 
                                     alt="{{ $stagiaire->full_name }}"
                                     aria-label="Click to upload stagiaire photo"
                                     onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'">
                            @else
                                <img id="avatarPreviewEdit{{ $stagiaire->id }}" 
                                     src="https://ui-avatars.com/api/?name={{ strtoupper(substr($stagiaire->full_name, 0, 1)) }}&background=ffffff&color=000000&size=50" 
                                     class="stagiaire-edit-avatar border border-dark" 
                                     alt="{{ $stagiaire->full_name }}"
                                     aria-label="Click to upload stagiaire photo">
                            @endif
                            <input type="file" name="avatar" id="avatarInputEdit{{ $stagiaire->id }}" 
                                   class="d-none" accept="image/*">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="stagiaire-edit-title mb-0 text-black" id="editStagiaireModalLabel{{ $stagiaire->id }}">
                                <i class="fas fa-user-edit me-2 text-black"></i>
                                Edit Stagiaire: {{ $stagiaire->full_name }}
                            </h5>
                            <small class="stagiaire-edit-subtitle text-muted">Update the information</small>
                            @error('avatar')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="edit_cin" class="form-label text-black">
                                <i class="fas fa-id-card me-1 text-black"></i>CIN
                            </label>
                            <input type="text" name="cin" id="edit_cin" 
                                   class="form-control bg-white text-black border border-secondary @error('cin') is-invalid @enderror" 
                                   value="{{ old('cin', $stagiaire->cin) }}" required
                                   placeholder="AB123456">
                            @error('cin')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="edit_full_name" class="form-label text-black">
                                <i class="fas fa-user me-1 text-black"></i>Full Name
                            </label>
                            <input type="text" name="full_name" id="edit_full_name" 
                                   class="form-control bg-white text-black border border-secondary @error('full_name') is-invalid @enderror" 
                                   value="{{ old('full_name', $stagiaire->full_name) }}" required
                                   placeholder="First and Last Name">
                            @error('full_name')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="edit_birth_date" class="form-label text-black">
                                <i class="fas fa-calendar-alt me-1 text-black"></i>Birth Date
                            </label>
                            <input type="date" name="birth_date" id="edit_birth_date" 
                                   class="form-control bg-white text-black border border-secondary @error('birth_date') is-invalid @enderror" 
                                   value="{{ old('birth_date', $stagiaire->birth_date->format('Y-m-d')) }}" required
                                   max="{{ date('Y-m-d') }}">
                            @error('birth_date')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="edit_genre" class="form-label text-black">
                                <i class="fas fa-venus-mars me-1 text-black"></i>Gender
                            </label>
                            <select name="genre" id="edit_genre" 
                                    class="form-select bg-white text-black border border-secondary @error('genre') is-invalid @enderror" required>
                                <option value="" disabled>Select</option>
                                <option value="male" {{ old('genre', $stagiaire->genre) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('genre', $stagiaire->genre) == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('genre')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="edit_phone_number" class="form-label text-black">
                                <i class="fas fa-phone me-1 text-black"></i>Phone Number
                            </label>
                            <input type="tel" name="phone_number" id="edit_phone_number" 
                                   class="form-control bg-white text-black border border-secondary @error('phone_number') is-invalid @enderror" 
                                   value="{{ old('phone_number', $stagiaire->phone_number) }}" required
                                   placeholder="12345678"
                                   pattern="[0-9]{8}">
                            @error('phone_number')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="edit_education_level" class="form-label text-black">
                                <i class="fas fa-graduation-cap me-1 text-black"></i>Education Level
                            </label>
                            <select name="education_level" id="edit_education_level" 
                                    class="form-select bg-white text-black border border-secondary @error('education_level') is-invalid @enderror" required>
                                <option value="" disabled>Select</option>
                                <option value="bac" {{ old('education_level', $stagiaire->education_level) == 'bac' ? 'selected' : '' }}>Baccalaureate</option>
                                <option value="bac_1" {{ old('education_level', $stagiaire->education_level) == 'bac_1' ? 'selected' : '' }}>Bac+1</option>
                                <option value="bac_2" {{ old('education_level', $stagiaire->education_level) == 'bac_2' ? 'selected' : '' }}>Bac+2</option>
                                <option value="bac_3" {{ old('education_level', $stagiaire->education_level) == 'bac_3' ? 'selected' : '' }}>Bac+3</option>
                                <option value="bac_4" {{ old('education_level', $stagiaire->education_level) == 'bac_4' ? 'selected' : '' }}>Bac+4</option>
                                <option value="bac_5" {{ old('education_level', $stagiaire->education_level) == 'bac_5' ? 'selected' : '' }}>Bac+5</option>
                            </select>
                            @error('education_level')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="edit_address" class="form-label text-black">
                            <i class="fas fa-map-marker-alt me-1 text-black"></i>Address
                        </label>
                        <textarea name="address" id="edit_address" 
                                  class="form-control bg-white text-black border border-secondary @error('address') is-invalid @enderror" 
                                  rows="2" required
                                  placeholder="Complete address">{{ old('address', $stagiaire->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- School Information Section -->
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="edit_school" class="form-label text-black">
                                <i class="fas fa-school me-1 text-black"></i>School/University
                            </label>
                            <input type="text" name="school" id="edit_school" 
                                   class="form-control bg-white text-black border border-secondary @error('school') is-invalid @enderror" 
                                   value="{{ old('school', $stagiaire->school) }}" required
                                   placeholder="School or University name">
                            @error('school')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="edit_field_of_study" class="form-label text-black">
                                <i class="fas fa-book me-1 text-black"></i>Field of Study
                            </label>
                            <input type="text" name="field_of_study" id="edit_field_of_study" 
                                   class="form-control bg-white text-black border border-secondary @error('field_of_study') is-invalid @enderror" 
                                   value="{{ old('field_of_study', $stagiaire->field_of_study) }}" required
                                   placeholder="Field of study">
                            @error('field_of_study')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Internship Dates -->
                    <div class="row g-2">
                        <div class="col-12 col-sm-6">
                            <label for="edit_start_date" class="form-label text-black">
                                <i class="fas fa-calendar-plus me-1 text-black"></i>Start Date
                            </label>
                            <input type="date" name="start_date" id="edit_start_date" 
                                   class="form-control bg-white text-black border border-secondary @error('start_date') is-invalid @enderror" 
                                   value="{{ old('start_date', $stagiaire->start_date->format('Y-m-d')) }}" required>
                            @error('start_date')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="edit_end_date" class="form-label text-black">
                                <i class="fas fa-calendar-minus me-1 text-black"></i>End Date
                            </label>
                            <input type="date" name="end_date" id="edit_end_date" 
                                   class="form-control bg-white text-black border border-secondary @error('end_date') is-invalid @enderror" 
                                   value="{{ old('end_date', $stagiaire->end_date->format('Y-m-d')) }}" required>
                            @error('end_date')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-dark stagiaire-edit-submit-btn">
                            <i class="fas fa-save me-1"></i>Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Stagiaire Edit Modal Styles */
    .stagiaire-edit-modal .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .stagiaire-edit-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Avatar Upload */
    .stagiaire-edit-avatar-container {
        width: 60px;
        height: 60px;
        position: relative;
        margin-right: 1rem;
    }

    .stagiaire-edit-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .stagiaire-edit-avatar:hover {
        opacity: 0.8;
    }

    /* Form Elements */
    .stagiaire-edit-form .form-label {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .stagiaire-edit-form .form-control,
    .stagiaire-edit-form .form-select {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    .stagiaire-edit-form .form-control:focus,
    .stagiaire-edit-form .form-select:focus {
        border-color: #3f80ea;
        box-shadow: 0 0 0 0.25rem rgba(63, 128, 234, 0.25);
        background-color: #fff;
    }

    /* Submit Button */
    .stagiaire-edit-submit-btn {
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .stagiaire-edit-avatar-container {
            width: 50px;
            height: 50px;
        }
        
        .stagiaire-edit-form .form-label {
            font-size: 0.75rem;
        }
        
        .stagiaire-edit-form .form-control,
        .stagiaire-edit-form .form-select {
            font-size: 0.85rem;
            padding: 0.4rem 0.65rem;
        }
    }

    @media (max-width: 767.98px) {
        .stagiaire-edit-modal .modal-dialog {
            max-width: 100%;
            margin: 0.5rem auto;
        }
    }

    @media (max-width: 575.98px) {
        .stagiaire-edit-modal .modal-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 1rem;
        }
        
        .stagiaire-edit-avatar-container {
            margin-bottom: 0.75rem;
            margin-right: 0;
        }
        
        .stagiaire-edit-form .row > div {
            margin-bottom: 0.75rem;
        }
        
        .stagiaire-edit-submit-btn {
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Avatar upload functionality
    const avatarInput = document.getElementById('avatarInputEdit{{ $stagiaire->id }}');
    const avatarPreview = document.getElementById('avatarPreviewEdit{{ $stagiaire->id }}');
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
    const form = document.querySelector('#editStagiaireModal{{ $stagiaire->id }} form.needs-validation');
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
    const fullNameInput = document.getElementById('edit_full_name');
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
    const startDateInput = document.getElementById('edit_start_date');
    const endDateInput = document.getElementById('edit_end_date');
    
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