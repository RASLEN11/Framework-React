<div class="modal fade qualification-modal" id="addQualificationModal{{ $employee->id }}" tabindex="-1" aria-labelledby="addQualificationModalLabel{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <div class="modal-body p-3 p-md-4 bg-white">
                <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                    <div class="qualification-icon-container me-sm-3 mb-2 mb-sm-0 bg-light text-black">
                        <i class="fas fa-certificate text-black"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="modal-title mb-0 text-black" id="addQualificationModalLabel{{ $employee->id }}">
                            Add Qualification
                        </h5>
                        <small class="modal-subtitle text-muted">For employee: <strong class="text-black">{{ $employee->full_name }}</strong> (*****{{ substr($employee->cin, -3) }})</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('personnel.qualifications.store', $employee->id) }}" method="POST" class="needs-validation qualification-form" novalidate>
                    @csrf
                    
                    <div class="row g-3">
                        <!-- Qualification Type -->
                        <div class="col-12 col-md-6">
                            <label for="type{{ $employee->id }}" class="form-label text-black">
                                <i class="fas fa-tag me-2 text-black"></i>Qualification Type
                            </label>
                            <select class="form-select bg-white text-black border border-secondary @error('type') is-invalid @enderror" id="type{{ $employee->id }}" name="type" required>
                                <option value="" selected disabled>Select a type</option>
                                @foreach([
                                    'Passage fils et AAC',
                                    'Epissure ucab',
                                    'Application retreint',
                                    'Habillage Manuel',
                                    'Super contrôle assembl',
                                    'Contrôle éléctrique',
                                    'Alimentation fil sur ligne',
                                    'Retouche câblage',
                                    'Sertissage IDC',
                                    'Retouche en ligne',
                                    'Mont.agrafes sur TCL',
                                    'Epissure ultrasons',
                                    'Application codmelt',
                                    'Montage des agrafes',
                                    'Gamma 255',
                                    'conditionnement',
                                    'Comptage'
                                ] as $qualificationType)
                                    @php
                                        $hasQualification = $employee->qualifications->contains('type', $qualificationType);
                                    @endphp
                                    <option value="{{ $qualificationType }}" 
                                        {{ old('type') == $qualificationType ? 'selected' : '' }}
                                        @if($hasQualification) disabled @endif
                                        data-has-qualification="{{ $hasQualification ? 'true' : 'false' }}">
                                        {{ $qualificationType }}
                                        @if($hasQualification) (Already qualified) @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('type')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                            <div id="qualificationExistsWarning{{ $employee->id }}" class="text-danger mt-1" style="display: none;">
                                <i class="fas fa-exclamation-triangle me-1"></i>
                                This employee already has this qualification.
                            </div>
                        </div>
                        
                        <!-- Qualification Date -->
                        <div class="col-12 col-md-6">
                            <label for="date{{ $employee->id }}" class="form-label text-black">
                                <i class="fas fa-calendar-day me-2 text-black"></i>Qualification Date
                            </label>
                            <div class="position-relative">
                                <input type="date" class="form-control bg-white text-black border border-secondary @error('date') is-invalid @enderror" id="date{{ $employee->id }}" 
                                       name="date" value="{{ old('date', date('Y-m-d')) }}" required>
                            </div>
                            @error('date')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Trainer Name -->
                        <div class="col-12 col-md-6">
                            <label for="trainer{{ $employee->id }}" class="form-label text-black">
                                <i class="fas fa-chalkboard-teacher me-2 text-black"></i>Trainer Name
                            </label>
                            <input type="text" class="form-control bg-white text-black border border-secondary @error('trainer') is-invalid @enderror" id="trainer{{ $employee->id }}" 
                                   name="trainer" value="{{ old('trainer') }}" required>
                            @error('trainer')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Note -->
                        <div class="col-12 col-md-6">
                            <label for="note{{ $employee->id }}" class="form-label text-black">
                                <i class="fas fa-star me-2 text-black"></i>Score
                            </label>
                            <div class="input-group">
                                <input type="number" class="form-control bg-white text-black border border-secondary @error('note') is-invalid @enderror" id="note{{ $employee->id }}" 
                                       name="note" min="0" max="20" step="0.5" value="{{ old('note') }}" required>
                                <span class="input-group-text bg-white text-black border border-secondary">/20</span>
                            </div>
                            @error('note')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Next Qualification Date (conditional) -->
                        <div class="col-12 col-md-6" id="nextQualificationContainer{{ $employee->id }}" style="display: none;">
                            <label for="next_qualification_date{{ $employee->id }}" class="form-label text-black">
                                <i class="fas fa-calendar-check me-2 text-black"></i>Next Qualification Date
                            </label>
                            <div class="position-relative">
                                <input type="date" class="form-control bg-white text-black border border-secondary @error('next_qualification_date') is-invalid @enderror" 
                                       id="next_qualification_date{{ $employee->id }}" name="next_qualification_date" 
                                       value="{{ old('next_qualification_date') }}">
                            </div>
                            @error('next_qualification_date')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Note Indicator -->
                        <div class="col-12 mt-3">
                            <div class="note-indicator p-3 rounded bg-light">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-black">Qualification Evaluation:</span>
                                    <span id="noteValue{{ $employee->id }}" class="fw-bold text-black">0/20</span>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    <div id="noteProgress{{ $employee->id }}" class="progress-bar bg-danger" role="progressbar" 
                                         style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="20"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2">
                                    <span class="badge bg-danger">Insufficient (&lt;10)</span>
                                    <span class="badge bg-warning text-black">Average (10-15)</span>
                                    <span class="badge bg-success">Excellent (≥15)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-dark qualification-submit-btn" id="submitButton{{ $employee->id }}">
                            <i class="fas fa-save me-2"></i> Save Qualification
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
    /* public/css/admin/employees/create-qualification.css */
    /* Modal Container - Centering Styles */
    .qualification-modal .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .qualification-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Modal Header */
    .qualification-modal .modal-header {
        border-bottom: 1px solid #e9ecef;
        padding: 1.5rem;
        background-color: #f8f9fa;
    }

    .qualification-modal .modal-title {
        font-weight: 600;
        color: #212529;
        font-size: 1.25rem;
    }

    .qualification-modal .modal-subtitle {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Icon Container */
    .qualification-icon-container {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: rgba(0, 0, 0, 0.05);
        border-radius: 50%;
        color: #212529;
        font-size: 1.25rem;
        margin-right: 1rem;
    }

    /* Form Elements */
    .qualification-form .form-label {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .qualification-form .form-control,
    .qualification-form .form-select {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    .qualification-form .form-control:focus,
    .qualification-form .form-select:focus {
        border-color: #212529;
        box-shadow: 0 0 0 0.25rem rgba(63, 128, 234, 0.25);
        background-color: #fff;
    }

    /* Input Group */
    .qualification-form .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        color: #6c757d;
    }

    /* Date Input Icon */
    .qualification-form .date-input-icon {
        position: absolute;
        right: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        pointer-events: none;
    }

    /* Note Indicator */
    .qualification-form .note-indicator {
        background-color: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 0.5rem;
    }

    /* Progress Bar */
    .qualification-form .progress {
        background-color: #e9ecef;
        height: 0.5rem;
        border-radius: 4px;
    }

    /* Badges */
    .qualification-form .badge {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
    }

    /* Submit Button */
    .qualification-submit-btn {
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        background-color: #212529;
        border-color: #212529;
        transition: all 0.3s;
    }

    .qualification-submit-btn:hover {
        background-color: #343a40;
        border-color: #343a40;
    }

    /* Error States */
    .qualification-form .is-invalid {
        border-color: #dc3545;
    }

    .qualification-form .is-invalid:focus {
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
    }

    .qualification-form .invalid-feedback {
        font-size: 0.75rem;
        color: #dc3545;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .qualification-modal .modal-header {
            padding: 1rem;
        }
        
        .qualification-icon-container {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }
        
        .qualification-form .form-label {
            font-size: 0.75rem;
        }
        
        .qualification-form .form-control,
        .qualification-form .form-select {
            font-size: 0.85rem;
            padding: 0.4rem 0.65rem;
        }
    }

    @media (max-width: 767.98px) {
        .qualification-modal .modal-dialog {
            max-width: 100%;
            margin: 0.5rem auto;
        }
        
        .qualification-modal .modal-content {
            border-radius: 0;
        }
    }

    @media (max-width: 575.98px) {
        .qualification-modal .modal-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 1rem;
        }
        
        .qualification-icon-container {
            margin-bottom: 0.75rem;
            margin-right: 0;
        }
        
        .qualification-form .form-control,
        .qualification-form .form-select {
            font-size: 0.8rem;
        }
        
        .qualification-submit-btn {
            width: 100%;
        }
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Qualification type change handler
    const qualificationType = document.getElementById('type{{ $employee->id }}');
    const qualificationExistsWarning = document.getElementById('qualificationExistsWarning{{ $employee->id }}');
    const submitButton = document.getElementById('submitButton{{ $employee->id }}');
    
    if (qualificationType) {
        qualificationType.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const hasQualification = selectedOption.getAttribute('data-has-qualification') === 'true';
            
            if (hasQualification) {
                qualificationExistsWarning.style.display = 'block';
                submitButton.disabled = true;
            } else {
                qualificationExistsWarning.style.display = 'none';
                submitButton.disabled = false;
            }
        });
    }

    // Note input handler
    const noteInput = document.getElementById('note{{ $employee->id }}');
    const noteValue = document.getElementById('noteValue{{ $employee->id }}');
    const noteProgress = document.getElementById('noteProgress{{ $employee->id }}');
    const nextQualificationContainer = document.getElementById('nextQualificationContainer{{ $employee->id }}');
    
    if (noteInput) {
        noteInput.addEventListener('input', function() {
            const note = parseFloat(this.value) || 0;
            const percentage = (note / 20) * 100;
            
            // Update display
            noteValue.textContent = `${note.toFixed(1)}/20`;
            noteProgress.style.width = `${percentage}%`;
            
            // Update progress bar color
            if (note < 10) {
                noteProgress.className = 'progress-bar bg-danger';
                nextQualificationContainer.style.display = 'none';
            } else if (note < 15) {
                noteProgress.className = 'progress-bar bg-warning';
                nextQualificationContainer.style.display = 'block';
                
                // Set default next qualification date if empty
                if (!document.getElementById('next_qualification_date{{ $employee->id }}').value) {
                    const today = new Date();
                    const nextDate = new Date(today);
                    nextDate.setFullYear(nextDate.getFullYear() + 1);
                    document.getElementById('next_qualification_date{{ $employee->id }}').value = nextDate.toISOString().split('T')[0];
                }
            } else {
                noteProgress.className = 'progress-bar bg-success';
                nextQualificationContainer.style.display = 'none';
            }
        });
    }

    // Form validation
    const form = document.querySelector('#addQualificationModal{{ $employee->id }} .needs-validation');
    if (form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }
});
</script>