@extends('admin.layouts.app')
@section('title', 'Personnel Management - COFAT Management System')

@section('content')
<!-- Hero Section -->
<section class="personnel-hero text-white text-center py-5">
    <div class="container position-relative">
        <div class="hero-content">
            <h1 class="display-4 fw-bold mb-3"><i class="fas fa-users me-2"></i>Personnel Management</h1>
            <p class="lead mb-4">
                Manage all employees and interns of COFAT
            </p>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <div class="personnel-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="personnel-title">Personnel Overview</h2>
        </div>

        <!-- Centered Tabs Navigation -->
        <div class="d-flex justify-content-center mb-2">
            <ul class="nav nav-tabs personnel-tabs" id="personnelTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="employees-tab" data-bs-toggle="tab" data-bs-target="#employees-tab-pane" type="button" role="tab" aria-controls="employees-tab-pane" aria-selected="true">
                        <i class="fas fa-users me-2"></i>Employees
                        <span class="badge bg-dark ms-2">{{ $employees->total() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="stagiaires-tab" data-bs-toggle="tab" data-bs-target="#stagiaires-tab-pane" type="button" role="tab" aria-controls="stagiaires-tab-pane" aria-selected="false">
                        <i class="fas fa-user-graduate me-2"></i>Internship
                        <span class="badge bg-dark ms-2">{{ $stagiaires->total() }}</span>
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tabs Content -->
        <div class="tab-content" id="personnelTabsContent">
            <!-- Employees Tab -->
            <div class="tab-pane fade show active" id="employees-tab-pane" role="tabpanel" aria-labelledby="employees-tab" tabindex="0">
                <div class="d-flex justify-content-end mb-4 gap-2">
                    <a href="{{ route('personnel.employees.export.simple') }}" class="btn personnel-export-btn">
                        <i class="fas fa-file-excel me-1"></i> Export
                    </a>
                    <button type="button" class="btn personnel-add-btn" data-bs-toggle="modal" data-bs-target="#createEmployeeModal">
                        <i class="fas fa-plus me-1"></i> Add Employee
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle personnel-table" id="employeesTable">
                        <thead class="personnel-table-header">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Employee</th>
                                <th>CIN</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Education</th>
                                <th>Seniority</th>
                                <th>Category</th>
                                <th>Qualifications</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr class="border-top">
                                <td class="ps-4" data-label="#">{{ ($employees->currentPage() - 1) * $employees->perPage() + $loop->iteration }}</td>
                                <td data-label="Employee">
                                    <div class="d-flex align-items-center">
                                        <div class="personnel-avatar me-3">
                                            @if($employee->avatar)
                                                <img src="{{ asset('storage/' . $employee->avatar) }}" alt="{{ $employee->full_name }}" class="personnel-avatar-img" onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'">
                                            @else
                                                <span>{{ strtoupper(substr($employee->full_name, 0, 1)) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <strong>{{ $employee->full_name }}</strong>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="CIN">*****{{ substr($employee->cin, -3) }}</td>
                                <td data-label="Age">{{ $employee->age }}y</td>
                                <td data-label="Gender">
                                    <span class="badge personnel-status-badge personnel-gender-{{ strtolower($employee->genre) }}">
                                        {{ ucfirst($employee->genre) }}
                                    </span>
                                </td>
                                <td data-label="Phone">{{ $employee->phone_number }}</td>
                                <td data-label="Education">
                                    <span class="badge personnel-badge personnel-badge-education">
                                        {{ str_replace('_', ' ', $employee->education_level) }}
                                    </span>
                                </td>
                                <td data-label="Seniority">{{ $employee->seniority }}y</td>
                                <td data-label="Category">
                                    <span class="badge personnel-badge personnel-category-{{ strtolower($employee->category) }}">
                                        {{ ucfirst($employee->category) }}
                                    </span>
                                </td>
                                <td data-label="Qualifications">
                                    @if($employee->qualifications->count() > 0)
                                        <span class="badge personnel-qualification-badge personnel-qualification-has">
                                            <i class="fas fa-certificate me-1"></i>
                                            {{ $employee->qualifications->count() }}
                                        </span>
                                    @else
                                        <span class="badge personnel-qualification-badge personnel-qualification-none">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            None
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center" data-label="Actions">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button type="button" class="btn btn-sm btn-info personnel-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#showEmployeeModal{{ $employee->id }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary personnel-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#editEmployeeModal{{ $employee->id }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger personnel-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#deleteEmployeeModal{{ $employee->id }}"
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
                        Showing {{ $employees->firstItem() }} to {{ $employees->lastItem() }} of {{ $employees->total() }} entries
                    </div>
                    <div>
                        {{ $employees->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

            <!-- Interns Tab -->
            <div class="tab-pane fade" id="stagiaires-tab-pane" role="tabpanel" aria-labelledby="stagiaires-tab" tabindex="0">
                <div class="d-flex justify-content-end mb-4 gap-2">
                    <a href="{{ route('personnel.stagiaires.export') }}" class="btn personnel-export-btn">
                        <i class="fas fa-file-excel me-1"></i> Export
                    </a>
                    <button type="button" class="btn personnel-add-btn" data-bs-toggle="modal" data-bs-target="#createStagiaireModal">
                        <i class="fas fa-plus me-1"></i> Add Intern
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover align-middle personnel-table" id="stagiairesTable">
                        <thead class="personnel-table-header">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Intern</th>
                                <th>CIN</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Education</th>
                                <th>School</th>
                                <th>Field</th>
                                <th>Duration</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stagiaires as $stagiaire)
                            <tr class="border-top">
                                <td class="ps-4" data-label="#">{{ ($stagiaires->currentPage() - 1) * $stagiaires->perPage() + $loop->iteration }}</td>
                                <td data-label="Intern">
                                    <div class="d-flex align-items-center">
                                        <div class="personnel-avatar me-3">
                                            @if($stagiaire->avatar)
                                                <img src="{{ asset('storage/' . $stagiaire->avatar) }}" alt="{{ $stagiaire->full_name }}" class="personnel-avatar-img" onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'">
                                            @else
                                                <span>{{ strtoupper(substr($stagiaire->full_name, 0, 1)) }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <strong>{{ $stagiaire->full_name }}</strong>
                                            <div class="small text-muted">
                                                {{ \Carbon\Carbon::parse($stagiaire->start_date)->format('d M Y') }} - 
                                                {{ \Carbon\Carbon::parse($stagiaire->end_date)->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="CIN">*****{{ substr($stagiaire->cin, -3) }}</td>
                                <td data-label="Age">{{ $stagiaire->age }}y</td>
                                <td data-label="Gender">
                                    <span class="badge personnel-status-badge personnel-gender-{{ strtolower($stagiaire->genre) }}">
                                        {{ ucfirst($stagiaire->genre) }}
                                    </span>
                                </td>
                                <td data-label="Phone">{{ $stagiaire->phone_number }}</td>
                                <td data-label="Education">
                                    <span class="badge personnel-badge personnel-badge-education">
                                        {{ str_replace('_', ' ', $stagiaire->education_level) }}
                                    </span>
                                </td>
                                <td data-label="School">{{ Str::limit($stagiaire->school, 15) }}</td>
                                <td data-label="Field">{{ Str::limit($stagiaire->field_of_study, 15) }}</td>
                                <td data-label="Duration">{{ $stagiaire->duration }} months</td>
                                <td class="text-center" data-label="Actions">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <button type="button" class="btn btn-sm btn-info personnel-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#showStagiaireModal{{ $stagiaire->id }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="View">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-primary personnel-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#editStagiaireModal{{ $stagiaire->id }}"
                                            data-bs-tooltip="tooltip" data-bs-placement="top" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger personnel-action-btn" 
                                            data-bs-toggle="modal" data-bs-target="#deleteStagiaireModal{{ $stagiaire->id }}"
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
                        Showing {{ $stagiaires->firstItem() }} to {{ $stagiaires->lastItem() }} of {{ $stagiaires->total() }} entries
                    </div>
                    <div>
                        {{ $stagiaires->withQueryString()->links('pagination::bootstrap-5') }}
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
@include('admin.personnel.employees_modals.create')
@foreach($employees as $employee)
    @include('admin.personnel.employees_modals.edit', ['employee' => $employee])
    @include('admin.personnel.employees_modals.show', ['employee' => $employee])
    @include('admin.personnel.employees_modals.delete', ['employee' => $employee])
@endforeach

@include('admin.personnel.stagiaires_modals.create')
@foreach($stagiaires as $stagiaire)
    @include('admin.personnel.stagiaires_modals.edit', ['stagiaire' => $stagiaire])
    @include('admin.personnel.stagiaires_modals.show', ['stagiaire' => $stagiaire])
    @include('admin.personnel.stagiaires_modals.delete', ['stagiaire' => $stagiaire])
@endforeach

@foreach($employees as $employee)
    @include('admin.personnel.qualification_modals.create-qualification', ['employee' => $employee])
@endforeach

<style>
    /* Personnel Page Specific Styles */
    .personnel-hero {
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

    .personnel-hero:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 70% 20%, rgba(255,255,255,0.1) 0%, transparent 70%);
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 1200px;
        margin: 0 auto;
    }

    .personnel-card {
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

    .personnel-title {
        position: relative;
        margin-bottom: 0;
        color: #343a40;
        font-weight: 700;
        font-size: 1.8rem;
    }

    .personnel-title:after {
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
    .personnel-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
    }

    .personnel-table-header {
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        color: white;
        position: sticky;
        top: 0;
    }

    .personnel-table-header th {
        white-space: nowrap;
        padding: 0.3rem;
        font-weight: 600;
        border: none;
    }

    .personnel-table tbody tr {
        transition: all 0.2s ease;
    }

    .personnel-table tbody tr:hover {
        background-color: rgba(52, 58, 64, 0.03);
        transform: translateY(-1px);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .personnel-table td {
        padding: 0.3rem;
        vertical-align: middle;
        border-top: 1px solid #f1f1f1;
    }

    /* Avatar Styles */
    .personnel-avatar {
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

    .personnel-avatar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }

    /* Button Styles */
    .personnel-action-btn {
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

    .personnel-action-btn:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    /* Badge Styles */
    .personnel-badge {
        font-size: 0.8rem;
        padding: 0.4em 0.8em;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .personnel-badge-education { 
        background-color: #20c997;
        color: white;
    }

    .personnel-status-badge {
        font-size: 0.8rem;
        padding: 0.4em 0.8em;
        border-radius: 50px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .personnel-gender-male { 
        background-color: #0d6efd;
        color: white;
    }

    .personnel-gender-female { 
        background-color: #dc3545;
        color: white;
    }

    .personnel-category-direct { 
        background-color: #0d6efd;
        color: white;
    }

    .personnel-category-indirect { 
        background-color: #6c757d;
        color: white;
    }

    .personnel-qualification-badge { 
        font-size: 0.8rem;
        padding: 0.4em 0.8em;
        border-radius: 50px;
        font-weight: 600;
    }

    .personnel-qualification-has { 
        background-color: #198754;
        color: white;
    }

    .personnel-qualification-none { 
        background-color: #ffc107;
        color: #212529;
    }

    /* Tab Styles - Centered */
    .personnel-tabs {
        border-bottom: none;
        margin-bottom: 1.5rem;
        background: rgba(52, 58, 64, 0.05);
        border-radius: 12px;
        padding: 0.5rem;
    }

    .personnel-tabs .nav-link {
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

    .personnel-tabs .nav-link.active {
        color: white;
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .personnel-tabs .nav-link:hover:not(.active) {
        background-color: rgba(52, 58, 64, 0.08);
    }

    .personnel-tabs .badge {
        position: absolute;
        top: -8px;
        right: -8px;
        font-size: 0.6rem;
        padding: 0.25em 0.5em;
    }

    /* Action Buttons */
    .personnel-add-btn, .personnel-export-btn {
        border-radius: 50px;
        height: 40px;
        padding: 0 20px;
        transition: all 0.3s ease;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .personnel-add-btn { 
        background-color: #212529;
        color: white;
        border: none;
    }

    .personnel-add-btn:hover { 
        background-color: #343a40;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    .personnel-export-btn { 
        background-color: #27ae60;
        color: white;
        border: none;
    }

    .personnel-export-btn:hover { 
        background-color: #219653;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
    }

    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .personnel-card {
            padding: 2rem;
        }
    }

    @media (max-width: 992px) {
        .personnel-hero {
            height: auto;
            padding: 3rem 1rem;
        }
    }

    @media (max-width: 768px) {
        .personnel-card {
            padding: 1.5rem;
            margin-top: -50px;
        }
        
        .personnel-title {
            font-size: 1.5rem;
        }
        
        /* Adjust tab navigation */
        .personnel-tabs {
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
            justify-content: flex-start;
            padding-bottom: 0;
        }
    
        .personnel-tabs .nav-link {
            padding: 0.6rem 1.2rem;
            font-size: 0.9rem;
        }
        
        /* Responsive table */
        .personnel-table {
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
        .personnel-hero {
            padding: 2.5rem 1rem;
        }
        
        .personnel-title {
            font-size: 1.3rem;
        }
        
        .personnel-title:after {
            bottom: -8px;
            height: 2px;
            width: 40px;
        }
        
        /* Stacked table rows for mobile */
        .personnel-table {
            display: block;
        }
        
        .personnel-table thead {
            display: none;
        }
        
        .personnel-table tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 0.5rem;
        }
        
        .personnel-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem;
            border-bottom: 1px solid #f1f1f1;
        }
        
        .personnel-table td:before {
            content: attr(data-label);
            font-weight: bold;
            margin-right: 1rem;
            color: #343a40;
            font-size: 0.85rem;
        }
        
        .personnel-table td:last-child {
            border-bottom: none;
        }
        
        /* Adjust action buttons */
        .personnel-action-btn {
            width: 32px;
            height: 32px;
            font-size: 0.8rem;
        }

        .personnel-add-btn, .personnel-export-btn {
            height: 36px;
            padding: 0 15px;
            font-size: 0.8rem;
        }
    }

    /* For extremely small screens */
    @media (max-width: 400px) {
        .personnel-tabs .nav-link {
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
        const personnelTabs = document.getElementById('personnelTabs');
        if (personnelTabs) {
            personnelTabs.addEventListener('shown.bs.tab', function(event) {
                const newTab = event.target.id; // e.g., 'employees-tab' or 'stagiaires-tab'
                const currentUrl = new URL(window.location.href);
                
                if (newTab === 'employees-tab') {
                    currentUrl.searchParams.set('tab', 'employees');
                } else if (newTab === 'stagiaires-tab') {
                    currentUrl.searchParams.set('tab', 'stagiaires');
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
            fetchPersonnel(url);
            window.history.pushState({}, '', url);
        });

        function fetchPersonnel(url) {
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const activeTab = document.querySelector('.tab-pane.active');
                    if (activeTab.id === 'employees-tab-pane') {
                        activeTab.querySelector('tbody').innerHTML = data.employees_html;
                        activeTab.querySelector('.pagination').innerHTML = data.employees_pagination;
                    } else {
                        activeTab.querySelector('tbody').innerHTML = data.stagiaires_html;
                        activeTab.querySelector('.pagination').innerHTML = data.stagiaires_pagination;
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
            fetchPersonnel(window.location.href);
        });

        // Setup mobile tables
        function setupMobileTables() {
            if (window.innerWidth < 576) {
                // Employees table
                const employeeHeaders = ['#', 'Employee', 'CIN', 'Age', 'Gender', 'Phone', 'Education', 'Seniority', 'Category', 'Qualifications', 'Actions'];
                document.querySelectorAll('#employees-tab-pane tbody tr').forEach(row => {
                    const cells = row.querySelectorAll('td');
                    cells.forEach((cell, index) => {
                        if (index < employeeHeaders.length) {
                            cell.setAttribute('data-label', employeeHeaders[index]);
                        }
                    });
                });
                
                // Interns table
                const internHeaders = ['#', 'Intern', 'CIN', 'Age', 'Gender', 'Phone', 'Education', 'School', 'Field', 'Duration', 'Actions'];
                document.querySelectorAll('#stagiaires-tab-pane tbody tr').forEach(row => {
                    const cells = row.querySelectorAll('td');
                    cells.forEach((cell, index) => {
                        if (index < internHeaders.length) {
                            cell.setAttribute('data-label', internHeaders[index]);
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