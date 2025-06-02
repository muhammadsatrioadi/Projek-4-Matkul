@extends('layouts.shared')

@section('content')
<div class="container-fluid p-0">
    <!-- Hero Section with Large Image -->
    <div class="hero-section position-relative mb-5">
        <img src="{{ asset('assets/images/hero-medical.jpg') }}" class="w-100" style="height: 400px; object-fit: cover;" alt="Medical Hero Image">
        <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.5);">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bold mb-3">HealthNav</h1>
                <p class="lead mb-0">Your Trusted Healthcare Navigation Partner</p>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Core Values Section -->
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="fw-bold mb-4">:: C O R E &nbsp; V A L U E S ::</h2>
                <div class="d-flex justify-content-center flex-wrap gap-3">
                    <div class="core-value-item">
                        <i class="fas fa-heart fa-2x text-primary mb-2"></i>
                        <h5>Care</h5>
                    </div>
                    <div class="core-value-item">
                        <i class="fas fa-user-md fa-2x text-primary mb-2"></i>
                        <h5>Professional</h5>
                    </div>
                    <div class="core-value-item">
                        <i class="fas fa-star fa-2x text-primary mb-2"></i>
                        <h5>Excellence</h5>
                    </div>
                    <div class="core-value-item">
                        <i class="fas fa-handshake fa-2x text-primary mb-2"></i>
                        <h5>Trust</h5>
                    </div>
                    <div class="core-value-item">
                        <i class="fas fa-users fa-2x text-primary mb-2"></i>
                        <h5>Collaborative</h5>
                    </div>
                </div>
            </div>
        </div>

        <!-- Partner Hospitals Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="text-center fw-bold mb-4">Our Partner Hospitals</h2>
                <p class="text-center text-muted mb-5">Discover our network of trusted healthcare providers</p>
            </div>
        </div>

        <!-- Hospital Cards -->
        <div class="row">
            @forelse($hospitals as $hospital)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    @if($hospital->image_url)
                        <img src="{{ asset('storage/' . $hospital->image_url) }}" class="card-img-top" alt="{{ $hospital->name }}" style="height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('assets/images/default-hospital.jpg') }}" class="card-img-top" alt="Default Hospital Image" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title fw-bold">{{ $hospital->name }}</h5>
                        <p class="card-text text-muted mb-2">
                            <i class="fas fa-map-marker-alt"></i> {{ $hospital->location }}
                        </p>
                        <div class="mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= round($hospital->rating))
                                    <i class="fas fa-star text-warning"></i>
                                @else
                                    <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            <span class="text-muted ms-2">({{ $hospital->reviews_count }} reviews)</span>
                        </div>
                        <p class="card-text">{{ Str::limit($hospital->description, 100) }}</p>
                        <div class="mt-3">
                            @if($hospital->specialties)
                                @foreach(is_array($hospital->specialties) ? $hospital->specialties : json_decode($hospital->specialties) as $specialty)
                                    <span class="badge bg-primary me-1 mb-1">{{ $specialty }}</span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pb-3">
                        <a href="{{ route('hospitals.show', $hospital) }}" class="btn btn-primary w-100">
                            <i class="fas fa-info-circle me-1"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No hospitals found.
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row mb-5">
            <div class="col-12 d-flex justify-content-center">
                {{ $hospitals->links() }}
            </div>
        </div>

        <!-- Call to Action Sections -->
        <div class="row mb-5">
            <div class="col-md-6 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center py-4">
                        <h3 class="card-title">Register for Medical Check-Up</h3>
                        <p class="card-text">Start your journey to better health today</p>
                        <a href="{{ route('user.mcu.register') }}" class="btn btn-light">Register Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="card bg-secondary text-white">
                    <div class="card-body text-center py-4">
                        <h3 class="card-title">Contact Support</h3>
                        <p class="card-text">Need help? Our team is here for you</p>
                        <a href="{{ route('contact') }}" class="btn btn-light">Contact Us</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .hero-section {
        margin-top: -24px;
    }
    .core-value-item {
        text-align: center;
        padding: 20px;
        min-width: 150px;
    }
    .card {
        transition: transform 0.2s;
        border-radius: 10px;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .badge {
        font-size: 0.8rem;
        padding: 0.5em 1em;
        border-radius: 20px;
    }
    .btn {
        border-radius: 5px;
        padding: 0.5rem 1.5rem;
    }
    .btn-primary {
        background-color: #0d6efd;
        border: none;
    }
    .btn-primary:hover {
        background-color: #0b5ed7;
    }
</style>
@endpush 