<div class="modal fade employee-edit-modal" id="editEmployeeModal{{ $employee->id }}" tabindex="-1" aria-labelledby="editEmployeeModalLabel{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <form action="{{ route('personnel.employees.update', $employee->id) }}" method="POST" class="needs-validation employee-edit-form" novalidate enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body p-3 p-md-4 bg-white">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                        <div class="employee-edit-avatar me-sm-3 mb-2 mb-sm-0 position-relative">
                            @if($employee->avatar)
                                <img id="avatarPreviewEdit{{ $employee->id }}" 
                                     src="{{ asset('storage/' . $employee->avatar) }}" 
                                     class="employee-edit-avatar-img border border-dark" 
                                     alt="{{ $employee->full_name }}"
                                     onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'"
                                     style="cursor: pointer;">
                            @else
                                <img id="avatarPreviewEdit{{ $employee->id }}" 
                                     src="https://ui-avatars.com/api/?name={{ strtoupper(substr($employee->full_name, 0, 1)) }}&background=000000&color=ffffff" 
                                     class="employee-edit-avatar-img border border-dark" 
                                     alt="{{ $employee->full_name }}"
                                     style="cursor: pointer;">
                            @endif
                            <input type="file" name="avatar" id="avatarInputEdit{{ $employee->id }}" 
                                   class="d-none" accept="image/*">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="employee-edit-title mb-0 text-black" id="editEmployeeModalLabel{{ $employee->id }}">
                                <i class="fas fa-user-edit me-2 text-black"></i>
                                Edit: {{ $employee->full_name }}
                            </h5>
                            <small class="employee-edit-subtitle text-muted">ID: {{ $employee->id }}</small>
                            @error('avatar')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="row mt-3">
                        <!-- Left Column -->
                        <div class="col-md-5 pe-md-2">
                            <div class="row mb-3 g-3">
                                <div class="col-12 col-sm-6">
                                    <div class="employee-edit-info-item">
                                        <label for="edit_cin" class="employee-edit-info-label text-muted">
                                            <i class="fas fa-id-card fa-fw me-2 text-black"></i>CIN
                                        </label>
                                        <input type="text" name="cin" id="edit_cin" 
                                               class="form-control bg-light text-black border border-secondary @error('cin') is-invalid @enderror" 
                                               value="{{ old('cin', $employee->cin) }}" required
                                               placeholder="Ex: AB123456"
                                               pattern="\d{4}.+"
                                               title="CIN must start with 4 digits">
                                        @error('cin')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="employee-edit-info-item">
                                        <label for="edit_phone_number" class="employee-edit-info-label text-muted">
                                            <i class="fas fa-phone fa-fw me-2 text-black"></i>Phone
                                        </label>
                                        <input type="tel" name="phone_number" id="edit_phone_number" 
                                               class="form-control bg-light text-black border border-secondary @error('phone_number') is-invalid @enderror" 
                                               value="{{ old('phone_number', $employee->phone_number) }}" required
                                               placeholder="Ex: 12345678"
                                               pattern="[0-9]{8}">
                                        @error('phone_number')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="employee-edit-info-item">
                                        <label for="edit_birth_date" class="employee-edit-info-label text-muted">
                                            <i class="fas fa-birthday-cake fa-fw me-2 text-black"></i>Birth Date
                                        </label>
                                        <input type="date" name="birth_date" id="edit_birth_date" 
                                               class="form-control bg-light text-black border border-secondary @error('birth_date') is-invalid @enderror" 
                                               value="{{ old('birth_date', $employee->birth_date->format('Y-m-d')) }}" required
                                               max="{{ Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}">
                                        @error('birth_date')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="employee-edit-info-item">
                                        <label class="employee-edit-info-label text-muted">
                                            <i class="fas fa-venus-mars fa-fw me-2 text-black"></i>Gender
                                        </label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="genre" 
                                                       id="edit_genre_male" value="male" 
                                                       {{ old('genre', $employee->genre) == 'male' ? 'checked' : '' }} required>
                                                <label class="form-check-label text-black" for="edit_genre_male">Male</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="genre" 
                                                       id="edit_genre_female" value="female" 
                                                       {{ old('genre', $employee->genre) == 'female' ? 'checked' : '' }}>
                                                <label class="form-check-label text-black" for="edit_genre_female">Female</label>
                                            </div>
                                        </div>
                                        @error('genre')
                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="employee-edit-section border-top border-secondary pt-3 mb-3">
                                <h6 class="employee-edit-section-title text-black"><i class="fas fa-graduation-cap me-2 text-black"></i>Education & Employment</h6>
                                <div class="employee-edit-section-content">
                                    <!-- First Row: Education and Hire Date -->
                                    <div class="row mb-3">
                                        <div class="col-md-6 pe-md-2">
                                            <div class="employee-edit-detail-item">
                                                <label for="edit_education_level" class="employee-edit-detail-label text-muted">Education:</label> 
                                                <select name="education_level" id="edit_education_level" 
                                                        class="form-select bg-light text-black border border-secondary @error('education_level') is-invalid @enderror" required>
                                                    <option value="primaire" {{ old('education_level', $employee->education_level) == 'primaire' ? 'selected' : '' }}>Primary</option>
                                                    <option value="college" {{ old('education_level', $employee->education_level) == 'college' ? 'selected' : '' }}>Secondary School</option>
                                                    <option value="lycee" {{ old('education_level', $employee->education_level) == 'lycee' ? 'selected' : '' }}>High School</option>
                                                    <option value="bac" {{ old('education_level', $employee->education_level) == 'bac' ? 'selected' : '' }}>Baccalaureate</option>
                                                    <option value="bac_1" {{ old('education_level', $employee->education_level) == 'bac_1' ? 'selected' : '' }}>Bac+1</option>
                                                    <option value="bac_2" {{ old('education_level', $employee->education_level) == 'bac_2' ? 'selected' : '' }}>Bac+2 (DEUG, BTS, DUT)</option>
                                                    <option value="bac_3" {{ old('education_level', $employee->education_level) == 'bac_3' ? 'selected' : '' }}>Bac+3 (License, Bachelor)</option>
                                                    <option value="bac_4" {{ old('education_level', $employee->education_level) == 'bac_4' ? 'selected' : '' }}>Bac+4 (Master 1)</option>
                                                    <option value="bac_5" {{ old('education_level', $employee->education_level) == 'bac_5' ? 'selected' : '' }}>Bac+5 (Master, Engineer)</option>
                                                    <option value="bac_6" {{ old('education_level', $employee->education_level) == 'bac_6' ? 'selected' : '' }}>Bac+6 (PhD, MBA)</option>
                                                </select>
                                                @error('education_level')
                                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 ps-md-2">
                                            <div class="employee-edit-detail-item">
                                                <label for="edit_hire_date" class="employee-edit-detail-label text-muted">Hired:</label> 
                                                <input type="date" name="hire_date" id="edit_hire_date" 
                                                    class="form-control bg-light text-black border border-secondary @error('hire_date') is-invalid @enderror" 
                                                    value="{{ old('hire_date', $employee->hire_date->format('Y-m-d')) }}" required
                                                    max="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                                @error('hire_date')
                                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Second Row: Seniority and Category -->
                                    <div class="row">
                                        <div class="col-md-6 pe-md-2">
                                            <div class="employee-edit-detail-item">
                                                <span class="employee-edit-detail-label text-muted">Seniority:</span> 
                                                <span class="employee-edit-detail-value text-black">{{ $employee->seniority }} years</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ps-md-2">
                                            <div class="employee-edit-detail-item">
                                                <label class="employee-edit-detail-label text-muted">Category:</label> 
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="category" 
                                                            id="edit_category_direct" value="direct" 
                                                            {{ old('category', $employee->category) == 'direct' ? 'checked' : '' }} required>
                                                        <label class="form-check-label text-black" for="edit_category_direct">Direct</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="category" 
                                                            id="edit_category_indirect" value="indirect" 
                                                            {{ old('category', $employee->category) == 'indirect' ? 'checked' : '' }}>
                                                        <label class="form-check-label text-black" for="edit_category_indirect">Indirect</label>
                                                    </div>
                                                </div>
                                                @error('category')
                                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="employee-edit-section border-top border-secondary pt-2">
                                <h6 class="employee-edit-section-title text-black"><i class="fas fa-map-marker-alt me-2 text-black"></i>Address</h6>
                                <div class="employee-edit-section-content">
                                    <textarea name="address" id="edit_address" 
                                              class="form-control bg-light text-black border border-secondary @error('address') is-invalid @enderror" 
                                              rows="2" required
                                              placeholder="Complete address">{{ old('address', $employee->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Column - Qualifications -->
                        <div class="col-md-7 ps-md-1">
                            <div class="employee-edit-section border-top border-secondary ">
                                <h6 class="employee-edit-section-title text-black">
                                    <i class="fas fa-certificate me-2 text-black"></i>
                                    Qualifications ({{ $employee->qualifications->count() }})
                                    <button type="button" class="btn btn-dark btn-sm ms-2" data-bs-toggle="modal" data-bs-target="#addQualificationModal{{ $employee->id }}">
                                        <i class="fas fa-plus"></i> Add
                                    </button>
                                </h6>
                                <div class="employee-edit-section-content">
                                    @if($employee->qualifications->count() > 0)
                                        <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                                            <table class="table table-sm table-hover employee-edit-qualifications-table">
                                                <thead class="bg-light" style="position: sticky; top: 0; z-index: 1;">
                                                    <tr>
                                                        <th class="text-black">Type</th>
                                                        <th class="text-black">Date</th>
                                                        <th class="text-black">Trainer</th>
                                                        <th class="text-black">Score</th>
                                                        <th class="text-black">Next Qualification</th>
                                                        <th class="text-black">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($employee->qualifications as $qualification)
                                                    <tr>
                                                        <td class="text-black">{{ $qualification->type }}</td>
                                                        <td class="text-black">{{ $qualification->date->format('d M Y') }}</td>
                                                        <td class="text-black">{{ $qualification->trainer }}</td>
                                                        <td>
                                                            <span class="badge bg-{{ $qualification->note < 10 ? 'danger' : ($qualification->note < 15 ? 'warning' : 'success') }}">
                                                                {{ $qualification->note }}/20
                                                            </span>
                                                        </td>
                                                        <td class="text-black">
                                                            @if($qualification->next_qualification_date)
                                                                {{ $qualification->next_qualification_date->format('d M Y') }}
                                                            @else
                                                                <span class="text-muted">N/A</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex gap-1">
                                                                <button type="button" class="btn btn-dark btn-sm employees-edit-action-btn" 
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#updateQualificationModal{{ $qualification->id }}"
                                                                    title="Update Qualification">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <form action="" method="POST" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm employees-edit-action-btn" 
                                                                            title="Delete Qualification"
                                                                            onclick="return confirm('Are you sure you want to delete this qualification?')">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <div class="alert alert-dark color-white mb-0 py-2">
                                            <i class="fas fa-info-circle me-2"></i>No qualifications recorded for this employee.
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Update button -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-dark employee-edit-submit-btn">
                            <i class="fas fa-save me-2"></i>Update Employee
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include qualification edit modals -->
@foreach($employee->qualifications as $qualification)
@endforeach

<style>
    /* Modal Container - Centering Styles */
    .employee-edit-modal .modal-dialog {
        max-width: 1200px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .employee-edit-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Avatar Styles */
    .employee-edit-avatar {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
        margin-right: 1rem;
    }

    .employee-edit-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    /* Fallback for broken images */
    .employee-edit-avatar-img[src*="default-avatar.png"] {
        object-fit: contain;
        padding: 15%;
        background-color: #f8f9fa;
    }

    .employee-edit-title {
        font-weight: 600;
        color: #212529;
        font-size: 1.25rem;
        margin-bottom: 0.25rem;
    }

    .employee-edit-subtitle {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Info Items */
    .employee-edit-info-item {
        margin-bottom: 1rem;
    }

    .employee-edit-info-label {
        font-size: 0.75rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
        display: block;
    }

    /* Sections */
    .employee-edit-section {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 1.25rem;
        margin-bottom: 1.25rem;
    }

    .employee-edit-section-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    /* Detail Items */
    .employee-edit-detail-item {
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
    }

    .employee-edit-detail-label {
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 0.25rem;
        display: block;
    }

    .employee-edit-detail-value {
        color: #495057;
    }

    /* Form Controls */
    .employee-edit-form .form-control,
    .employee-edit-form .form-select {
        font-size: 0.85rem;
        padding: 0.45rem 0.7rem;
        border-radius: 7px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    /* Qualifications Table */
    .employee-edit-qualifications-table {
        font-size: 0.8rem;
        margin-top: 0.7rem;
    }

    .employee-edit-qualifications-table th {
        font-weight: 600;
        background-color: rgba(0, 0, 0, 0.03);
        padding: 0.5rem;
        white-space: nowrap;
    }

    .employee-edit-qualifications-table td {
        padding: 0.5rem;
        vertical-align: middle;
    }

    /* Action Buttons */
    .employees-edit-action-btn {
        width: 30px;
        height: 30px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50px;
        transition: all 0.3s ease;
        padding: 0;
    }

    /* Submit Button */
    .employee-edit-submit-btn {
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* Scrollbar styling */
    .table-responsive::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .table-responsive::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .table-responsive::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .employee-edit-modal .modal-dialog {
            max-width: 100%;
        }
        
        .employee-edit-avatar {
            width: 50px;
            height: 50px;
        }
    }

    @media (max-width: 767.98px) {
        .employee-edit-modal .modal-dialog {
            margin: 0.5rem auto;
        }
        
        .employee-edit-modal .modal-content {
            border-radius: 0;
        }
        
        /* Stack columns on mobile */
        .row > .col-md-6 {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        
        .pe-md-3, .ps-md-3 {
            padding-right: 15px !important;
            padding-left: 15px !important;
        }
    }

    @media (max-width: 575.98px) {
        .employee-edit-avatar {
            width: 45px;
            height: 45px;
            margin-right: 0;
            margin-bottom: 0.75rem;
        }
        
        .employee-edit-qualifications-table {
            display: block;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        .employees-edit-action-btn {
            width: 25px;
            height: 25px;
            font-size: 0.7rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Avatar upload functionality
        const avatarInput = document.getElementById('avatarInputEdit{{ $employee->id }}');
        const avatarPreview = document.getElementById('avatarPreviewEdit{{ $employee->id }}');    
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
        
        // Form validation for employee edit
        const employeeForm = document.querySelector('#editEmployeeModal{{ $employee->id }} form.needs-validation');
        if (employeeForm) {
            employeeForm.addEventListener('submit', function(event) {
                if (!employeeForm.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                employeeForm.classList.add('was-validated');
            }, false);
        }
        
        // Dynamic next qualification date requirement for add modal
        const addNoteInput = document.querySelector('#addQualificationModal{{ $employee->id }} input[name="note"]');
        if (addNoteInput) {
            addNoteInput.addEventListener('change', function() {
                const nextDateInput = document.querySelector('#addQualificationModal{{ $employee->id }} input[name="next_qualification_date"]');
                if (this.value >= 10 && this.value < 15) {
                    nextDateInput.required = true;
                    // Set minimum date to one year from qualification date
                    const qualDate = document.querySelector('#addQualificationModal{{ $employee->id }} input[name="date"]').value;
                    if (qualDate) {
                        const date = new Date(qualDate);
                        date.setFullYear(date.getFullYear() + 1);
                        nextDateInput.min = date.toISOString().split('T')[0];
                    }
                } else {
                    nextDateInput.required = false;
                }
            });
        }
        
        // Ensure qualification date is before next qualification date in add modal
        const addDateInput = document.querySelector('#addQualificationModal{{ $employee->id }} input[name="date"]');
        if (addDateInput) {
            addDateInput.addEventListener('change', function() {
                const nextDateInput = document.querySelector('#addQualificationModal{{ $employee->id }} input[name="next_qualification_date"]');
                if (this.value) {
                    const date = new Date(this.value);
                    date.setFullYear(date.getFullYear() + 1);
                    nextDateInput.min = date.toISOString().split('T')[0];
                }
            });
        }
    });
</script>