@extends('user.layouts.app')
@section('title', 'User Settings - COFAT Management System')

@section('content')
<!-- Hero Section -->
<section class="settings-hero text-white text-center py-5">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold mb-2"><i class="fas fa-cog me-2"></i>User Settings</h1>
        <p class="lead mb-0">
            Manage your account settings
        </p>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <div class="settings-card">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="text-center mb-4">
            <div class="position-relative d-inline-block">
                @if(auth()->user()->avatar)
                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" 
                         class="rounded-circle settings-avatar-preview" 
                         width="120" 
                         height="120"
                         alt="Profile Image"
                         onerror="this.onerror=null;this.src='{{ asset('images/default-avatar.png') }}'">
                @else
                    <div class="settings-avatar-placeholder rounded-circle d-flex align-items-center justify-content-center" 
                         style="width: 120px; height: 120px;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
                <button class="btn btn-sm settings-avatar-change-btn position-absolute bottom-0 end-0 rounded-circle" 
                        data-bs-toggle="modal" 
                        data-bs-target="#avatarModal"
                        title="Change Avatar">
                    <i class="fas fa-camera"></i>
                </button>
            </div>
        </div>

        <form method="POST" action="{{ route('settings.update') }}" class="settings-form">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label settings-label">Full Name</label>
                <input type="text" 
                       class="form-control settings-input @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', auth()->user()->name) }}"
                       required>
                @error('name')
                    <div class="invalid-feedback settings-error">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label settings-label">Email Address</label>
                <input type="email" 
                       class="form-control settings-input" 
                       id="email" 
                       value="{{ auth()->user()->email }}" 
                       disabled>
                <small class="settings-hint">Contact admin to change your email</small>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn settings-save-btn">
                    <i class="fas fa-save me-1"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Avatar Change Modal -->
<div class="modal fade" id="avatarModal" tabindex="-1" aria-labelledby="avatarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content settings-modal">
            <div class="modal-header settings-modal-header">
                <h5 class="modal-title" id="avatarModalLabel">Change Profile Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('settings.avatar') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="avatar" class="form-label settings-label">Select new image</label>
                        <input class="form-control settings-input @error('avatar') is-invalid @enderror" 
                               type="file" 
                               id="avatar" 
                               name="avatar"
                               accept="image/*">
                        @error('avatar')
                            <div class="invalid-feedback settings-error">{{ $message }}</div>
                        @enderror
                        <div class="settings-hint">Max file size: 2MB. Supported formats: JPG, PNG, GIF.</div>
                    </div>
                    
                    <div class="text-center">
                        <button type="button" class="btn settings-remove-btn" id="removeAvatar" 
                                data-url="{{ route('settings.avatar.remove') }}"
                                style="{{ !auth()->user()->avatar ? 'display: none;' : '' }}">
                            <i class="fas fa-trash me-1"></i> Remove Current Image
                        </button>
                    </div>
                </div>
                <div class="modal-footer settings-modal-footer">
                    <button type="button" class="btn settings-cancel-btn" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn settings-upload-btn">Upload Image</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Settings Page Specific Styles */
    .settings-hero {
        background: linear-gradient(135deg, #212529 0%, #343a40 100%);
        height: 30vh;
        min-height: 250px;
        border-radius: 30px;
        margin: 20px auto;
        max-width: 98%;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .settings-card {
        max-width: 800px;
        margin: -50px auto 5rem;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 3rem;
        background-color: white;
        position: relative;
        z-index: 1;
    }

    .settings-avatar-preview {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border: 3px solid #dee2e6;
        transition: border-color 0.3s ease;
    }

    .settings-avatar-preview:hover {
        border-color: #0d6efd;
    }

    .settings-avatar-placeholder {
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        color: white;
        font-weight: bold;
        font-size: 3rem;
        border: 3px solid #dee2e6;
    }

    .settings-avatar-change-btn {
        width: 32px;
        height: 32px;
        background-color: #212529;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .settings-avatar-change-btn:hover {
        background-color: #343a40;
    }

    .settings-label {
        font-weight: 600;
        color: #343a40;
    }

    .settings-input {
        border-radius: 8px;
        padding: 10px 15px;
        border: 1px solid #dee2e6;
        transition: all 0.3s ease;
    }

    .settings-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .settings-error {
        font-weight: 500;
    }

    .settings-hint {
        color: #6c757d;
        font-size: 0.85rem;
    }

    .settings-save-btn {
        background-color: #212529;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .settings-save-btn:hover {
        background-color: #343a40;
        transform: translateY(-2px);
    }

    .settings-modal {
        border-radius: 15px;
        overflow: hidden;
    }

    .settings-modal-header {
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        color: white;
        border-bottom: none;
    }

    .settings-modal-footer {
        border-top: none;
        background-color: #f8f9fa;
    }

    .settings-cancel-btn {
        background-color: #6c757d;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 600;
    }

    .settings-cancel-btn:hover {
        background-color: #5c636a;
        color: white;
    }

    .settings-upload-btn {
        background-color: #0d6efd;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 600;
    }

    .settings-upload-btn:hover {
        background-color: #0b5ed7;
        color: white;
    }

    .settings-remove-btn {
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 600;
    }

    .settings-remove-btn:hover {
        background-color: #bb2d3b;
        color: white;
    }

    /* New Styles for Application Sections */
    .settings-section {
        border-top: 1px solid #eee;
        padding-top: 2rem;
    }

    .settings-section-title {
        color: #343a40;
        font-weight: 700;
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.5rem;
    }

    .settings-section-title:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #343a40 0%, #f8f9fa 100%);
    }

    .settings-apply-btn {
        background-color: #20c997;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .settings-apply-btn:hover {
        background-color: #198754;
        color: white;
        transform: translateY(-2px);
    }

    .settings-alert {
        border-radius: 8px;
        padding: 15px;
        font-weight: 500;
    }

    .form-switch .form-check-input {
        width: 3em;
        height: 1.5em;
        margin-right: 0.5em;
    }

    @media (max-width: 768px) {
        .settings-hero {
            height: 25vh;
            min-height: 200px;
            border-radius: 15px;
        }
        
        .settings-card {
            padding: 2rem;
            border-radius: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .settings-hero {
            height: 20vh;
            min-height: 180px;
        }
        
        .settings-card {
            padding: 1.5rem;
        }
        
        .settings-avatar-preview,
        .settings-avatar-placeholder {
            width: 100px;
            height: 100px;
            font-size: 2.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Remove avatar functionality
        const removeAvatarBtn = document.getElementById('removeAvatar');
        if (removeAvatarBtn) {
            removeAvatarBtn.addEventListener('click', function() {
                if (confirm('Are you sure you want to remove your profile image?')) {
                    fetch(this.dataset.url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            window.location.reload();
                        }
                    });
                }
            });
        }
        
        // Preview selected image
        const avatarInput = document.getElementById('avatar');
        if (avatarInput) {
            avatarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const preview = document.querySelector('.settings-avatar-preview');
                        if (preview) {
                            preview.src = event.target.result;
                        }
                    }
                    reader.readAsDataURL(file);
                }
            });
        }

        // Auto-dismiss alert after 5 seconds
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        });

        // Add loading state to buttons
        const buttons = document.querySelectorAll('button[type="submit"]');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
                this.disabled = true;
                if (this.form) {
                    this.form.submit();
                }
            });
        });
    });
</script>
@endsection