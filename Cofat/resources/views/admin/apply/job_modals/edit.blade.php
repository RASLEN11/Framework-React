<!-- Edit Job Modal -->
<div class="modal fade stagiaire-edit-modal" id="editJobModal{{ $application->id }}" tabindex="-1" aria-labelledby="editJobModalLabel{{ $application->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <form action="{{ route('admin.applications.job.update', $application->id) }}" method="POST" class="needs-validation stagiaire-edit-form">
                @csrf
                @method('PUT')
                <div class="modal-body p-3 bg-white me-2">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                        <!-- Avatar Initial -->
                        <div class="stagiaire-edit-avatar-container me-sm-3 mb-2 mb-sm-0">
                            <div class="stagiaire-edit-avatar border border-dark d-flex align-items-center justify-content-center bg-dark text-white">
                                {{ strtoupper(substr($application->first_name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="stagiaire-edit-title mb-0 text-black" id="editJobModalLabel{{ $application->id }}">
                                <i class="fas fa-user-edit me-2 text-black"></i>
                                Edit Application: {{ $application->first_name }} {{ $application->last_name }}
                            </h5>
                            <small class="stagiaire-edit-subtitle text-muted">Update application details</small>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Position Information Section -->
                    <div class="row g-2 mb-2">
                        <div class="col-12 col-sm-6">
                            <label class="form-label text-black">
                                <i class="fas fa-building me-1 text-black"></i>Position Type
                            </label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input @error('position_type') is-invalid @enderror" 
                                        type="radio" 
                                        name="position_type" 
                                        id="edit_office{{ $application->id }}" 
                                        value="office" 
                                        {{ old('position_type', $application->position_type) == 'office' ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label" for="edit_office{{ $application->id }}">
                                        Office
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('position_type') is-invalid @enderror" 
                                        type="radio" 
                                        name="position_type" 
                                        id="edit_factory{{ $application->id }}" 
                                        value="factory" 
                                        {{ old('position_type', $application->position_type) == 'factory' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="edit_factory{{ $application->id }}">
                                        Factory
                                    </label>
                                </div>
                            </div>
                            @error('position_type')
                                <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
                            @enderror
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
    /* Stagiaire Edit Modal Styles - Same as original */
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
        font-size: 1.5rem;
        font-weight: bold;
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
        
        .stagiaire-edit-avatar {
            font-size: 1.25rem;
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
    // Form validation
    const form = document.querySelector('#editJobModal{{ $application->id }} form.needs-validation');
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