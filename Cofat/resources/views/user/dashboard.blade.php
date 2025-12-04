<link rel="icon" href="{{ asset('images/stats.svg') }}" type="image/svg+xml">
@extends('user.layouts.app')

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
        }
    </style>

    <!-- Hero Section -->
    <section class="hero text-white text-center py-5">
        <div class="container position-relative">
            <h1 class="display-4 fw-bold mb-4"><i class="fas fa-tachometer-alt me-2"></i>Tableau de Bord</h1>
            <p class="lead mb-0">
                Aperçu complet de la gestion des employés et des candidatures COFAT
            </p>
        </div>
    </section>



@endsection