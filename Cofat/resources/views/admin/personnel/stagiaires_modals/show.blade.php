{{-- resources/views/admin/stagiaires/show.blade.php --}}
<div class="modal fade stagiaire-show-modal" id="showStagiaireModal{{ $stagiaire->id }}" tabindex="-1" aria-labelledby="showStagiaireModalLabel{{ $stagiaire->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <div class="modal-body p-3 bg-white me-2">
                <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                    <div class="stagiaire-show-avatar me-sm-3 mb-2 mb-sm-0">
                        @if($stagiaire->avatar)
                            <img src="{{ asset('storage/' . $stagiaire->avatar) }}" alt="{{ $stagiaire->full_name }}" class="stagiaire-show-avatar-img border border-dark" onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ strtoupper(substr($stagiaire->full_name, 0, 1)) }}&background=ffffff&color=000000&size=60" 
                                 class="stagiaire-show-avatar-img border border-dark" 
                                 alt="{{ $stagiaire->full_name }}">
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="stagiaire-show-title mb-0 text-black" id="showStagiaireModalLabel{{ $stagiaire->id }}">
                            <i class="fas fa-user-graduate me-2 text-black"></i>
                            {{ $stagiaire->full_name }}
                        </h5>
                        <small class="stagiaire-show-subtitle text-muted">ID: {{ $stagiaire->id }}</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Personal Information Section -->
                <div class="row g-2 mb-2">
                    <div class="col-12 col-sm-6">
                        <div class="stagiaire-show-info-item">
                            <span class="stagiaire-show-info-badge bg-light text-black">
                                <i class="fas fa-id-card fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 stagiaire-show-info-label text-muted">CIN</p>
                                <p class="mb-0 stagiaire-show-info-value text-black">****{{ substr($stagiaire->cin, -4) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="stagiaire-show-info-item">
                            <span class="stagiaire-show-info-badge bg-light text-black">
                                <i class="fas fa-phone fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 stagiaire-show-info-label text-muted">Phone</p>
                                <p class="mb-0 stagiaire-show-info-value text-black">{{ $stagiaire->phone_number }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="stagiaire-show-info-item">
                            <span class="stagiaire-show-info-badge bg-light text-black">
                                <i class="fas fa-birthday-cake fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 stagiaire-show-info-label text-muted">Birth Date</p>
                                <p class="mb-0 stagiaire-show-info-value text-black">{{ $stagiaire->birth_date->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="stagiaire-show-info-item">
                            <span class="stagiaire-show-info-badge bg-light text-black">
                                <i class="fas fa-venus-mars fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 stagiaire-show-info-label text-muted">Gender</p>
                                <p class="mb-0 stagiaire-show-info-value stagiaire-show-gender stagiaire-show-gender-{{ strtolower($stagiaire->genre) }} text-black">
                                    {{ ucfirst($stagiaire->genre) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Education Section -->
                <div class="stagiaire-show-section border-top border-secondary pt-3 mb-2">
                    <h6 class="stagiaire-show-section-title text-black"><i class="fas fa-graduation-cap me-2 text-black"></i>Education</h6>
                    <div class="stagiaire-show-section-content">
                        <div class="stagiaire-show-detail-item">
                            <span class="stagiaire-show-detail-label text-muted">Level:</span> 
                            <span class="stagiaire-show-badge stagiaire-show-badge-education bg-light text-black">
                                {{ str_replace('_', ' ', $stagiaire->education_level) }}
                            </span>
                        </div>
                        <div class="stagiaire-show-detail-item">
                            <span class="stagiaire-show-detail-label text-muted">School:</span> 
                            <span class="stagiaire-show-detail-value text-black">{{ $stagiaire->school }}</span>
                        </div>
                        <div class="stagiaire-show-detail-item">
                            <span class="stagiaire-show-detail-label text-muted">Field:</span> 
                            <span class="stagiaire-show-detail-value text-black">{{ $stagiaire->field_of_study }}</span>
                        </div>
                    </div>
                </div>

                <!-- Address Section -->
                <div class="stagiaire-show-section border-top border-secondary pt-3 mb-2">
                    <h6 class="stagiaire-show-section-title text-black"><i class="fas fa-map-marker-alt me-2 text-black"></i>Address</h6>
                    <div class="stagiaire-show-section-content">
                        <p class="stagiaire-show-address text-black">{{ $stagiaire->address }}</p>
                    </div>
                </div>

                <!-- Internship Section -->
                <div class="stagiaire-show-section border-top border-secondary pt-3">
                    <h6 class="stagiaire-show-section-title text-black"><i class="fas fa-calendar-alt me-2 text-black"></i>Internship Period</h6>
                    <div class="stagiaire-show-section-content">
                        <div class="stagiaire-show-detail-item">
                            <span class="stagiaire-show-detail-label text-muted">Duration:</span> 
                            <span class="stagiaire-show-detail-value text-black">{{ $stagiaire->duration }} months</span>
                        </div>
                        <div class="stagiaire-show-detail-item">
                            <span class="stagiaire-show-detail-label text-muted">From:</span> 
                            <span class="stagiaire-show-detail-value text-black">{{ $stagiaire->start_date->format('d M Y') }}</span>
                        </div>
                        <div class="stagiaire-show-detail-item">
                            <span class="stagiaire-show-detail-label text-muted">To:</span> 
                            <span class="stagiaire-show-detail-value text-black">{{ $stagiaire->end_date->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Stagiaire Show Modal Styles - Matched to Create Modal */
    .stagiaire-show-modal .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .stagiaire-show-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Avatar Styles */
    .stagiaire-show-avatar {
        width: 60px;
        height: 60px;
        position: relative;
        margin-right: 1rem;
    }

    .stagiaire-show-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /* Title Styles */
    .stagiaire-show-title {
        font-weight: 600;
        color: #212529;
        font-size: 1.25rem;
        margin-bottom: 0.25rem;
    }

    .stagiaire-show-subtitle {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Info Items */
    .stagiaire-show-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .stagiaire-show-info-badge {
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

    .stagiaire-show-info-label {
        font-size: 0.75rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }

    .stagiaire-show-info-value {
        font-size: 0.9rem;
        font-weight: 500;
        color: #212529;
    }

    /* Gender Badge */
    .stagiaire-show-gender {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
        border-radius: 50px;
        display: inline-block;
    }

    .stagiaire-show-gender-male {
        background-color: #0d6efd;
        color: white;
    }

    .stagiaire-show-gender-female {
        background-color: #dc3545;
        color: white;
    }

    /* Sections */
    .stagiaire-show-section {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .stagiaire-show-section-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    /* Detail Items */
    .stagiaire-show-detail-item {
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .stagiaire-show-detail-label {
        font-weight: 600;
        color: #212529;
        min-width: 100px;
        margin-right: 1rem;
    }

    .stagiaire-show-detail-value {
        color: #495057;
    }

    /* Badges */
    .stagiaire-show-badge {
        font-size: 0.8rem;
        padding: 0.4em 0.8em;
        border-radius: 50px;
        font-weight: 500;
        display: inline-block;
    }

    .stagiaire-show-badge-education {
        background-color: #20c997;
        color: white;
    }

    /* Address */
    .stagiaire-show-address {
        font-size: 0.9rem;
        color: #495057;
        line-height: 1.6;
    }

    /* Responsive Adjustments - Matched to Create Modal */
    @media (max-width: 991.98px) {
        .stagiaire-show-avatar {
            width: 50px;
            height: 50px;
        }
    }

    @media (max-width: 767.98px) {
        .stagiaire-show-modal .modal-dialog {
            max-width: 100%;
            margin: 0.5rem auto;
        }
    }

    @media (max-width: 575.98px) {
        .stagiaire-show-avatar {
            width: 45px;
            height: 45px;
            margin-right: 0;
            margin-bottom: 0.75rem;
        }
        
        .stagiaire-show-info-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stagiaire-show-info-badge {
            margin-bottom: 0.5rem;
            margin-right: 0;
        }
        
        .stagiaire-show-detail-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stagiaire-show-detail-label {
            margin-bottom: 0.25rem;
            min-width: auto;
        }
    }
</style>