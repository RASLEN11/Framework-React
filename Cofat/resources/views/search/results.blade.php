@extends('admin.layouts.app')

@section('title', 'Search Results')

@section('content')
<section class="search-hero text-white text-center py-5">
    <div class="container position-relative">
        <h1 class="display-4 fw-bold mb-4"><i class="fas fa-search me-2"></i>Search Results</h1>
        <p class="lead mb-0">
            Showing results for "{{ $query }}"
        </p>
    </div>
</section>

<div class="container">
    <div class="search-results-card">
        @if($employeeResults->count() > 0)
        <div class="search-section mb-5">
            <h3 class="search-section-title"><i class="fas fa-users me-2"></i>Employees</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>CIN</th>
                            <th>Phone</th>
                            <th>Education</th>
                            <th>Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employeeResults as $result)
                        <tr>
                            <td>{{ $result->full_name }}</td>
                            <td>*****{{ substr($result->cin, -3) }}</td>
                            <td>{{ $result->phone_number }}</td>
                            <td>{{ str_replace('_', ' ', $result->education_level) }}</td>
                            <td><span class="badge bg-{{ $result->category === 'direct' ? 'primary' : 'secondary' }}">
                                {{ ucfirst($result->category) }}
                            </span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        
        @if($jobResults->count() > 0)
        <div class="search-section mb-5">
            <h3 class="search-section-title"><i class="fas fa-briefcase me-2"></i>Job Applications</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Position</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobResults as $result)
                        <tr>
                            <td>{{ $result->first_name }} {{ $result->last_name }}</td>
                            <td>{{ $result->email }}</td>
                            <td>{{ ucwords(str_replace('_', ' ', $result->position)) }}</td>
                            <td><span class="badge bg-{{ $result->status === 'pending' ? 'warning' : ($result->status === 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($result->status) }}
                            </span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        
        @if($internshipResults->count() > 0)
        <div class="search-section mb-5">
            <h3 class="search-section-title"><i class="fas fa-user-graduate me-2"></i>Internship Applications</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($internshipResults as $result)
                        <tr>
                            <td>{{ $result->first_name }} {{ $result->last_name }}</td>
                            <td>{{ $result->email }}</td>
                            <td>{{ ucfirst($result->position_type) }}</td>
                            <td><span class="badge bg-{{ $result->status === 'pending' ? 'warning' : ($result->status === 'approved' ? 'success' : 'danger') }}">
                                {{ ucfirst($result->status) }}
                            </span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        
        @if($messageResults->count() > 0)
        <div class="search-section mb-5">
            <h3 class="search-section-title"><i class="fas fa-envelope me-2"></i>User Messages</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Message Preview</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messageResults as $result)
                        <tr>
                            <td>{{ $result->user->name }}</td>
                            <td>{{ $result->user->email }}</td>
                            <td>{{ Str::limit($result->message, 50) }}</td>
                            <td>
                                @if($result->is_replied)
                                    <span class="badge bg-success">Replied</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        
        @if($contactResults->count() > 0)
        <div class="search-section">
            <h3 class="search-section-title"><i class="fas fa-id-card me-2"></i>Contact Messages</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message Preview</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contactResults as $result)
                        <tr>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->email }}</td>
                            <td>{{ Str::limit($result->message, 50) }}</td>
                            <td>{{ $result->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        
        @if($employeeResults->count() === 0 && $jobResults->count() === 0 && 
           $internshipResults->count() === 0 && $messageResults->count() === 0 && 
           $contactResults->count() === 0)
        <div class="text-center py-5">
            <i class="fas fa-search fa-3x text-muted mb-3"></i>
            <h4>No results found for "{{ $query }}"</h4>
            <p class="text-muted">Try different keywords or check your spelling</p>
        </div>
        @endif
    </div>
</div>

<style>
    .search-hero {
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

    .search-results-card {
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

    .search-section-title {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #f1f1f1;
    }

    @media (max-width: 768px) {
        .search-results-card {
            padding: 2rem;
            border-radius: 15px;
        }
        
        .search-hero {
            height: 25vh;
            min-height: 200px;
            border-radius: 15px;
        }
    }

    @media (max-width: 576px) {
        .search-results-card {
            padding: 1.5rem;
        }
    }
</style>

@endsection