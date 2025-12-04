@foreach($jobApplications as $application)




<!-- Delete Job Modal -->
<div class="modal fade stagiaire-delete-modal" id="deleteJobModal{{ $application->id }}" tabindex="-1" aria-labelledby="deleteJobModalLabel{{ $application->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-body bg-white">
                <div class="d-flex align-items-center w-100">
                    <div class="flex-grow-1">
                        <h5 class="modal-title text-black" id="deleteJobModalLabel{{ $application->id }}">
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
                
                <div class="stagiaire-preview d-flex align-items-center mb-4 p-3 bg-light rounded">
                    <div class="stagiaire-avatar-initial me-3 bg-dark text-white">
                        {{ strtoupper(substr($application->first_name, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="stagiaire-name mb-1 text-black">{{ $application->first_name }} {{ $application->last_name }}</h6>
                        <small class="text-muted">Position: {{ ucwords(str_replace('_', ' ', $application->position)) }}</small>
                    </div>
                </div>
                
                <p class="text-danger mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Are you sure you want to permanently delete this job application?
                </p>
                
                <div class="d-flex justify-content-end gap-2">
                    <form action="{{ route('admin.applications.job.destroy', $application->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-submit-btn">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation for job edit
    const jobForms = document.querySelectorAll('.stagiaire-edit-form');
    jobForms.forEach(form => {
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