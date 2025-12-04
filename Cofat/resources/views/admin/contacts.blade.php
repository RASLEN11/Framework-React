@extends('admin.layouts.app')
@section('title', 'Contact Messages - COFAT Management System')

@section('content')
<!-- Hero Section -->
<section class="contacts-hero text-white text-center py-5">
    <div class="container position-relative">
        <div class="hero-content">
            <h1 class="display-4 fw-bold mb-3"><i class="fas fa-envelope me-2"></i>Contact Messages</h1>
            <p class="lead mb-4">Manage all customer inquiries and messages</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <div class="contacts-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="contacts-title">Messages Overview</h2>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle contacts-table" id="contactsTable">
                <thead class="contacts-table-header">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Message Preview</th>
                        <th>Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contacts as $contact)
                    <tr class="border-top">
                        <td class="ps-4" data-label="#">{{ ($contacts->currentPage() - 1) * $contacts->perPage() + $loop->iteration }}</td>
                        <td data-label="Contact">
                            <div class="d-flex align-items-center">
                                <div class="contacts-avatar me-3">
                                    <span>{{ strtoupper(substr($contact->name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <strong>{{ $contact->name }}</strong>
                                    <div class="small text-muted">{{ $contact->subject ?? 'No subject' }}</div>
                                </div>
                            </div>
                        </td>
                        <td data-label="Email">{{ $contact->email }}</td>
                        <td data-label="Message Preview">{{ Str::limit($contact->message, 30) }}</td>
                        <td data-label="Date">
                            {{ $contact->created_at->format('M d, Y') }}
                        </td>
                        <td class="text-center" data-label="Actions">
                            <div class="d-flex gap-2 justify-content-center">
                                <button type="button" class="btn btn-sm btn-info contacts-action-btn" 
                                    data-bs-toggle="modal" data-bs-target="#showContactModal{{ $contact->id }}"
                                    data-bs-tooltip="tooltip" data-bs-placement="top" title="View">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger contacts-action-btn" 
                                    data-bs-toggle="modal" data-bs-target="#deleteContactModal{{ $contact->id }}"
                                    data-bs-tooltip="tooltip" data-bs-placement="top" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <div class="empty-state">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h4>No messages found</h4>
                                @if(request('search'))
                                <a href="{{ route('contacts.index') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-arrow-left me-1"></i> Clear search
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($contacts->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of {{ $contacts->total() }} entries
            </div>
            <div>
                {{ $contacts->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
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
@foreach($contacts as $contact)
<!-- Show Contact Modal -->
<div class="modal fade contact-show-modal" id="showContactModal{{ $contact->id }}" tabindex="-1" aria-labelledby="showContactModalLabel{{ $contact->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content bg-white text-black">
            <div class="modal-body p-3 bg-white me-2">
                <div class="d-flex flex-column flex-sm-row align-items-start align-sm-center w-100">
                    <div class="contact-show-avatar me-sm-3 mb-2 mb-sm-0">
                        <span class="contact-show-avatar-initial">{{ strtoupper(substr($contact->name, 0, 1)) }}</span>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="contact-show-title mb-0 text-black" id="showContactModalLabel{{ $contact->id }}">
                            <i class="fas fa-envelope me-2 text-black"></i>
                            Message Details
                        </h5>
                        <small class="contact-show-subtitle text-muted">ID: {{ $contact->id }}</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Contact Information Section -->
                <div class="row g-2 mb-2">
                    <div class="col-12 col-sm-6">
                        <div class="contact-show-info-item">
                            <span class="contact-show-info-badge bg-light text-black">
                                <i class="fas fa-user fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 contact-show-info-label text-muted">Name</p>
                                <p class="mb-0 contact-show-info-value text-black">{{ $contact->name }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="contact-show-info-item">
                            <span class="contact-show-info-badge bg-light text-black">
                                <i class="fas fa-envelope fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 contact-show-info-label text-muted">Email</p>
                                <p class="mb-0 contact-show-info-value text-black">{{ $contact->email }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="contact-show-info-item">
                            <span class="contact-show-info-badge bg-light text-black">
                                <i class="fas fa-phone fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 contact-show-info-label text-muted">Phone</p>
                                <p class="mb-0 contact-show-info-value text-black">{{ $contact->phone ?? 'Not provided' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="contact-show-info-item">
                            <span class="contact-show-info-badge bg-light text-black">
                                <i class="fas fa-calendar fa-fw text-black"></i>
                            </span>
                            <div>
                                <p class="mb-0 contact-show-info-label text-muted">Date Received</p>
                                <p class="mb-0 contact-show-info-value text-black">{{ $contact->created_at->format('M d, Y \a\t H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Subject and Message Section -->
                <div class="row g-2 mb-2">
                    <!-- Subject Section -->
                    <div class="col-12">
                        <div class="contact-show-section border-top border-secondary pt-3">
                            <h6 class="contact-show-section-title text-black"><i class="fas fa-tag me-2 text-black"></i>Subject</h6>
                            <div class="contact-show-section-content">
                                <div class="contact-show-detail-item">
                                    <p class="contact-show-detail-value text-black">{{ $contact->subject ?? 'No subject' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Message Section -->
                    <div class="col-12">
                        <div class="contact-show-section border-top border-secondary pt-3">
                            <h6 class="contact-show-section-title text-black"><i class="fas fa-align-left me-2 text-black"></i>Message</h6>
                            <div class="contact-show-section-content">
                                <div class="contact-show-message text-black">
                                    {{ $contact->message }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-3 gap-2">
                    <a href="mailto:{{ $contact->email }}" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-reply me-2"></i>Reply
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Contact Modal -->
<div class="modal fade contact-delete-modal" id="deleteContactModal{{ $contact->id }}" tabindex="-1" aria-labelledby="deleteContactModalLabel{{ $contact->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-white">
            <div class="modal-body bg-white">
                <div class="d-flex align-items-center w-100">
                    <div class="flex-grow-1">
                        <h5 class="contact-delete-title text-black" id="deleteContactModalLabel{{ $contact->id }}">
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
                
                <div class="contact-preview d-flex align-items-center mb-4 p-3 bg-light rounded">
                    <div class="contact-avatar-initial me-3 bg-dark text-white">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="contact-name mb-1 text-black">{{ $contact->name }}</h6>
                        <small class="text-muted">Email: {{ $contact->email }}</small>
                    </div>
                </div>
                
                <p class="text-danger mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Are you sure you want to permanently delete this contact message?
                </p>
                
                <div class="d-flex justify-content-end gap-2">
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
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

<style>
    /* Contacts Page Specific Styles */
    .contacts-hero {
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

    .contacts-card {
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

    .contacts-title {
        position: relative;
        margin-bottom: 0;
        color: #343a40;
        font-weight: 700;
        font-size: 1.8rem;
    }

    /* Table Styles */
    .contacts-table-header {
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        color: white;
    }

    /* Avatar Styles */
    .contacts-avatar {
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
    }

    /* Button Styles */
    .contacts-action-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    /* Contact Show Modal Styles */
    .contact-show-modal .modal-dialog {
        max-width: 600px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .contact-show-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
    }

    /* Avatar Styles */
    .contact-show-avatar {
        width: 60px;
        height: 60px;
        position: relative;
        margin-right: 1rem;
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .contact-show-avatar-initial {
        font-size: 1.5rem;
        font-weight: bold;
        color: white;
    }

    /* Title Styles */
    .contact-show-title {
        font-weight: 600;
        color: #212529;
        font-size: 1.25rem;
        margin-bottom: 0.25rem;
    }

    .contact-show-subtitle {
        font-size: 0.85rem;
        color: #6c757d;
    }

    /* Info Items */
    .contact-show-info-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }

    .contact-show-info-badge {
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

    .contact-show-info-label {
        font-size: 0.75rem;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }

    .contact-show-info-value {
        font-size: 0.9rem;
        font-weight: 500;
        color: #212529;
    }

    /* Sections */
    .contact-show-section {
        background-color: #f8f9fa;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .contact-show-section-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #212529;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }

    /* Detail Items */
    .contact-show-detail-item {
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
    }

    /* Message Content */
    .contact-show-message {
        font-size: 0.9rem;
        color: #495057;
        line-height: 1.6;
        white-space: pre-line;
    }

    /* Contact Delete Modal Styles */
    .contact-delete-modal .modal-dialog {
        max-width: 500px;
        margin: 1.75rem auto;
        display: flex;
        align-items: center;
        min-height: calc(100% - 3.5rem);
    }

    .contact-delete-modal .modal-content {
        border-radius: 15px;
        overflow: hidden;
        border: none;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
    }

    .contact-delete-title {
        font-weight: 600;
        color: #dc3545;
        font-size: 1.15rem;
    }

    /* Avatar Styles */
    .contact-avatar-initial {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.25rem;
    }

    /* Delete Button */
    .delete-submit-btn {
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        transition: all 0.3s;
    }

    .delete-submit-btn:hover {
        background: linear-gradient(135deg, #c82333 0%, #dc3545 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
    }

    /* Responsive Adjustments */
    @media (max-width: 991.98px) {
        .contact-show-avatar,
        .contact-avatar-initial {
            width: 50px;
            height: 50px;
        }
    }

    @media (max-width: 767.98px) {
        .contact-show-modal .modal-dialog,
        .contact-delete-modal .modal-dialog {
            max-width: 100%;
            margin: 0.5rem auto;
        }
    }

    @media (max-width: 575.98px) {
        .contact-show-avatar,
        .contact-avatar-initial {
            width: 45px;
            height: 45px;
            margin-right: 0;
            margin-bottom: 0.75rem;
        }
        
        .contact-show-info-item {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .contact-show-info-badge {
            margin-bottom: 0.5rem;
            margin-right: 0;
        }
        
        .contact-delete-title {
            font-size: 1.05rem;
        }
        
        .delete-submit-btn {
            padding: 0.4rem 1rem;
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

        // Initialize tooltips
        const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-tooltip="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>
@endsection