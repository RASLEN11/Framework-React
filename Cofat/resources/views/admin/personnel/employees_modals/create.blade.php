<div class="modal fade employee-create-modal" id="createEmployeeModal" tabindex="-1" aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <form action="{{ route('personnel.employees.store') }}" method="POST" class="needs-validation employee-create-form" novalidate enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-3 bg-white me-2">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                    <!-- Avatar Upload -->
                    <div class="employee-create-avatar-container me-sm-3 mb-2 mb-sm-0">
                        <img id="avatarPreview" 
                             src="https://ui-avatars.com/api/?name=N+E&background=3f80ea&color=ffffff&size=50" 
                             class="employee-create-avatar border border-dark" 
                             alt="Employee photo placeholder"
                             aria-label="Click to upload employee photo">
                        <input type="file" name="avatar" id="avatarInput" 
                               class="d-none" accept="image/*">
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="employee-create-title mb-0 text-black" id="createEmployeeModalLabel">
                            <i class="fas fa-user-plus me-2 text-black"></i>
                            Ajouter un Nouvel Employé
                        </h5>
                        <small class="employee-create-subtitle text-muted">Complétez les informations</small>
                        @error('avatar')
                            <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                    <!-- Compact Form Layout -->
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
                                <i class="fas fa-user me-1 text-black"></i>Nom Complet
                            </label>
                            <input type="text" name="full_name" id="full_name" 
                                   class="form-control bg-white text-black border border-secondary @error('full_name') is-invalid @enderror" 
                                   value="{{ old('full_name') }}" required
                                   placeholder="Prénom et Nom">
                            @error('full_name')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="birth_date" class="form-label text-black">
                                <i class="fas fa-calendar-alt me-1 text-black"></i>Date de Naissance
                            </label>
                            <div class="position-relative">
                                <input type="date" name="birth_date" id="birth_date" 
                                       class="form-control bg-white text-black border border-secondary @error('birth_date') is-invalid @enderror" 
                                       value="{{ old('birth_date') }}" required
                                       max="{{ date('Y-m-d') }}">
                            </div>
                            @error('birth_date')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="genre" class="form-label text-black">
                                <i class="fas fa-venus-mars me-1 text-black"></i>Genre
                            </label>
                            <select name="genre" id="genre" 
                                    class="form-select bg-white text-black border border-secondary @error('genre') is-invalid @enderror" required>
                                <option value="" disabled selected>Sélectionner</option>
                                <option value="male" {{ old('genre') == 'male' ? 'selected' : '' }}>Homme</option>
                                <option value="female" {{ old('genre') == 'female' ? 'selected' : '' }}>Femme</option>
                            </select>
                            @error('genre')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="phone_number" class="form-label text-black">
                                <i class="fas fa-phone me-1 text-black"></i>Téléphone
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
                                <i class="fas fa-graduation-cap me-1 text-black"></i>Éducation
                            </label>
                            <select name="education_level" id="education_level" 
                                    class="form-select bg-white text-black border border-secondary @error('education_level') is-invalid @enderror" required>
                                <option value="" disabled selected>Sélectionner</option>
                                <option value="primaire" {{ old('education_level') == 'primaire' ? 'selected' : '' }}>Primaire</option>
                                <option value="college" {{ old('education_level') == 'college' ? 'selected' : '' }}>Collège</option>
                                <option value="lycee" {{ old('education_level') == 'lycee' ? 'selected' : '' }}>Lycée</option>
                                <option value="bac" {{ old('education_level') == 'bac' ? 'selected' : '' }}>Bac</option>
                                <option value="bac_1" {{ old('education_level') == 'bac_1' ? 'selected' : '' }}>Bac+1</option>
                                <option value="bac_2" {{ old('education_level') == 'bac_2' ? 'selected' : '' }}>Bac+2</option>
                                <option value="bac_3" {{ old('education_level') == 'bac_3' ? 'selected' : '' }}>Bac+3</option>
                                <option value="bac_4" {{ old('education_level') == 'bac_4' ? 'selected' : '' }}>Bac+4</option>
                                <option value="bac_5" {{ old('education_level') == 'bac_5' ? 'selected' : '' }}>Bac+5</option>
                                <option value="bac_6" {{ old('education_level') == 'bac_6' ? 'selected' : '' }}>Bac+6</option>
                            </select>
                            @error('education_level')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="address" class="form-label text-black">
                            <i class="fas fa-map-marker-alt me-1 text-black"></i>Adresse
                        </label>
                        <textarea name="address" id="address" 
                                  class="form-control bg-white text-black border border-secondary @error('address') is-invalid @enderror" 
                                  rows="2" required
                                  placeholder="Adresse complète">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="row g-2">
                        <div class="col-12 col-sm-6">
                            <label for="category" class="form-label text-black">
                                <i class="fas fa-users me-1 text-black"></i>Catégorie
                            </label>
                            <select name="category" id="category" 
                                    class="form-select bg-white text-black border border-secondary @error('category') is-invalid @enderror" required>
                                <option value="" disabled selected>Sélectionner</option>
                                <option value="indirect" {{ old('category') == 'indirect' ? 'selected' : '' }}>Indirect</option>
                                <option value="direct" {{ old('category') == 'direct' ? 'selected' : '' }}>Direct</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-6">
                            <label for="hire_date" class="form-label text-black">
                                <i class="fas fa-calendar-plus me-1 text-black"></i>Date Embauche
                            </label>
                            <div class="position-relative">
                                <input type="date" name="hire_date" id="hire_date" 
                                       class="form-control bg-white text-black border border-secondary @error('hire_date') is-invalid @enderror" 
                                       value="{{ old('hire_date') }}" required
                                       max="{{ date('Y-m-d') }}">
                            </div>
                            @error('hire_date')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-dark employee-create-submit-btn">
                            <i class="fas fa-save me-1"></i>Enregistrer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    /* Modal Container - Centering Styles */
    .employee-create-modal .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .employee-create-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Modal Header */
    .employee-create-modal .modal-header {
        border-bottom: 1px solid #e9ecef;
        padding: 1.5rem;
        background-color: #f8f9fa;
    }

    .employee-create-modal .modal-title {
        font-weight: 600;
        color: #212529;
        font-size: 1.25rem;
    }

    .employee-create-modal .modal-subtitle {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Avatar Upload */
    .employee-create-avatar-container {
        width: 60px;
        height: 60px;
        position: relative;
        margin-right: 1rem;
    }

    .employee-create-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .employee-create-avatar:hover {
        opacity: 0.8;
    }

    /* Form Elements */
    .employee-create-form .form-label {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .employee-create-form .form-control,
    .employee-create-form .form-select {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    .employee-create-form .form-control:focus,
    .employee-create-form .form-select:focus {
        border-color: #3f80ea;
        box-shadow: 0 0 0 0.25rem rgba(63, 128, 234, 0.25);
        background-color: #fff;
    }

    .employee-create-form textarea.form-control {
        min-height: 100px;
    }

    /* Date Input Icons */
    .employee-create-form .date-input-icon {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        pointer-events: none;
    }

    /* Submit Button */
    .employee-create-submit-btn {
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .employee-create-modal .modal-header {
            padding: 1rem;
        }
        
        .employee-create-avatar-container {
            width: 50px;
            height: 50px;
        }
        
        .employee-create-form .form-label {
            font-size: 0.75rem;
        }
        
        .employee-create-form .form-control,
        .employee-create-form .form-select {
            font-size: 0.85rem;
            padding: 0.4rem 0.65rem;
        }
    }

    @media (max-width: 767.98px) {
        .employee-create-modal .modal-dialog {
            max-width: 100%;
            margin: 0.5rem auto;
        }
        
        .employee-create-modal .modal-content {
            border-radius: 0;
        }
    }

    @media (max-width: 575.98px) {
        .employee-create-modal .modal-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 1rem;
        }
        
        .employee-create-avatar-container {
            margin-bottom: 0.75rem;
            margin-right: 0;
        }
        
        .employee-create-form .row > div {
            margin-bottom: 0.75rem;
        }
        
        .employee-create-submit-btn {
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
                    alert('La taille de l\'image ne doit pas dépasser 2MB');
                    this.value = '';
                    return;
                }
                const validTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    alert('Seuls les fichiers JPEG, PNG et GIF sont autorisés');
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
    const form = document.querySelector('#createEmployeeModal form.needs-validation');
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
                const initials = (names[0].charAt(0) + (names[1] ? names[1].charAt(0) : '')).toUpperCase();
                avatarPreview.src = `https://ui-avatars.com/api/?name=${initials}&background=3f80ea&color=ffffff&size=50`;
            }
        });
    }
});
</script>