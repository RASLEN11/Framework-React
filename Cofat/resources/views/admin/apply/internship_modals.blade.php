@foreach($internshipApplications as $application)
<!-- Show Internship Modal -->
<div class="modal fade internship-show-modal" id="showInternshipModal{{ $application->id }}" tabindex="-1" aria-labelledby="showInternshipModalLabel{{ $application->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <div class="modal-body p-4 p-md-4 bg-white">
                <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                    <div class="internship-show-avatar me-sm-3 mb-2 mb-sm-0">
                        <span class="internship-show-avatar-initial text-white">{{ strtoupper(substr($application->first_name, 0, 1)) }}</span>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="internship-show-title mb-0 text-black" id="showInternshipModalLabel{{ $application->id }}">
                            <i class="fas fa-user-graduate me-2 text-black"></i>
                            {{ $application->first_name }} {{ $application->last_name }}'s Application
                        </h5>
                        <small class="internship-show-subtitle text-muted">{{ $application->email }}</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="row mb-3 g-3">
                    <div class="col-12 col-sm-6">
                        <div class="internship-show-info-item">
                            <span class="internship-show-info-badge bg-light text-black">
                                <i class="fas fa-id-card fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 internship-show-info-label text-muted">CIN</p>
                                <p class="mb-0 internship-show-info-value text-black">{{ $application->cin }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="internship-show-info-item">
                            <span class="internship-show-info-badge bg-light text-black">
                                <i class="fas fa-phone fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 internship-show-info-label text-muted">Phone</p>
                                <p class="mb-0 internship-show-info-value text-black">{{ $application->phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="internship-show-info-item">
                            <span class="internship-show-info-badge bg-light text-black">
                                <i class="fas fa-user fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 internship-show-info-label text-muted">Age</p>
                                <p class="mb-0 internship-show-info-value text-black">{{ $application->age }} years</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="internship-show-info-item">
                            <span class="internship-show-info-badge bg-light text-black">
                                <i class="fas fa-graduation-cap fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 internship-show-info-label text-muted">Education</p>
                                <p class="mb-0 internship-show-info-value text-black">{{ ucwords(str_replace('_', ' ', $application->education_level)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="internship-show-section border-top border-secondary pt-3">
                    <h6 class="internship-show-section-title text-black"><i class="fas fa-info-circle me-2 text-black"></i>Application Details</h6>
                    <div class="internship-show-section-content">
                        <div class="internship-show-detail-item">
                            <span class="internship-show-detail-label text-muted">Type:</span> 
                            <span class="internship-show-type-badge {{ $application->position_type === 'office' ? 'bg-primary' : 'bg-secondary' }}">
                                {{ ucfirst($application->position_type) }}
                            </span>
                        </div>
                        <div class="internship-show-detail-item">
                            <span class="internship-show-detail-label text-muted">Status:</span> 
                            <span class="internship-show-status-badge {{ 
                                $application->status === 'pending' ? 'bg-warning' : 
                                ($application->status === 'under_review' ? 'bg-info' : 
                                ($application->status === 'approved' ? 'bg-success' : 
                                ($application->status === 'rejected' ? 'bg-danger' : 'bg-secondary')))
                            }}">
                                {{ ucfirst($application->status) }}
                            </span>
                        </div>
                        <div class="internship-show-detail-item">
                            <span class="internship-show-detail-label text-muted">Applied On:</span> 
                            <span class="internship-show-detail-value text-black">{{ $application->created_at->format('d M Y \a\t H:i') }}</span>
                        </div>
                    </div>
                </div>

                @if($application->cover_letter)
                <div class="internship-show-section border-top border-secondary pt-3">
                    <h6 class="internship-show-section-title text-black"><i class="fas fa-envelope me-2 text-black"></i>Cover Letter</h6>
                    <div class="internship-show-section-content">
                        <div class="internship-show-message text-black">
                            {{ $application->cover_letter }}
                        </div>
                    </div>
                </div>
                @endif

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.applications.internship.download.cv', $application->id) }}" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-download me-2"></i>Download CV
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Internship Modal -->
<div class="modal fade internship-edit-modal" id="editInternshipModal{{ $application->id }}" tabindex="-1" aria-labelledby="editInternshipModalLabel{{ $application->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <form action="{{ route('admin.applications.internship.update', $application->id) }}" method="POST" class="needs-validation internship-edit-form">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 p-md-4 bg-white">
                    <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                        <div class="internship-edit-avatar-container me-sm-3 mb-2 mb-sm-0">
                            <span class="internship-edit-avatar-initial text-white">{{ strtoupper(substr($application->first_name, 0, 1)) }}</span>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="modal-title mb-0 text-black" id="editInternshipModalLabel{{ $application->id }}">
                                <i class="fas fa-edit me-2 text-black"></i>
                                Edit Application: {{ $application->first_name }} {{ $application->last_name }}
                            </h5>
                            <small class="modal-subtitle text-muted">Update application details and status</small>
                        </div>  
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="row g-2 g-md-3 mb-3 mt-3">
                        <!-- Position Type as Radio Buttons -->
                        <div class="col-md-6">
                            <label class="form-label text-black">
                                <i class="fas fa-briefcase me-2 text-black"></i>Position Type
                            </label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="position_type" 
                                           id="office{{ $application->id }}" value="office" 
                                           {{ $application->position_type == 'office' ? 'checked' : '' }}>
                                    <label class="form-check-label text-black" for="office{{ $application->id }}">
                                        Office
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="position_type" 
                                           id="factory{{ $application->id }}" value="factory" 
                                           {{ $application->position_type == 'factory' ? 'checked' : '' }}>
                                    <label class="form-check-label text-black" for="factory{{ $application->id }}">
                                        Factory
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status as Select Dropdown -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status{{ $application->id }}" class="form-label text-black">
                                    <i class="fas fa-info-circle me-2 text-black"></i>Status
                                </label>
                                <select name="status" id="status{{ $application->id }}" class="form-select bg-white text-black border border-secondary" required>
                                    <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="under_review" {{ $application->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                    <option value="approved" {{ $application->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-dark internship-edit-submit-btn">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
    /* Modal Container - Centering Styles */
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
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
    }

    /* Avatar Styles */
    .internship-edit-avatar-container{
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        flex-shrink: 0;
        margin-right: 1rem;
    }

    .internship-edit-avatar-initial{
        font-size: 1.5rem;
        font-weight: bold;
        color: white;
        position: absolute;
        text-transform: uppercase;
    }

    

    /* Internship Edit Modal */
    .internship-edit-modal .modal-title {
        font-weight: 600;
        color: #212529;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
    }

    .internship-edit-modal .modal-title i {
        font-size: 1.1rem;
    }

    .internship-edit-modal .modal-subtitle {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Form Elements */
    .internship-edit-form .form-label {
        font-size: 0.85rem;
        color: #495057;
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }

    .internship-edit-form .form-label i {
        margin-right: 8px;
        font-size: 0.9rem;
    }

    .internship-edit-form .form-control,
    .internship-edit-form .form-select,
    .internship-edit-form .form-check-input {
        font-size: 0.9rem;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        transition: all 0.3s;
    }

    .internship-edit-form .form-control:focus,
    .internship-edit-form .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .internship-edit-form .form-check-input {
        margin-top: 0.15rem;
    }

    .internship-edit-form .form-check-label {
        font-size: 0.9rem;
        color: #212529;
    }

    /* Radio button styles */
    .internship-edit-form .form-check {
        display: flex;
        align-items: center;
    }

    .internship-edit-form .form-check-input[type="radio"] {
        width: 1.1em;
        height: 1.1em;
        margin-right: 0.5rem;
    }

    /* Submit Button */
    .internship-edit-submit-btn {
        padding: 0.5rem 1.5rem;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.3s;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .internship-edit-submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }

 
    /* Responsive Adjustments */
    @media (max-width: 767.98px) {
        .internship-show-modal .modal-dialog,
        .internship-edit-modal .modal-dialog {
            max-width: 100%;
            margin: 0.5rem auto;
        }

        .internship-show-avatar,
        .internship-edit-avatar-container {
            width: 50px;
            height: 50px;
        }
        
        .internship-show-avatar-initial,
        .internship-edit-avatar-initial {
            font-size: 1.25rem;
        }
        
        .internship-show-info-badge {
            width: 36px;
            height: 36px;
        }

        .internship-edit-modal .modal-title {
            font-size: 1.15rem;
        }
        
        .internship-edit-form .form-label {
            font-size: 0.8rem;
        }
        
        .internship-edit-form .form-control,
        .internship-edit-form .form-select {
            font-size: 0.85rem;
            padding: 0.45rem 0.7rem;
        }
    }

    @media (max-width: 575.98px) {
        .internship-show-avatar,
        .internship-edit-avatar-container {
            width: 45px;
            height: 45px;
            margin-right: 0;
            margin-bottom: 0.75rem;
        }
        
        .internship-show-avatar-initial,
        .internship-edit-avatar-initial {
            font-size: 1.1rem;
        }
        
        .internship-show-info-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .internship-show-info-badge {
            margin-bottom: 0.5rem;
            margin-right: 0;
        }
        
        .internship-show-detail-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .internship-show-detail-label {
            margin-bottom: 0.25rem;
            min-width: auto;
        }

        .internship-edit-form .form-control,
        .internship-edit-form .form-select {
            font-size: 0.8rem;
            padding: 0.4rem 0.65rem;
        }
        
        .internship-edit-submit-btn {
            padding: 0.4rem 1.1rem;
            font-size: 0.8rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation for internship edit
    const internshipForms = document.querySelectorAll('.internship-edit-form');
    internshipForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});
</script>