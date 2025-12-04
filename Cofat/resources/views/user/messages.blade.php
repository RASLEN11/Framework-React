@extends('user.layouts.app')

@section('title', 'Messages')

@section('content')
<!-- Hero Section -->
<section class="messages-hero text-white text-center py-5">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold mb-2"><i class="fas fa-comments me-2"></i>Your Messages</h1>
        <p class="lead mb-0">
            Communicate with our support team
        </p>
    </div>
</section>

<!-- Main Content -->
<div class="container">
    <div class="messages-card">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="autoDismissAlert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <h2 class="messages-title">Message Center</h2>

        <div class="message-form-section mb-5">
            <div class="d-flex align-items-center mb-4">
                <h3 class="messages-subtitle mb-0">
                    <i class="fas fa-paper-plane me-2"></i>Send New Message
                </h3>
            </div>
            
            <form method="POST" action="{{ route('user.messages.store') }}">
                @csrf
                <div class="form-group mb-4">
                    <label for="message" class="form-label">Your Message</label>
                    <textarea class="form-control @error('message') is-invalid @enderror" 
                              id="message" name="message" rows="5" required></textarea>
                    @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary messages-send-btn">
                    <i class="fas fa-paper-plane me-2"></i> Send Message
                </button>
            </form>
        </div>

        <div class="messages-list-section">
            <div class="d-flex align-items-center mb-4">
                <h3 class="messages-subtitle mb-0">
                    <i class="fas fa-history me-2"></i>Message History
                </h3>
            </div>
            
            @forelse($messages as $message)
            <div class="message-item mb-4 p-4 border rounded">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <div class="messages-avatar me-3">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h5 class="message-sender mb-0">You</h5>
                            <small class="message-date text-muted">
                                <i class="fas fa-clock me-1"></i>
                                {{ $message->created_at->format('d M Y \a\t H:i') }}
                            </small>
                        </div>
                    </div>
                    <span class="badge messages-badge {{ $message->is_replied ? 'messages-status-replied' : 'messages-status-pending' }}">
                        <i class="fas {{ $message->is_replied ? 'fa-check-circle' : 'fa-clock' }} me-1"></i>
                        {{ $message->is_replied ? 'Replied' : 'Pending' }}
                    </span>
                </div>
                
                <div class="message-content">
                    <div class="message-text p-3">
                        {{ $message->message }}
                    </div>
                    
                    @if($message->is_replied)
                        <div class="messages-show-reply mt-3 p-3 bg-light rounded">
                            <div class="d-flex align-items-center mb-2">
                                <div class="messages-show-admin-avatar me-2">
                                    <i class="fas fa-user-shield"></i>
                                </div>
                                <h6 class="mb-0">Admin Reply</h6>
                                <small class="text-muted ms-auto">
                                    <i class="fas fa-clock me-1"></i>
                                    {{ $message->updated_at->format('d M Y \a\t H:i') }}
                                </small>
                            </div>
                            <p class="mb-0">{{ $message->reply }}</p>
                        </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="empty-state text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h4>No messages yet</h4>
                <p class="text-muted">Send your first message to get started</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

<style>
    /* Messages Page Specific Styles */
    .messages-hero {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        height: 40vh;
        min-height: 300px;
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

    .messages-card {
        max-width: 1400px;
        margin: -50px auto 5rem;
        border-radius: 20px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        border: none;
        padding: 3rem;
        background-color: white;
        position: relative;
        z-index: 1;
    }

    .messages-title {
        position: relative;
        margin-bottom: 2.5rem;
        color: #343a40;
        font-weight: 700;
        text-align: center;
        font-size: 2.2rem;
    }

    .messages-title:after {
        content: "";
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, #4e73df 0%, #224abe 100%);
        border-radius: 2px;
    }

    .messages-subtitle {
        position: relative;
        color: #343a40;
        font-weight: 600;
        font-size: 1.5rem;
        padding-bottom: 0.5rem;
    }

    /* Avatar Styles */
    .messages-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.1rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .messages-show-admin-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, #343a40 0%, #212529 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    /* Badges */
    .messages-badge {
        font-size: 0.85rem;
        padding: 0.5em 0.8em;
        border-radius: 50px;
        font-weight: 600;
    }

    .messages-status-replied {
        background-color: #198754;
        color: white;
    }

    .messages-status-pending {
        background-color: #ffc107;
        color: #212529;
    }

    /* Message Item Styles */
    .message-item {
        background-color: #f8f9fa;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .message-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .message-sender {
        font-weight: 600;
        color: #212529;
    }

    .message-date {
        font-size: 0.85rem;
    }

    .message-text {
        font-size: 0.95rem;
        line-height: 1.6;
        white-space: pre-line;
    }

    .messages-show-reply {
        border-left: 3px solid #4e73df;
    }

    /* Form Styles */
    .messages-send-btn {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 50px;
        font-weight: 500;
        box-shadow: 0 4px 10px rgba(78, 115, 223, 0.3);
        transition: all 0.3s;
    }

    .messages-send-btn:hover {
        background: linear-gradient(135deg, #224abe 0%, #4e73df 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(78, 115, 223, 0.4);
    }

    /* Empty State */
    .empty-state {
        padding: 2rem;
        background-color: #f8f9fa;
        border-radius: 12px;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .messages-title {
            font-size: 1.8rem;
        }
        
        .messages-card {
            padding: 2rem;
            border-radius: 15px;
        }
        
        .messages-hero {
            height: 40vh;
            min-height: 350px;
            border-radius: 15px;
        }
    }

    @media (max-width: 576px) {
        .messages-title {
            font-size: 1.5rem;
        }
        
        .messages-hero {
            height: 35vh;
            min-height: 300px;
        }
        
        .messages-card {
            padding: 1.5rem;
        }
        
        .message-item {
            padding: 1.5rem;
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
            }, 2000);
        }
    });
</script>

@endsection