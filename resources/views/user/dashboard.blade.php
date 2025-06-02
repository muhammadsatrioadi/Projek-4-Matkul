@extends('layouts.shared')

@push('styles')
<style>
    .hero-section {
        background: linear-gradient(135deg, #0056b3 0%, #003366 100%);
        padding: 4rem 0;
        color: white;
        margin-bottom: 2rem;
    }

    .stats-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .stats-card:hover {
        transform: translateY(-5px);
    }

    .quick-access-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        height: 100%;
    }

    .quick-access-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .quick-access-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #0056b3;
    }

    .activity-item {
        padding: 1rem;
        border-left: 4px solid #0056b3;
        background: white;
        margin-bottom: 1rem;
        border-radius: 0 10px 10px 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .appointment-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-confirmed {
        background: #d4edda;
        color: #155724;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="display-4 mb-4">Welcome back, {{ Auth::user()->name }}!</h1>
                <p class="lead mb-4">Manage your medical check-ups and appointments all in one place.</p>
                <a href="{{ route('hospitals.selection') }}" class="btn btn-light btn-lg">Book New Appointment</a>
            </div>
            <div class="col-md-6 text-center d-none d-md-block">
                <img src="{{ asset('assets/images/dashboard-illustration.svg') }}" alt="--" class="img-fluid" style="max-height: 300px;">
            </div>
        </div>
    </div>
</section>



<!-- Quick Access Section -->
<section class="container mb-5">
    <h2 class="h3 mb-4">Quick Access</h2>
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="quick-access-card">
                <i class="fas fa-calendar-plus quick-access-icon"></i>
                <h3 class="h5">Book MCU</h3>
                <p class="text-muted">Schedule your medical check-up</p>
                <a href="{{ route('hospitals.selection') }}" class="btn btn-outline-primary">Book Now</a>
            </div>
                    </div>
        <div class="col-md-3 mb-4">
            <div class="quick-access-card">
                <i class="fas fa-history quick-access-icon"></i>
                <h3 class="h5">MCU History</h3>
                <p class="text-muted">View your medical history</p>
                <a href="{{ route('user.mcu.history') }}" class="btn btn-outline-primary">View History</a>
                                </div>
                            </div>
        <div class="col-md-3 mb-4">
            <div class="quick-access-card">
                <i class="fas fa-user-edit quick-access-icon"></i>
                <h3 class="h5">Profile</h3>
                <p class="text-muted">Update your information</p>
                <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-primary">Edit Profile</a>
                                </div>
                            </div>
        <div class="col-md-3 mb-4">
            <div class="quick-access-card">
                <i class="fas fa-hospital quick-access-icon"></i>
                <h3 class="h5">Hospitals</h3>
                <p class="text-muted">Browse partner hospitals</p>
                <a href="{{ route('hospitals.index') }}" class="btn btn-outline-primary">View All</a>
            </div>
        </div>
    </div>
</section>

<!-- Recent Activities and Upcoming Appointments -->
<section class="container mb-5">
    <div class="row">
        <!-- Recent Activities -->
        <div class="col-md-6 mb-4">
            <h2 class="h3 mb-4">Recent Activities</h2>
            @if(isset($recentActivities) && count($recentActivities) > 0)
                @foreach($recentActivities as $activity)
                    <div class="activity-item">
                        <h4 class="h6 mb-1">{{ $activity->title }}</h4>
                        <p class="text-muted mb-0">{{ $activity->description }}</p>
                        <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                    </div>
                @endforeach
            @else
                <div class="text-center py-4">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No recent activities</p>
                </div>
            @endif
                </div>

        <!-- Upcoming Appointments -->
        <div class="col-md-6 mb-4">
            <h2 class="h3 mb-4">Upcoming Appointments</h2>
            @if(isset($upcomingAppointmentsList) && count($upcomingAppointmentsList) > 0)
                @foreach($upcomingAppointmentsList as $appointment)
                    <div class="appointment-card">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="h6 mb-0">{{ $appointment->hospital_name }}</h4>
                            <span class="status-badge {{ $appointment->status == 'confirmed' ? 'status-confirmed' : 'status-pending' }}">
                                {{ ucfirst($appointment->status) }}
                            </span>
                    </div>
                        <p class="text-muted mb-2">
                            <i class="far fa-calendar-alt me-2"></i>
                            {{ $appointment->appointment_date ? \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y, H:i') : 'Date not set' }}
                        </p>
                        <p class="text-muted mb-2">
                            <i class="fas fa-stethoscope me-2"></i>
                            {{ $appointment->package_name }}
                        </p>
                        <a href="{{ route('user.mcu.show', $appointment->id) }}" class="btn btn-sm btn-outline-primary">View Details</a>
                    </div>
                @endforeach
            @else
                <div class="text-center py-4">
                    <i class="far fa-calendar-check fa-3x text-muted mb-3"></i>
                    <p class="text-muted">No upcoming appointments</p>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- MCU Packages Section -->
<section class="container mb-5">
    <h2 class="h3 mb-4">Available MCU Packages</h2>
    <div class="row">
        <!-- Basic Package -->
        <div class="col-md-4 mb-4">
            <div class="quick-access-card">
                <div class="feature-icon mb-3">
                    <i class="fas fa-heartbeat" style="font-size: 48px; color: #dc3545;"></i>
</div>
                <h4>Basic MCU</h4>
                <p class="text-muted">Essential health assessments including blood pressure and basic blood tests.</p>
                <ul class="list-unstyled text-muted">
                    <li><i class="fas fa-check text-success me-2"></i>General physical examination</li>
                    <li><i class="fas fa-check text-success me-2"></i>Basic blood tests</li>
                    <li><i class="fas fa-check text-success me-2"></i>Blood pressure check</li>
                </ul>
                <div class="mt-4">
                    <h5 class="mb-3">Rp 500.000</h5>
                    <a href="{{ route('hospitals.selection') }}" class="btn btn-danger">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Standard Package -->
        <div class="col-md-4 mb-4">
            <div class="quick-access-card">
                <div class="feature-icon mb-3">
                    <i class="fas fa-stethoscope" style="font-size: 48px; color: #28a745;"></i>
                    </div>
                <h4>Standard MCU</h4>
                <p class="text-muted">Comprehensive tests including cholesterol levels and EKG.</p>
                <ul class="list-unstyled text-muted">
                    <li><i class="fas fa-check text-success me-2"></i>All Basic package tests</li>
                    <li><i class="fas fa-check text-success me-2"></i>EKG examination</li>
                    <li><i class="fas fa-check text-success me-2"></i>Cholesterol panel</li>
                        </ul>
                <div class="mt-4">
                    <h5 class="mb-3">Rp 1.000.000</h5>
                    <a href="{{ route('hospitals.selection') }}" class="btn btn-success">Book Now</a>
                </div>
            </div>
        </div>

        <!-- Premium Package -->
        <div class="col-md-4 mb-4">
            <div class="quick-access-card">
                <div class="feature-icon mb-3">
                    <i class="fas fa-user-md" style="font-size: 48px; color: #007bff;"></i>
                </div>
                <h4>Premium MCU</h4>
                <p class="text-muted">Advanced imaging tests and specialist consultations.</p>
                <ul class="list-unstyled text-muted">
                    <li><i class="fas fa-check text-success me-2"></i>All Standard package tests</li>
                    <li><i class="fas fa-check text-success me-2"></i>MRI/CT scan</li>
                    <li><i class="fas fa-check text-success me-2"></i>Specialist consultation</li>
                </ul>
                <div class="mt-4">
                    <h5 class="mb-3">Rp 2.500.000</h5>
                    <a href="{{ route('hospitals.selection') }}" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection