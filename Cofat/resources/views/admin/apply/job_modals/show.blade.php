<!-- Show Job Modal -->
<div class="modal fade job-show-modal" id="showJobModal{{ $application->id }}" tabindex="-1" aria-labelledby="showJobModalLabel{{ $application->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <div class="modal-body p-3 bg-white me-2">
                <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                    <div class="job-show-avatar me-sm-3 mb-2 mb-sm-0">
                        @if($application->avatar)
                            <img src="{{ asset('storage/' . $application->avatar) }}" alt="{{ $application->first_name }} {{ $application->last_name }}" class="job-show-avatar-img border border-dark" onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ strtoupper(substr($application->first_name, 0, 1)) }}{{ strtoupper(substr($application->last_name, 0, 1)) }}&background=ffffff&color=000000&size=60" 
                                 class="job-show-avatar-img border border-dark" 
                                 alt="{{ $application->first_name }} {{ $application->last_name }}">
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="job-show-title mb-0 text-black" id="showJobModalLabel{{ $application->id }}">
                            <i class="fas fa-briefcase me-2 text-black"></i>
                            {{ $application->first_name }} {{ $application->last_name }}'s Application
                        </h5>
                        <small class="job-show-subtitle text-muted">ID: {{ $application->id }}</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Personal Information Section -->
                <div class="row g-2 mb-2">
                    <div class="col-12 col-sm-6">
                        <div class="job-show-info-item">
                            <span class="job-show-info-badge bg-light text-black">
                                <i class="fas fa-id-card fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 job-show-info-label text-muted">CIN</p>
                                <p class="mb-0 job-show-info-value text-black">****{{ substr($application->cin, -4) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="job-show-info-item">
                            <span class="job-show-info-badge bg-light text-black">
                                <i class="fas fa-phone fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 job-show-info-label text-muted">Phone</p>
                                <p class="mb-0 job-show-info-value text-black">{{ $application->phone }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="job-show-info-item">
                            <span class="job-show-info-badge bg-light text-black">
                                <i class="fas fa-envelope fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 job-show-info-label text-muted">Email</p>
                                <p class="mb-0 job-show-info-value text-black">{{ $application->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="job-show-info-item">
                            <span class="job-show-info-badge bg-light text-black">
                                <i class="fas fa-birthday-cake fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 job-show-info-label text-muted">Age</p>
                                <p class="mb-0 job-show-info-value text-black">{{ $application->age }} years</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Position Information and Education in same row -->
                <div class="row g-2 mb-2">
                    <!-- Position Information Section -->
                    <div class="col-12 col-md-6">
                        <div class="job-show-section border-top border-secondary pt-3 h-100">
                            <h6 class="job-show-section-title text-black"><i class="fas fa-briefcase me-2 text-black"></i>Position Information</h6>
                            <div class="job-show-section-content">
                                <div class="job-show-detail-item">
                                    <span class="job-show-detail-label text-muted">Position:</span> 
                                    <span class="job-show-detail-value text-black">{{ ucwords(str_replace('_', ' ', $application->position)) }}</span>
                                </div>
                                <div class="job-show-detail-item">
                                    <span class="job-show-detail-label text-muted">Type:</span> 
                                    <span class="job-show-badge {{ $application->position_type === 'office' ? 'bg-primary' : 'bg-secondary' }} text-white">
                                        {{ ucfirst($application->position_type) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Education Section -->
                    <div class="col-12 col-md-6">
                        <div class="job-show-section border-top border-secondary pt-3 h-100">
                            <h6 class="job-show-section-title text-black"><i class="fas fa-graduation-cap me-2 text-black"></i>Education</h6>
                            <div class="job-show-section-content">
                                <div class="job-show-detail-item">
                                    <span class="job-show-detail-label text-muted">Level:</span> 
                                    <span class="job-show-badge job-show-badge-education bg-light text-black">
                                        {{ ucwords(str_replace('_', ' ', $application->education_level)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status and Cover Letter in same row -->
                <div class="row g-2 mb-2">
                    <!-- Status Section -->
                    <div class="col-12 col-md-6">
                        <div class="job-show-section border-top border-secondary pt-3 h-100">
                            <h6 class="job-show-section-title text-black"><i class="fas fa-info-circle me-2 text-black"></i>Status</h6>
                            <div class="job-show-section-content">
                                <div class="job-show-detail-item">
                                    <span class="job-show-detail-label text-muted">Status:</span> 
                                    <span class="job-show-badge {{ 
                                        $application->status === 'pending' ? 'bg-warning text-white' : 
                                        ($application->status === 'under_review' ? 'bg-info text-white' : 
                                        ($application->status === 'approved' ? 'bg-success text-white' : 
                                        ($application->status === 'rejected' ? 'bg-danger text-white' : 'bg-secondary text-white')))
                                    }}">
                                        {{ ucfirst(str_replace('_', ' ', $application->status)) }}
                                    </span>
                                </div>
                                <div class="job-show-detail-item">
                                    <span class="job-show-detail-label text-muted">Applied On:</span> 
                                    <span class="job-show-detail-value text-black">{{ $application->created_at->format('d M Y \a\t H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Cover Letter Section -->
                    @if($application->cover_letter)
                    <div class="col-12 col-md-6">
                        <div class="job-show-section border-top border-secondary pt-3 h-100">
                            <h6 class="job-show-section-title text-black"><i class="fas fa-envelope me-2 text-black"></i>Cover Letter</h6>
                            <div class="job-show-section-content">
                                <div class="job-show-message text-black">
                                    {{ $application->cover_letter }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                @if($application->notes)
                <div class="job-show-section border-top border-secondary pt-3">
                    <h6 class="job-show-section-title text-black"><i class="fas fa-sticky-note me-2 text-black"></i>Notes</h6>
                    <div class="job-show-section-content">
                        <div class="job-show-message text-black">
                            {{ $application->notes }}
                        </div>
                    </div>
                </div>
                @endif

                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('admin.applications.job.download.cv', $application->id) }}" class="btn btn-dark rounded-pill px-4">
                        <i class="fas fa-download me-2"></i>Download CV
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* job Show Modal Styles - Matched to Create Modal */
    .job-show-modal .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .job-show-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Avatar Styles */
    .job-show-avatar {
        width: 60px;
        height: 60px;
        position: relative;
        margin-right: 1rem;
    }

    .job-show-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Title Styles */
    .job-show-title {
        font-weight: 600;
        color: #212529;
        font-size: 1.25rem;
        margin-bottom: 0.25rem;
    }

    .job-show-subtitle {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Info Items */
    .job-show-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .job-show-info-badge {
        background-color: rgba(63, 128, 234, 0.1);
        color: #3f80ea;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    .job-show-info-label {
        font-size: 0.75rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }

    .job-show-info-value {
        font-size: 0.9rem;
        font-weight: 500;
        color: #212529;
    }

    /* Sections */
    .job-show-section {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
        height: 100%;
    }

    .job-show-section-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    /* Detail Items */
    .job-show-detail-item {
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .job-show-detail-label {
        font-weight: 600;
        color: #212529;
        min-width: 100px;
        margin-right: 1rem;
    }

    .job-show-detail-value {
        color: #495057;
    }

    /* Badges */
    .job-show-badge {
        font-size: 0.8rem;
        padding: 0.4em 0.8em;
        border-radius: 50px;
        font-weight: 500;
        display: inline-block;
    }

    .job-show-badge-education {
        background-color: #20c997;
        color: white;
    }

    /* Message Content */
    .job-show-message {
        font-size: 0.9rem;
        color: #495057;
        line-height: 1.6;
        white-space: pre-line;
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .job-show-avatar {
            width: 50px;
            height: 50px;
        }
    }

    @media (max-width: 767.98px) {
        .job-show-modal .modal-dialog {
            max-width: 100%;
            margin: 0.5rem auto;
        }
    }

    @media (max-width: 575.98px) {
        .job-show-avatar {
            width: 45px;
            height: 45px;
            margin-right: 0;
            margin-bottom: 0.75rem;
        }
        
        .job-show-info-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .job-show-info-badge {
            margin-bottom: 0.5rem;
            margin-right: 0;
        }
        
        .job-show-detail-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .job-show-detail-label {
            margin-bottom: 0.25rem;
            min-width: auto;
        }
    }
</style>