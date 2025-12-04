<link rel="icon" href="{{ asset('images/stats.svg') }}" type="image/svg+xml">
@extends('admin.layouts.app')

@section('title', 'Tableau de Bord - COFAT')

@section('content')

    <style>
        /* Hero Section - Matching contact page style */
        .hero {
            background: linear-gradient(135deg, #212529 0%, #343a40 100%);
            height: 60vh;
            min-height: 400px;
            border-radius: 40px;
            padding: 10px 20px;
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

        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset("images/contact-pattern.png") }}') center/cover;
            opacity: 0.05;
        }

        /* Section Title */
        .section-title {
            position: relative;
            margin-bottom: 2.5rem;
            color: #343a40;
            font-weight: 700;
            text-align: center;
            font-size: 2.2rem;
        }
        
        .section-title:after {
            content: "";
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #6f42c1 0%, #fd7e14 100%);
            border-radius: 2px;
        }

        /* Stats Cards */
        .stat-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            height: 100%;
            transition: all 0.3s ease;
            border: none;
        }
        
        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }
        
        .stat-icon {
            font-size: 2.8rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #343a40 0%, #495057 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-number {
            font-size: 2.8rem;
            font-weight: 700;
            color: #343a40;
            margin: 1rem 0;
            background: linear-gradient(135deg, #343a40 0%, #495057 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stat-title {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #495057;
        }

        /* Employee Stats Card */
        .employee-stats-card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        /* Circular Chart */
        .circular-chart {
            width: 180px;
            height: 180px;
            position: relative;
            margin: 0 auto 2rem;
        }
        
        .circle {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: conic-gradient(#6f42c1 calc(var(--percent) * 1%), #fd7e14 0%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            font-size: 2.5rem;
            font-weight: bold;
            color: #6f42c1;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .circle:before {
            content: '';
            position: absolute;
            width: 80%;
            height: 80%;
            background: white;
            border-radius: 50%;
        }
        
        .circle span {
            position: relative;
            z-index: 1;
        }
        
        /* Badges */
        .badge-office {
            background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 50px;
        }
        
        .badge-factory {
            background: linear-gradient(135deg, #fd7e14 0%, #f76707 100%);
            color: white;
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 50px;
        }

        /* Additional styles for progress bars */
        .bg-job {
            background-color: #6f42c1;
        }
        
        .bg-internship {
            background-color: #fd7e14;
        }
        
        .badge-job {
            background-color: #6f42c1;
            color: white;
        }
        
        .badge-internship {
            background-color: #fd7e14;
            color: white;
        }

        /* Calendar styles */
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            margin-top: 20px;
        }
        
        .calendar-header {
            font-weight: bold;
            text-align: center;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .calendar-day {
            border: 1px solid #e9ecef;
            border-radius: 5px;
            padding: 10px;
            min-height: 80px;
            position: relative;
        }
        
        .calendar-day.empty {
            background: #f8f9fa;
        }
        
        .day-number {
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .qualification-badge {
            font-size: 0.7rem;
            padding: 2px 5px;
            border-radius: 3px;
            background: #6f42c1;
            color: white;
            display: block;
            margin-bottom: 2px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .qualification-badge.expired {
            background: #dc3545;
        }
        
        .qualification-badge.upcoming {
            background: #28a745;
        }
        
        .calendar-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            align-items: center;
        }
        
        .calendar-title {
            font-weight: bold;
            font-size: 1.2rem;
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .hero {
                height: 50vh;
            }
        }
        
        @media (max-width: 768px) {
            .hero {
                height: 50vh;
                border-radius: 30px;
            }
            
            .contact-card {
                padding: 2rem;
                border-radius: 30px;
                margin-top: -30px;
            }
            
            .section-title {
                font-size: 1.8rem;
            }
            
            .stat-number {
                font-size: 2.2rem;
            }
            
            .circular-chart {
                width: 140px;
                height: 140px;
            }
            
            .calendar-day {
                min-height: 60px;
                padding: 5px;
            }
        }
        
        @media (max-width: 576px) {
            .hero {
                height: 40vh;
                padding: 20px;
            }
            
            .contact-card {
                padding: 1.5rem;
                border-radius: 20px;
            }
            
            .section-title {
                font-size: 1.5rem;
            }
            
            .stat-card {
                padding: 1.5rem;
            }
            
            .stat-icon {
                font-size: 2.2rem;
            }
            
            .calendar {
                grid-template-columns: repeat(1, 1fr);
            }
        }
    </style>
<br>
    <!-- Hero Section -->
    <section class="hero text-white text-center py-5">
        <div class="container position-relative">
            <div class="flex items-left space-x-4">
        </div>
            <h1 class="display-4 fw-bold mb-4"><i class="fas fa-tachometer-alt me-2"></i>Tableau de Bord</h1>
            <p class="lead mb-0">
                Aperçu complet de la gestion des employés et des candidatures COFAT - {{ now()->format('Y') }}
            </p>
            
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <div class="contact-card">
            <h2 class="section-title">Statistiques Clés</h2>
            
            <!-- Employee Statistics -->
            <div class="employee-stats-card">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="mb-4"><i class="fas fa-users me-2"></i>Statistiques des Employés</h3>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="stat-card text-center">
                                    <i class="fas fa-user-tie stat-icon"></i>
                                    <div class="stat-number">{{ $totalEmployee }}</div>
                                    <div class="stat-title">Total Employés</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="stat-card text-center">
                                    <i class="fas fa-user-tie stat-icon"></i>
                                    <div class="stat-number">{{ $totalEmployeeDirect }}</div>
                                    <div class="stat-title">Employés Directs</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="stat-card text-center">
                                    <i class="fas fa-user-gear stat-icon"></i>
                                    <div class="stat-number">{{ $totalEmployeeIndirect }}</div>
                                    <div class="stat-title">Employés Indirects</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card text-center h-100 d-flex flex-column justify-content-center">
                            <h3 class="mb-4">Répartition Direct/Indirect</h3>
                            <div class="circular-chart">
                                <div class="circle" style="--percent: {{ $percentageDirect }};">
                                    <span>{{ $percentageDirect }}%</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center gap-4 mt-3">
                                <span class="badge badge-office p-2"><i class="fas fa-user-tie me-1"></i> Direct {{ $percentageDirect }}%</span>
                                <span class="badge badge-factory p-2"><i class="fas fa-user-gear me-1"></i> Indirect {{ $percentageIndirect }}%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <button class="btn btn-send" data-bs-toggle="modal" data-bs-target="#employeesModal">
                        <i class="fas fa-eye me-2"></i>Voir Tous les Employés
                    </button>
                </div>
            </div>
            
            <!-- Applications Statistics -->
            <div class="row mt-4">
                <!-- Job Applications -->
                <div class="col-md-4 mb-4">
                    <div class="stat-card text-center">
                        <i class="fas fa-briefcase stat-icon"></i>
                        <div class="stat-number">{{ $totalJobApplications }}</div>
                        <div class="stat-title">Candidatures Emploi</div>
                        <div class="d-flex justify-content-center gap-2 mt-2">
                            <span class="badge badge-office">{{ $totalOfficeApplications }} Bureau</span>
                            <span class="badge badge-factory">{{ $totalFactoryApplications }} Usine</span>
                        </div>
                        <div class="mt-2 text-muted small">
                            {{ $jobAppsThisYear }} cette année
                        </div>
                        <button class="btn btn-send mt-3" data-bs-toggle="modal" data-bs-target="#jobApplicationsModal">
                            <i class="fas fa-eye me-2"></i>Voir Tous
                        </button>
                    </div>
                </div>
                
                <!-- Internship Applications -->
                <div class="col-md-4 mb-4">
                    <div class="stat-card text-center">
                        <i class="fas fa-graduation-cap stat-icon"></i>
                        <div class="stat-number">{{ $totalInternshipApplications }}</div>
                        <div class="stat-title">Candidatures Stage</div>
                        <div class="d-flex justify-content-center gap-2 mt-2">
                            <span class="badge badge-office">{{ $totalOfficeInternships }} Bureau</span>
                            <span class="badge badge-factory">{{ $totalFactoryInternships }} Usine</span>
                        </div>
                        <div class="mt-2 text-muted small">
                            {{ $internshipAppsThisYear }} cette année
                        </div>
                        <button class="btn btn-send mt-3" data-bs-toggle="modal" data-bs-target="#internshipApplicationsModal">
                            <i class="fas fa-eye me-2"></i>Voir Tous
                        </button>
                    </div>
                </div>
                
                <!-- Contacts & Users -->
                <div class="col-md-4 mb-4">
                    <div class="stat-card text-center">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <i class="fas fa-address-book stat-icon"></i>
                                <div class="stat-number">{{ $totalContacts }}</div>
                                <div class="stat-title">Contacts Clients</div>
                                <button class="btn btn-send btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#contactsModal">
                                    <i class="fas fa-eye me-1"></i>Voir
                                </button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Qualifications Statistics -->
            <div class="row mt-4">
                <div class="col-md-12 mb-4">
                    <div class="stat-card">
                        <h3 class="mb-4"><i class="fas fa-certificate me-2"></i>Statistiques des Qualifications</h3>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="stat-card text-center">
                                    <i class="fas fa-certificate stat-icon"></i>
                                    <div class="stat-number">{{ $totalQualifications }}</div>
                                    <div class="stat-title">Total Qualifications</div>
                                </div>
                            </div>
                            
                            @foreach($qualificationStats as $type => $count)
                            <div class="col-md-3 mb-3">
                                <div class="stat-card text-center">
                                    <i class="fas fa-award stat-icon"></i>
                                    <div class="stat-number">{{ $count }}</div>
                                    <div class="stat-title">{{ Str::limit($type, 20) }}</div>
                                    <button class="btn btn-sm btn-send mt-2" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#qualificationModal"
                                            data-type="{{ $type }}">
                                        <i class="fas fa-eye me-1"></i>Voir Employés
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Application Ratios -->
            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <div class="stat-card">
                        <h3 class="mb-4"><i class="fas fa-chart-pie me-2"></i>Répartition Candidatures</h3>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="circular-chart-sm">
                                <div class="circle" style="--percent: {{ $applicationRatio['jobPercentage'] }};">
                                    <span>{{ $applicationRatio['jobPercentage'] }}%</span>
                                </div>
                            </div>
                            <div class="ratio-details">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge badge-job me-2">Emploi</span>
                                    <div class="progress flex-grow-1" style="height: 20px;">
                                        <div class="progress-bar bg-job" role="progressbar" 
                                             style="width: {{ $applicationRatio['jobPercentage'] }}%" 
                                             aria-valuenow="{{ $applicationRatio['jobPercentage'] }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-internship me-2">Stage</span>
                                    <div class="progress flex-grow-1" style="height: 20px;">
                                        <div class="progress-bar bg-internship" role="progressbar" 
                                             style="width: {{ $applicationRatio['internshipPercentage'] }}%" 
                                             aria-valuenow="{{ $applicationRatio['internshipPercentage'] }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-4">
                    <div class="stat-card">
                        <h3 class="mb-4"><i class="fas fa-chart-pie me-2"></i>Répartition Postes</h3>
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="circular-chart-sm">
                                <div class="circle" style="--percent: {{ $positionTypeRatio['officePercentage'] }};">
                                    <span>{{ $positionTypeRatio['officePercentage'] }}%</span>
                                </div>
                            </div>
                            <div class="ratio-details">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="badge badge-office me-2">Bureau</span>
                                    <div class="progress flex-grow-1" style="height: 20px;">
                                        <div class="progress-bar bg-office" role="progressbar" 
                                             style="width: {{ $positionTypeRatio['officePercentage'] }}%" 
                                             aria-valuenow="{{ $positionTypeRatio['officePercentage'] }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span class="badge badge-factory me-2">Usine</span>
                                    <div class="progress flex-grow-1" style="height: 20px;">
                                        <div class="progress-bar bg-factory" role="progressbar" 
                                             style="width: {{ $positionTypeRatio['factoryPercentage'] }}%" 
                                             aria-valuenow="{{ $positionTypeRatio['factoryPercentage'] }}" 
                                             aria-valuemin="0" 
                                             aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Qualification Calendar -->
            <div class="row mt-4">
                <div class="col-md-12 mb-4">
                    <div class="stat-card">
                        <h3 class="mb-4"><i class="fas fa-calendar-alt me-2"></i>Calendrier des Qualifications</h3>
                        
                        <div class="calendar-nav">
                            <button class="btn btn-sm btn-outline-secondary prev-month"><i class="fas fa-chevron-left"></i></button>
                            <div class="calendar-title">{{ now()->format('F Y') }} - {{ now()->addMonths(2)->format('F Y') }}</div>
                            <button class="btn btn-sm btn-outline-secondary next-month"><i class="fas fa-chevron-right"></i></button>
                        </div>
                        
                        <div class="calendar" id="qualificationCalendar">
                            <!-- Calendar headers -->
                            <div class="calendar-header">Dim</div>
                            <div class="calendar-header">Lun</div>
                            <div class="calendar-header">Mar</div>
                            <div class="calendar-header">Mer</div>
                            <div class="calendar-header">Jeu</div>
                            <div class="calendar-header">Ven</div>
                            <div class="calendar-header">Sam</div>
                            
                            <!-- Calendar days will be populated by JavaScript -->
                        </div>
                        
                        <div class="mt-3">
                            <span class="badge bg-danger me-2">Expiré</span>
                            <span class="badge bg-success me-2">À venir</span>
                            <span class="badge bg-primary">Aujourd'hui</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Latest Records Section -->
        <div class="row mt-4">
            <!-- Employees & Qualifications -->
            <div class="col-md-6 mb-4">
                <div class="stat-card">
                    <h3 class="mb-4"><i class="fas fa-user-tie me-2"></i>Derniers Employés</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $employee->full_name }}</td>
                                    <td><span class="badge {{ $employee->category == 'direct' ? 'badge-office' : 'badge-factory' }}">{{ $employee->category == 'direct' ? 'Direct' : 'Indirect' }}</span></td>
                                    <td>{{ $employee->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="stat-card">
                    <h3 class="mb-4"><i class="fas fa-certificate me-2"></i>Dernières Qualifications</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Employé</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestQualifications as $qualification)
                                <tr>
                                    <td>{{ $qualification->employee->full_name }}</td>
                                    <td>{{ $qualification->type }}</td>
                                    <td>{{ $qualification->date->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Applications & Messages -->
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="stat-card">
                    <h3 class="mb-4"><i class="fas fa-briefcase me-2"></i>Dernières Candidatures Emploi</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Poste</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($officeApplications as $application)
                                <tr>
                                    <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                                    <td><span class="badge badge-office">Bureau</span></td>
                                    <td>{{ $application->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                                @foreach($factoryApplications as $application)
                                <tr>
                                    <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                                    <td><span class="badge badge-factory">Usine</span></td>
                                    <td>{{ $application->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="stat-card">
                    <h3 class="mb-4"><i class="fas fa-envelope me-2"></i>Derniers Messages</h3>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Utilisateur</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestMessages as $message)
                                <tr>
                                    <td>{{ $message->user->name }}</td>
                                    <td>{{ Str::limit($message->content, 30) }}</td>
                                    <td>{{ $message->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <span class="badge bg-danger">{{ $unreadMessages }} non lus</span>
                        <a href="{{ route('admin.messages') }}" class="btn btn-send btn-sm float-end">
                            <i class="fas fa-inbox me-1"></i>Voir tous
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Qualification Modal -->
    <div class="modal fade" id="qualificationModal" tabindex="-1" aria-labelledby="qualificationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qualificationModalLabel">Employés avec la qualification: <span id="modalQualificationType"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Date Qualification</th>
                                    <th>Note</th>
                                    <th>Prochaine Qualification</th>
                                </tr>
                            </thead>
                            <tbody id="qualificationEmployeesList">
                                <!-- Will be populated by AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Day Qualifications Modal -->
    <div class="modal fade" id="dayQualificationsModal" tabindex="-1" aria-labelledby="dayQualificationsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dayQualificationsModalLabel">Qualifications pour <span id="modalDayDate"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="dayQualificationsList">
                    <!-- Will be populated by AJAX -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function() {
            // Gestion de la modal des qualifications
            $('#qualificationModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var qualificationType = button.data('type');
                var modal = $(this);
                
                modal.find('#modalQualificationType').text(qualificationType);
                
                // Afficher le loader
                $('#qualificationEmployeesList').html('<tr><td colspan="4" class="text-center"><i class="fas fa-spinner fa-spin"></i> Chargement...</td></tr>');
                
                // Charger les employés via AJAX
                $.get('/admin/qualifications/employees', { type: qualificationType }, function(data) {
                    var html = '';
                    if (data.employees.length > 0) {
                        data.employees.forEach(function(employee) {
                            html += '<tr>';
                            html += '<td>' + employee.full_name + '</td>';
                            html += '<td>' + employee.qualification_date + '</td>';
                            html += '<td>' + employee.note + '/20</td>';
                            html += '<td>' + (employee.next_qualification_date || 'N/A') + '</td>';
                            html += '</tr>';
                        });
                    } else {
                        html = '<tr><td colspan="4" class="text-center">Aucun employé trouvé avec cette qualification</td></tr>';
                    }
                    
                    $('#qualificationEmployeesList').html(html);
                }).fail(function() {
                    $('#qualificationEmployeesList').html('<tr><td colspan="4" class="text-center text-danger">Erreur lors du chargement des données</td></tr>');
                });
            });
            
            // Initialize qualification calendar
            function renderCalendar() {
                const now = new Date();
                const currentMonth = now.getMonth();
                const currentYear = now.getFullYear();
                
                const nextMonth = currentMonth + 1;
                const nextMonthYear = nextMonth > 11 ? currentYear + 1 : currentYear;
                
                const nextNextMonth = currentMonth + 2;
                const nextNextMonthYear = nextNextMonth > 11 ? currentYear + 1 : currentYear;
                
                // Get days for current month
                const daysInMonth1 = new Date(currentYear, currentMonth + 1, 0).getDate();
                const firstDayOfMonth1 = new Date(currentYear, currentMonth, 1).getDay();
                
                // Get days for next month
                const daysInMonth2 = new Date(nextMonthYear, nextMonth + 1, 0).getDate();
                const firstDayOfMonth2 = new Date(nextMonthYear, nextMonth, 1).getDay();
                
                // Get days for next next month (limited to 2 weeks)
                const daysInMonth3 = 14; // Show only 2 weeks of the next month
                const firstDayOfMonth3 = new Date(nextNextMonthYear, nextNextMonth, 1).getDay();
                
                let calendarHtml = '';
                
                // Add empty cells for first month
                for (let i = 0; i < firstDayOfMonth1; i++) {
                    calendarHtml += '<div class="calendar-day empty"></div>';
                }
                
                // Add days for first month
                for (let i = 1; i <= daysInMonth1; i++) {
                    const dateStr = `${currentYear}-${(currentMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
                    calendarHtml += generateDayHtml(dateStr, i);
                }
                
                // Add empty cells if needed for first month
                const totalCells1 = firstDayOfMonth1 + daysInMonth1;
                if (totalCells1 % 7 !== 0) {
                    const remainingCells = 7 - (totalCells1 % 7);
                    for (let i = 0; i < remainingCells; i++) {
                        calendarHtml += '<div class="calendar-day empty"></div>';
                    }
                }
                
                // Add empty cells for second month
                for (let i = 0; i < firstDayOfMonth2; i++) {
                    calendarHtml += '<div class="calendar-day empty"></div>';
                }
                
                // Add days for second month
                for (let i = 1; i <= daysInMonth2; i++) {
                    const dateStr = `${nextMonthYear}-${(nextMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
                    calendarHtml += generateDayHtml(dateStr, i);
                }
                
                // Add empty cells if needed for second month
                const totalCells2 = firstDayOfMonth2 + daysInMonth2;
                if (totalCells2 % 7 !== 0) {
                    const remainingCells = 7 - (totalCells2 % 7);
                    for (let i = 0; i < remainingCells; i++) {
                        calendarHtml += '<div class="calendar-day empty"></div>';
                    }
                }
                
                // Add empty cells for third month (partial)
                for (let i = 0; i < firstDayOfMonth3; i++) {
                    calendarHtml += '<div class="calendar-day empty"></div>';
                }
                
                // Add days for third month (partial)
                for (let i = 1; i <= daysInMonth3; i++) {
                    const dateStr = `${nextNextMonthYear}-${(nextNextMonth + 1).toString().padStart(2, '0')}-${i.toString().padStart(2, '0')}`;
                    calendarHtml += generateDayHtml(dateStr, i);
                }
                
                $('#qualificationCalendar').append(calendarHtml);
                
                // Add click handlers for days with qualifications
                $('.calendar-day.has-qualifications').on('click', function() {
                    const date = $(this).data('date');
                    const formattedDate = new Date(date).toLocaleDateString('fr-FR');
                    
                    $('#modalDayDate').text(formattedDate);
                    $('#dayQualificationsList').html('<div class="text-center"><i class="fas fa-spinner fa-spin"></i> Chargement...</div>');
                    
                    $.get('/admin/qualifications/day', { date: date }, function(data) {
                        let html = '';
                        if (data.qualifications.length > 0) {
                            html += '<ul class="list-group">';
                            data.qualifications.forEach(function(qualification) {
                                const badgeClass = qualification.status === 'expired' ? 'bg-danger' : 'bg-success';
                                html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                                    ${qualification.employee.full_name}
                                    <span class="badge ${badgeClass}">${qualification.type}</span>
                                </li>`;
                            });
                            html += '</ul>';
                        } else {
                            html = '<p class="text-center">Aucune qualification prévue pour cette date</p>';
                        }
                        
                        $('#dayQualificationsList').html(html);
                        $('#dayQualificationsModal').modal('show');
                    }).fail(function() {
                        $('#dayQualificationsList').html('<p class="text-center text-danger">Erreur lors du chargement des données</p>');
                    });
                });
            }
            
            function generateDayHtml(dateStr, dayNumber) {
                const today = new Date().toISOString().split('T')[0];
                const date = new Date(dateStr);
                const formattedDate = date.toISOString().split('T')[0];
                
                // Check if this date has qualifications
                const hasQualifications = window.qualificationCalendar[formattedDate] !== undefined;
                
                let dayClass = 'calendar-day';
                if (formattedDate === today) {
                    dayClass += ' bg-primary text-white';
                }
                
                if (hasQualifications) {
                    dayClass += ' has-qualifications';
                }
                
                let qualificationsHtml = '';
                if (hasQualifications) {
                    const qualifications = window.qualificationCalendar[formattedDate];
                    qualifications.forEach(qualification => {
                        const badgeClass = qualification.status === 'expired' ? 'expired' : 'upcoming';
                        qualificationsHtml += `<span class="qualification-badge ${badgeClass}" title="${qualification.employee.full_name} - ${qualification.type}">
                            ${qualification.employee.full_name.split(' ')[0]}
                        </span>`;
                    });
                }
                
                return `<div class="${dayClass}" data-date="${formattedDate}">
                    <div class="day-number">${dayNumber}</div>
                    ${qualificationsHtml}
                </div>`;
            }
            
            // Initialize qualification calendar data
            window.qualificationCalendar = {};
            @foreach($qualificationCalendar as $date => $qualifications)
                window.qualificationCalendar['{{ $date }}'] = [
                    @foreach($qualifications as $qualification)
                    {
                        'employee': {
                            'full_name': '{{ $qualification->employee->full_name }}'
                        },
                        'type': '{{ $qualification->type }}',
                        'status': '{{ $qualification->next_qualification_date < now() ? 'expired' : 'upcoming' }}'
                    },
                    @endforeach
                ];
            @endforeach
            
            // Render the calendar
            renderCalendar();
        });
    </script>
    @endpush
@endsection