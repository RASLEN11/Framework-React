<!-- Delete Internship Modal -->
<div class="modal fade internship-delete-modal" id="deleteInternshipModal{{ $application->id }}" tabindex="-1" aria-labelledby="deleteInternshipModalLabel{{ $application->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-body bg-white">
                <div class="d-flex align-items-center w-100">
                    <div class="flex-grow-1">
                        <h5 class="modal-title text-black" id="deleteInternshipModalLabel{{ $application->id }}">
                            <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                            Confirm Deletion
                        </h5>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="alert alert-danger d-flex align-items-center mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    This action cannot be undone!
                </div>
                
                <div class="application-preview d-flex align-items-center mb-4 p-3 bg-light rounded">
                    <div class="internship-delete-avatar-initial me-3 bg-dark text-white">
                        {{ strtoupper(substr($application->first_name, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="application-name mb-1 text-black">{{ $application->first_name }} {{ $application->last_name }}</h6>
                        <small class="text-muted">Applied for internship</small>
                    </div>
                </div>
                
                <p class="text-danger mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Are you sure you want to permanently delete this internship application?
                </p>
                
                <div class="d-flex justify-content-end gap-2">
                    <form action="{{ route('admin.applications.internship.destroy', $application->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger internship-delete-submit-btn">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Internship Delete Modal Styles - Matching Job Delete Modal */
    .internship-delete-modal .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .internship-delete-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }

    /* Modal Header */
    .internship-delete-modal .modal-header {
        border-bottom: 1px solid #f1f1f1;
        padding: 1.25rem 1.5rem;
        background-color: #fff;
    }

    .internship-delete-modal .modal-title {
        font-weight: 600;
        color: #dc3545;
        font-size: 1.15rem;
    }

    /* Avatar Styles */
    .internship-delete-avatar-initial {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.25rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Modal Body */
    .internship-delete-modal .modal-body {
        padding: 1.5rem;
    }

    .internship-delete-modal .alert-danger {
        background-color: rgba(220, 53, 69, 0.1);
        border-color: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    /* Delete Button */
    .internship-delete-submit-btn {
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        transition: all 0.3s;
    }

    .internship-delete-submit-btn:hover {
        background: linear-gradient(135deg, #c82333 0%, #dc3545 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .internship-delete-modal .modal-body {
            padding: 1.25rem;
        }
        
        .internship-delete-avatar-initial {
            width: 48px;
            height: 48px;
        }
    }

    @media (max-width: 767.98px) {
        .internship-delete-modal .modal-dialog {
            max-width: 100%;
            margin: 0.5rem auto;
        }
        
        .internship-delete-modal .modal-body {
            padding: 1rem;
        }
    }

    @media (max-width: 575.98px) {
        .internship-delete-modal .modal-title {
            font-size: 1.05rem;
        }
        
        .internship-delete-submit-btn {
            padding: 0.4rem 1rem;
            font-size: 0.8rem;
        }
    }
</style>