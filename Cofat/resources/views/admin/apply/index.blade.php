@extends('admin.layouts.app')
@section('title', 'Applications Dashboard - COFAT Management System')

@section('content')
<!-- Hero Section -->
<section class="applications-hero text-white text-center py-5">
    <div class="container position-relative">
        <div class="hero-content">
            <h1 class="display-4 fw-bold mb-3"><i class="fas fa-file-alt me-2"></i>Applications Dashboard</h1>
            <p class="lead mb-4">Manage all applications for COFAT</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <div class="applications-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="applications-title">Applications Overview</h2>
        </div>

        <!-- Centered Tabs Navigation -->
        <div class="d-flex justify-content-center mb-2">
            <ul class="nav nav-tabs applications-tabs" id="applicationsTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="jobs-tab" data-bs-toggle="tab" data-bs-target="#jobs-tab-pane" type="button" role="tab" aria-controls="jobs-tab-pane" aria-selected="true">
                        <i class="fas fa-briefcase me-2"></i>Job
                        <span class="badge bg-dark ms-2">{{ $jobApplications->total() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="internships-tab" data-bs-toggle="tab" data-bs-target="#internships-tab-pane" type="button" role="tab" aria-controls="internships-tab-pane" aria-selected="false">
                        <i class="fas fa-user-graduate me-2"></i>Internship
                        <span class="badge bg-dark ms-2">{{ $internshipApplications->total() }}</span>
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tabs Content -->
        <div class="tab-content" id="applicationsTabsContent">
            <!-- Job Applications Tab -->
            <div class="tab-pane fade show active" id="jobs-tab-pane" role="tabpanel" aria-labelledby="jobs-tab" tabindex="0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle applications-table" id="jobApplicationsTable">
                        <thead class="applications-table-header">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Applicant</th>
                                <th>Email</th>
                                <th>Position</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jobApplications as $application)
                            <tr class="border-top">
                                <td class="ps-4" data-label="#">{{ ($jobApplications->currentPage() - 1) * $jobApplications->perPage() + $loop->iteration }}</td>
                                <td data-label="Applicant">
                                    <div class="d-flex align-items-center">
                                        <div class="applications-avatar me-3">
                                            <span>{{ strtoupper(substr($application->first_name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <strong>{{ $application->first_name }} {{ $application->last_name }}</strong>
                                            <div class="small text-muted">{{ $application->phone }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Email">{{ $application->email }}</td>
                                <td data-label="Position">{{ ucwords(str_replace('_', ' ', $application->position)) }}</td>
                                <td data-label="Type">
                                    <span class="badge rounded-pill applications-badge-{{ $application->position_type }}">
                                        {{ ucfirst($application->position_type) }}
                                    </span>
                                </td>
                                <td data-label="Status">
                                    <span class="badge applications-status-badge applications-status-{{ $application->status }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td data-label="Date">
                                    {{ $application->created_at->format('M d, Y') }}
                                </td>
                                <td class="text-center" data-label="Actions">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button type="button" class="btn btn-sm btn-info applications-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#showJobModal{{ $application->id }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary applications-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#editJobModal{{ $application->id }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger applications-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#deleteJobModal{{ $application->id }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Showing {{ $jobApplications->firstItem() }} to {{ $jobApplications->lastItem() }} of {{ $jobApplications->total() }} entries
                    </div>
                    <div>
                        {{ $jobApplications->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

            <!-- Internship Applications Tab -->
            <div class="tab-pane fade" id="internships-tab-pane" role="tabpanel" aria-labelledby="internships-tab" tabindex="0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle applications-table" id="internshipApplicationsTable">
                        <thead class="applications-table-header">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Applicant</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($internshipApplications as $application)
                            <tr class="border-top">
                                <td class="ps-4" data-label="#">{{ ($internshipApplications->currentPage() - 1) * $internshipApplications->perPage() + $loop->iteration }}</td>
                                <td data-label="Applicant">
                                    <div class="d-flex align-items-center">
                                        <div class="applications-avatar me-3">
                                            <span>{{ strtoupper(substr($application->first_name, 0, 1)) }}</span>
                                        </div>
                                        <div>
                                            <strong>{{ $application->first_name }} {{ $application->last_name }}</strong>
                                            <div class="small text-muted">{{ $application->phone }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Email">{{ $application->email }}</td>
                                <td data-label="Type">
                                    <span class="badge rounded-pill applications-badge-{{ $application->position_type }}">
                                        {{ ucfirst($application->position_type) }}
                                    </span>
                                </td>
                                <td data-label="Status">
                                    <span class="badge applications-status-badge applications-status-{{ $application->status }}">
                                        {{ ucfirst($application->status) }}
                                    </span>
                                </td>
                                <td data-label="Date">
                                    {{ $application->created_at->format('M d, Y') }}
                                </td>
                                <td class="text-center" data-label="Actions">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button type="button" class="btn btn-sm btn-info applications-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#showInternshipModal{{ $application->id }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary applications-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#editInternshipModal{{ $application->id }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger applications-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#deleteInternshipModal{{ $application->id }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Showing {{ $internshipApplications->firstItem() }} to {{ $internshipApplications->lastItem() }} of {{ $internshipApplications->total() }} entries
                    </div>
                    <div>
                        {{ $internshipApplications->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Auto-dismiss Alert Modal -->
<div class="modal fade" id="autoDismissModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                <h4 class="text-dark mb-3">Success!</h4>
                <p class="text-dark" id="alertMessage"></p>
            </div>
        </div>
    </div>
</div>

<!-- Include Modals -->
 @foreach($jobApplications as $application)
    @include('admin.apply.job_modals.edit', ['jobApplications' => $application])
    @include('admin.apply.job_modals.show', ['jobApplications' => $application])
    @include('admin.apply.job_modals.delete', ['jobApplications' => $application])
@endforeach

 @foreach($internshipApplications as $application)
    @include('admin.apply.internship_modals.edit', ['internshipApplications' => $application])
    @include('admin.apply.internship_modals.show', ['internshipApplications' => $application])
    @include('admin.apply.internship_modals.delete', ['internshipApplications' => $application])
@endforeach


<style>
    /* Applications Page Specific Styles */
    .applications-hero {
        background: linear-gradient(135deg, #212529 0%, #343a40 100%);
        height: 45vh;
        min-height: 350px;
        border-radius: 20px;
        margin: 20px auto;
        max-width: 98%;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        padding: 2rem;
    }

    .applications-hero:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 70% 20%, rgba(255,255,255,0.1) 0%, transparent 70%);
    }

    .applications-card {
        max-width: 1400px;
        margin: -70px auto 5rem;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 3rem;
        background-color: white;
        position: relative;
        z-index: 1;
    }

    .applications-title {
        position: relative;
        margin-bottom: 0;
        color: #343a40;
        font-weight: 700;
        font-size: 1.8rem;
    }

    .applications-title:after {
        content: "";
        position: absolute;
        bottom: -10px;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #343a40 0%, #f8f9fa 100%);
        border-radius: 2px;
    }

    /* Table Styles */
    .applications-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .applications-table-header {
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        color: white;
        position: sticky;
        top: 0;
    }

    .applications-table-header th {
        white-space: nowrap;
        padding: 0.3rem;
        font-weight: 600;
        border: none;
    }

    .applications-table tbody tr {
        transition: all 0.2s ease;
    }

    .applications-table tbody tr:hover {
        background-color: rgba(52, 58, 64, 0.03);
        transform: translateY(-1px);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .applications-table td {
        padding: 0.3rem;
        vertical-align: middle;
        border-top: 1px solid #f1f1f1;
    }

    /* Avatar Styles */
    .applications-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Button Styles */
    .applications-action-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .applications-action-btn:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    /* Badge Styles */
    .applications-badge-office {
        background-color: #0d6efd;
        color: white;
    }

    .applications-badge-factory {
        background-color: #fd7e14;
        color: white;
    }

    .applications-status-badge {
        font-size: 0.8rem;
        padding: 0.4em 0.8em;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .applications-status-pending {
        background-color: #ffc107;
        color: #212529;
    }

    .applications-status-under_review {
        background-color: #0dcaf0;
        color: white;
    }

    .applications-status-approved {
        background-color: #198754;
        color: white;
    }

    .applications-status-rejected {
        background-color: #dc3545;
        color: white;
    }

    /* Tab Styles - Centered */
    .applications-tabs {
        border-bottom: none;
        margin-bottom: 1.5rem;
        background: rgba(52, 58, 64, 0.05);
        border-radius: 12px;
        padding: 0.5rem;
    }

    .applications-tabs .nav-link {
        padding: 0.8rem 1.8rem;
        font-weight: 600;
        color: #495057;
        border-radius: 8px;
        margin: 0 0.3rem;
        transition: all 0.3s ease;
        border: none;
        background-color: transparent;
        position: relative;
    }

    .applications-tabs .nav-link.active {
        color: white;
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .applications-tabs .nav-link:hover:not(.active) {
        background-color: rgba(52, 58, 64, 0.08);
    }

    .applications-tabs .badge {
        position: absolute;
        top: -8px;
        right: -8px;
        font-size: 0.6rem;
        padding: 0.25em 0.5em;
    }

    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .applications-card {
            padding: 2rem;
        }
    }

    @media (max-width: 992px) {
        .applications-hero {
            height: auto;
            padding: 3rem 1rem;
        }
    }

    @media (max-width: 768px) {
        .applications-card {
            padding: 1.5rem;
            margin-top: -50px;
        }
        
        .applications-title {
            font-size: 1.5rem;
        }
        
        /* Adjust tab navigation */
        .applications-tabs {
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
            justify-content: flex-start;
            padding-bottom: 0;
        }
    
        .applications-tabs .nav-link {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }
        
        /* Responsive table */
        .applications-table {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .d-flex.justify-content-between.align-items-center {
            flex-direction: column;
            gap: 1rem;
        }
    }

    @media (max-width: 576px) {
        .applications-hero {
            padding: 2.5rem 1rem;
        }
        
        .applications-title {
            font-size: 1.3rem;
        }
        
        .applications-title:after {
            bottom: -8px;
            height: 2px;
            width: 40px;
        }
        
        /* Stacked table rows for mobile */
        .applications-table {
            display: block;
        }
        
        .applications-table thead {
            display: none;
        }
        
        .applications-table tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 0.5rem;
        }
        
        .applications-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .applications-table td:before {
            content: attr(data-label);
            font-weight: bold;
            margin-right: 1rem;
            color: #343a40;
            font-size: 0.85rem;
        }
        
        .applications-table td:last-child {
            border-bottom: none;
        }
        
        /* Adjust action buttons */
        .applications-action-btn {
            width: 32px;
            height: 32px;
            font-size: 0.8rem;
        }
    }

    /* For extremely small screens */
    @media (max-width: 400px) {
        .applications-tabs .nav-link {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-dismiss alert after 5 seconds
        const alert = document.getElementById('autoDismissAlert');
        if (alert) {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        }
        
        // Show success message in modal if exists
        @if(session('success'))
            const alertModal = new bootstrap.Modal(document.getElementById('autoDismissModal'));
            document.getElementById('alertMessage').textContent = "{{ session('success') }}";
            alertModal.show();
            
            setTimeout(() => {
                alertModal.hide();
            }, 5000);
        @endif

        // Handle tab switching to update URL without full page reload
        const applicationsTabs = document.getElementById('applicationsTabs');
        if (applicationsTabs) {
            applicationsTabs.addEventListener('shown.bs.tab', function(event) {
                const newTab = event.target.id; // e.g., 'jobs-tab' or 'internships-tab'
                const currentUrl = new URL(window.location.href);
                
                if (newTab === 'jobs-tab') {
                    currentUrl.searchParams.set('tab', 'jobs');
                } else if (newTab === 'internships-tab') {
                    currentUrl.searchParams.set('tab', 'internships');
                }
                window.history.pushState({path: currentUrl.href}, '', currentUrl.href);
            });

            // Activate tab based on URL parameter on page load
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            if (tab) {
                const triggerTab = document.querySelector('#' + tab + '-tab');
                if (triggerTab) {
                    const bsTab = new bootstrap.Tab(triggerTab);
                    bsTab.show();
                }
            }
        }

        // AJAX Pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            fetchApplications(url);
            window.history.pushState({}, '', url);
        });

        function fetchApplications(url) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const activeTab = document.querySelector('.tab-pane.active');
                    if (activeTab.id === 'jobs-tab-pane') {
                        activeTab.querySelector('tbody').innerHTML = data.jobs_html;
                        activeTab.querySelector('.pagination').innerHTML = data.jobs_pagination;
                    } else {
                        activeTab.querySelector('tbody').innerHTML = data.internships_html;
                        activeTab.querySelector('.pagination').innerHTML = data.internships_pagination;
                    }
                    setupMobileTables(); // Reinitialize mobile table view
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        // Handle browser back/forward buttons
        window.addEventListener('popstate', function() {
            fetchApplications(window.location.href);
        });

        // Setup mobile tables
        function setupMobileTables() {
            if (window.innerWidth < 576) {
                // Job applications table
                const jobHeaders = ['#', 'Applicant', 'Email', 'Position', 'Type', 'Status', 'Date', 'Actions'];
                document.querySelectorAll('#jobs-tab-pane tbody tr').forEach(row => {
                    const cells = row.querySelectorAll('td');
                    cells.forEach((cell, index) => {
                        if (index < jobHeaders.length) {
                            cell.setAttribute('data-label', jobHeaders[index]);
                        }
                    });
                });
                
                // Internship applications table
                const internshipHeaders = ['#', 'Applicant', 'Email', 'Type', 'Status', 'Date', 'Actions'];
                document.querySelectorAll('#internships-tab-pane tbody tr').forEach(row => {
                    const cells = row.querySelectorAll('td');
                    cells.forEach((cell, index) => {
                        if (index < internshipHeaders.length) {
                            cell.setAttribute('data-label', internshipHeaders[index]);
                        }
                    });
                });
            }
        }
        
        // Run on load and on resize
        setupMobileTables();
        window.addEventListener('resize', setupMobileTables);

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection