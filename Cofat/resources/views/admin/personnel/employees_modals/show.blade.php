<div class="modal fade employee-show-modal" id="showEmployeeModal{{ $employee->id }}" tabindex="-1" aria-labelledby="showEmployeeModalLabel{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <div class="modal-body p-3 p-md-4 bg-white">
                <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                    <div class="employee-show-avatar me-sm-3 mb-2 mb-sm-0">
                        @if($employee->avatar)
                            <img src="{{ asset('storage/' . $employee->avatar) }}" alt="{{ $employee->full_name }}" class="employee-show-avatar-img border border-dark" onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'">
                        @else
                            <span class="employee-show-avatar-initial bg-dark text-white">{{ strtoupper(substr($employee->full_name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="employee-show-title mb-0 text-black" id="showEmployeeModalLabel{{ $employee->id }}">
                            <i class="fas fa-user-tie me-2 text-black"></i>
                            {{ $employee->full_name }}
                        </h5>
                        <small class="employee-show-subtitle text-muted">ID: {{ $employee->id }}</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="row mt-3">
                    <!-- Left Column -->
                    <div class="col-md-6 pe-md-3">
                        <div class="row mb-3 g-3">
                            <div class="col-12 col-sm-6">
                                <div class="employee-show-info-item">
                                    <span class="employee-show-info-badge bg-light text-black">
                                        <i class="fas fa-id-card fa-fw text-black"></i>
                                    </span>
                                    <div>
                                        <p class="mb-0 employee-show-info-label text-muted">CIN</p>
                                        <p class="mb-0 employee-show-info-value text-black">****{{ substr($employee->cin, -4) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="employee-show-info-item">
                                    <span class="employee-show-info-badge bg-light text-black">
                                        <i class="fas fa-phone fa-fw text-black"></i>
                                    </span>
                                    <div>
                                        <p class="mb-0 employee-show-info-label text-muted">Phone</p>
                                        <p class="mb-0 employee-show-info-value text-black">{{ $employee->phone_number }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="employee-show-info-item">
                                    <span class="employee-show-info-badge bg-light text-black">
                                        <i class="fas fa-birthday-cake fa-fw text-black"></i>
                                    </span>
                                    <div>
                                        <p class="mb-0 employee-show-info-label text-muted">Birth Date</p>
                                        <p class="mb-0 employee-show-info-value text-black">{{ $employee->birth_date->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="employee-show-info-item">
                                    <span class="employee-show-info-badge bg-light text-black">
                                        <i class="fas fa-venus-mars fa-fw text-black"></i>
                                    </span>
                                    <div>
                                        <p class="mb-0 employee-show-info-label text-muted">Gender</p>
                                        <p class="mb-0 employee-show-info-value employee-show-gender employee-show-gender-{{ strtolower($employee->genre) }} text-black">
                                            {{ ucfirst($employee->genre) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="employee-show-section border-top border-secondary pt-2">
                            <h6 class="employee-show-section-title text-black"><i class="fas fa-graduation-cap me-2 text-black"></i>Education & Employment</h6>
                            <div class="employee-show-section-content">
                                <div class="employee-show-detail-item">
                                    <span class="employee-show-detail-label text-muted">Education:</span> 
                                    <span class="employee-show-badge employee-show-badge-education bg-light text-black">
                                        {{ str_replace('_', ' ', $employee->education_level) }}
                                    </span>
                                </div>
                                <div class="employee-show-detail-item">
                                    <span class="employee-show-detail-label text-muted">Hired:</span> 
                                    <span class="employee-show-detail-value text-black">{{ $employee->hire_date->format('d M Y') }}</span>
                                </div>
                                <div class="employee-show-detail-item">
                                    <span class="employee-show-detail-label text-muted">Seniority:</span> 
                                    <span class="employee-show-detail-value text-black">{{ $employee->seniority }} years</span>
                                </div>
                                <div class="employee-show-detail-item">
                                    <span class="employee-show-detail-label text-muted">Category:</span> 
                                    <span class="employee-show-badge employee-show-badge-category employee-show-category-{{ strtolower($employee->category) }} bg-light text-black">
                                        {{ ucfirst($employee->category) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="employee-show-section border-top border-secondary pt-2">
                            <h6 class="employee-show-section-title text-black"><i class="fas fa-map-marker-alt me-2 text-black"></i>Address</h6>
                            <div class="employee-show-section-content">
                                <p class="employee-show-address text-black">{{ $employee->address }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column - Qualifications -->
                    <div class="col-md-6">
                        @if($employee->qualifications->count() > 0)
                        <div class="employee-show-section border-top border-secondary pt-2">
                            <h6 class="employee-show-section-title text-black"><i class="fas fa-certificate me-2 text-black"></i>Qualifications ({{ $employee->qualifications->count() }})</h6>
                            <div class="employee-show-section-content">
                                <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                    <table class="table table-sm table-hover employee-show-qualifications-table">
                                        <thead class="bg-light" style="position: sticky; top: 0; z-index: 1;">
                                            <tr>
                                                <th class="text-black">Type</th>
                                                <th class="text-black">Date</th>
                                                <th class="text-black">Trainer</th>
                                                <th class="text-black">Score</th>
                                                <th class="text-black">Next Qualification</th>
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="employee-show-section border-top border-secondary pt-3 h-100">
                            <h6 class="employee-show-section-title text-black"><i class="fas fa-certificate me-2 text-black"></i>Qualifications</h6>
                            <div class="employee-show-section-content">
                                <div class="alert alert-dark color-white mb-0 py-2">
                                    <i class="fas fa-info-circle me-2"></i>No qualifications recorded for this employee.
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Updated CSS for the two-column layout */
    
    /* Modal Container - Centering Styles */
    .employee-show-modal .modal-dialog {
        max-width: 1100px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    /* Rest of your existing CSS remains the same */
    .employee-show-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Avatar Styles */
    .employee-show-avatar {
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

    .employee-show-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .employee-show-avatar-initial {
        font-size: 1.5rem;
        font-weight: bold;
        color: white;
        position: absolute;
        text-transform: uppercase;
    }

    /* Fallback for broken images */
    .employee-show-avatar-img[src*="default-avatar.png"] {
        object-fit: contain;
        padding: 15%;
        background-color: #f8f9fa;
    }

    .employee-show-title {
        font-weight: 600;
        color: #212529;
        font-size: 1.25rem;
        margin-bottom: 0.25rem;
    }

    .employee-show-subtitle {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Info Items */
    .employee-show-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .employee-show-info-badge {
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

    .employee-show-info-label {
        font-size: 0.75rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }

    .employee-show-info-value {
        font-size: 0.9rem;
        font-weight: 500;
        color: #212529;
    }

    /* Gender Badge */
    .employee-show-gender {
        font-size: 0.75rem;
        padding: 0.35em 0.65em;
        border-radius: 50px;
        display: inline-block;
    }

    /* Sections */
    .employee-show-section {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 1.25rem;
        margin-bottom: 1.25rem;
    }

    .employee-show-section-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    /* Detail Items */
    .employee-show-detail-item {
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
    }

    .employee-show-detail-label {
        font-weight: 600;
        color: #212529;
        min-width: 100px;
        margin-right: 1rem;
    }

    .employee-show-detail-value {
        color: #495057;
    }

    /* Badges */
    .employee-show-badge {
        font-size: 0.8rem;
        padding: 0.4em 0.8em;
        border-radius: 50px;
        font-weight: 500;
        display: inline-block;
    }

    .employee-show-badge-education {
        background-color: #20c997;
        color: white;
    }

    .employee-show-badge-category {
        color: white;
    }

    .employee-show-category-direct {
        background-color: #0d6efd;
    }

    .employee-show-category-indirect {
        background-color: #6c757d;
    }

    /* Address */
    .employee-show-address {
        font-size: 0.9rem;
        color: #495057;
        line-height: 1.6;
    }

    /* Qualifications Table */
    .employee-show-qualifications-table {
        font-size: 0.8rem;
        margin-top: 0.7rem;
    }

    .employee-show-qualifications-table th {
        font-weight: 600;
        background-color: rgba(0, 0, 0, 0.03);
        padding: 0.3rem;
        white-space: nowrap;
    }

    .employee-show-qualifications-table td {
        padding: 0.3rem;
        vertical-align: middle;
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
        .employee-show-modal .modal-dialog {
            max-width: 100%;
        }
        
        .employee-show-avatar {
            width: 50px;
            height: 50px;
        }
        
        .employee-show-avatar-initial {
            font-size: 1.25rem;
        }
        
        .employee-show-info-badge {
            width: 36px;
            height: 36px;
        }
    }

    @media (max-width: 767.98px) {
        .employee-show-modal .modal-dialog {
            margin: 0.5rem auto;
        }
        
        .employee-show-modal .modal-content {
            border-radius: 0;
        }
        
        .employee-show-qualifications-table {
            font-size: 0.8rem;
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
        .employee-show-avatar {
            width: 45px;
            height: 45px;
            margin-right: 0;
            margin-bottom: 0.75rem;
        }
        
        .employee-show-avatar-initial {
            font-size: 1.1rem;
        }
        
        .employee-show-info-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .employee-show-info-badge {
            margin-bottom: 0.5rem;
            margin-right: 0;
        }
        
        .employee-show-detail-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .employee-show-detail-label {
            margin-bottom: 0.25rem;
            min-width: auto;
        }
        
        .employee-show-qualifications-table {
            display: block;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    }
</style>