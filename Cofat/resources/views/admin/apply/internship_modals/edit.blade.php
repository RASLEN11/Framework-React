<!-- Edit Internship Modal -->
<div class="modal fade internship-edit-modal" id="editInternshipModal{{ $application->id }}" tabindex="-1" aria-labelledby="editInternshipModalLabel{{ $application->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <form action="{{ route('admin.applications.internship.update', $application->id) }}" method="POST" class="needs-validation internship-edit-form">
                @csrf
                @method('PUT')
                <div class="modal-body p-3 bg-white me-2">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                        <!-- Avatar Initial -->
                        <div class="internship-edit-avatar-container me-sm-3 mb-2 mb-sm-0">
                            <div class="internship-edit-avatar border border-dark d-flex align-items-center justify-content-center bg-dark text-white">
                                {{ strtoupper(substr($application->first_name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="internship-edit-title mb-0 text-black" id="editInternshipModalLabel{{ $application->id }}">
                                <i class="fas fa-user-edit me-2 text-black"></i>
                                Edit Application: {{ $application->first_name }} {{ $application->last_name }}
                            </h5>
                            <small class="internship-edit-subtitle text-muted">Update application details</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Position Information Section -->
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label for="edit_position_type{{ $application->id }}" class="form-label text-black">
                                <i class="fas fa-building me-1 text-black"></i>Position Type
                            </label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="position_type" 
                                           id="office{{ $application->id }}" value="office" 
                                           {{ $application->position_type == 'office' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="office{{ $application->id }}">
                                        Office
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="position_type" 
                                           id="factory{{ $application->id }}" value="factory" 
                                           {{ $application->position_type == 'factory' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="factory{{ $application->id }}">
                                        Factory
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- Status Section -->
                        <div class="col-12 col-sm-6">
                            <label for="edit_status{{ $application->id }}" class="form-label text-black">
                                <i class="fas fa-info-circle me-1 text-black"></i>Status
                            </label>
                            <select name="status" id="edit_status{{ $application->id }}" 
                                    class="form-select bg-white text-black border border-secondary @error('status') is-invalid @enderror" required>
                                <option value="pending" {{ old('status', $application->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="under_review" {{ old('status', $application->status) == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                <option value="approved" {{ old('status', $application->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ old('status', $application->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-dark internship-edit-submit-btn">
                            <i class="fas fa-save me-1"></i>Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Internship Edit Modal Styles - Matching Job Edit Modal */
    .internship-edit-modal .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .internship-edit-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }

    /* Avatar Upload */
    .internship-edit-avatar-container {
        width: 60px;
        height: 60px;
        position: relative;
        margin-right: 1rem;
    }

    .internship-edit-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.5rem;
        font-weight: bold;
    }

    .internship-edit-avatar:hover {
        opacity: 0.8;
    }

    /* Form Elements */
    .internship-edit-form .form-label {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .internship-edit-form .form-control,
    .internship-edit-form .form-select {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    .internship-edit-form .form-control:focus,
    .internship-edit-form .form-select:focus {
        border-color: #3f80ea;
        box-shadow: 0 0 0 0.25rem rgba(63, 128, 234, 0.25);
        background-color: #fff;
    }

    /* Submit Button */
    .internship-edit-submit-btn {
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .internship-edit-avatar-container {
            width: 50px;
            height: 50px;
        }
        
        .internship-edit-avatar {
            font-size: 1.25rem;
        }
        
        .internship-edit-form .form-label {
            font-size: 0.75rem;
        }
        
        .internship-edit-form .form-control,
        .internship-edit-form .form-select {
            font-size: 0.85rem;
            padding: 0.4rem 0.65rem;
        }
    }

    @media (max-width: 767.98px) {
        .internship-edit-modal .modal-dialog {
            max-width: 100%;
            margin: 0.5rem auto;
        }
    }

    @media (max-width: 575.98px) {
        .internship-edit-modal .modal-header {
            flex-direction: column;
            align-items: flex-start;
            padding: 1rem;
        }
        
        .internship-edit-avatar-container {
            margin-bottom: 0.75rem;
            margin-right: 0;
        }
        
        .internship-edit-form .row > div {
            margin-bottom: 0.75rem;
        }
        
        .internship-edit-submit-btn {
            width: 100%;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('#editInternshipModal{{ $application->id }} form.needs-validation');
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