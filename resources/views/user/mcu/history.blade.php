@extends('layouts.shared')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #0056b3 0%, #003366 100%);
        padding: 2rem 0;
        color: white;
        margin-bottom: 2rem;
    }

    .mcu-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .mcu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .status-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
    }

    .status-completed {
        background: #d4edda;
        color: #155724;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }

    .status-processing {
        background: #cce5ff;
        color: #004085;
    }

    .timeline-item {
        position: relative;
        padding-left: 3rem;
        padding-bottom: 2rem;
    }

    .timeline-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e9ecef;
    }

    .timeline-item::after {
        content: '';
        position: absolute;
        left: -6px;
        top: 0;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #0056b3;
    }

    .timeline-item:last-child {
        padding-bottom: 0;
    }

    .timeline-item:last-child::before {
        display: none;
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="display-4 mb-3">MCU History</h1>
                <p class="lead mb-0">Track your medical check-up history and results</p>
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="container mb-4">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('user.mcu.history') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label for="hospital" class="form-label">Hospital</label>
                    <select name="hospital" id="hospital" class="form-select">
                        <option value="">All Hospitals</option>
                        @foreach($hospitals ?? [] as $hospital)
                            <option value="{{ $hospital->id }}" {{ request('hospital') == $hospital->id ? 'selected' : '' }}>
                                {{ $hospital->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="date" class="form-label">Date Range</label>
                    <input type="month" class="form-control" id="date" name="date" value="{{ request('date') }}">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-filter me-2"></i>Filter
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- MCU History List -->
<section class="container">
    @if(isset($mcuHistory) && count($mcuHistory) > 0)
        @foreach($mcuHistory as $mcu)
            <div class="mcu-card">
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h4 class="h5 mb-1">{{ $mcu->hospital_name }}</h4>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-calendar me-2"></i>
                                    {{ \Carbon\Carbon::parse($mcu->appointment_date)->format('d M Y, H:i') }}
                                </p>
                            </div>
                            <span class="status-badge status-{{ strtolower($mcu->status) }}">
                                {{ ucfirst($mcu->status) }}
                            </span>
                        </div>
                        <div class="mb-3">
                            <h5 class="h6 mb-2">Package Details</h5>
                            <p class="mb-1">
                                <i class="fas fa-stethoscope me-2"></i>
                                {{ $mcu->package_name }} Package
                            </p>
                            <p class="mb-0">
                                <i class="fas fa-money-bill-wave me-2"></i>
                                Rp {{ number_format($mcu->package_price, 0, ',', '.') }}
                            </p>
                        </div>
                        @if($mcu->status === 'completed')
                            <div class="mb-3">
                                <h5 class="h6 mb-2">Results Summary</h5>
                                <div class="timeline-item">
                                    <p class="mb-1"><strong>Blood Pressure:</strong> {{ $mcu->blood_pressure ?? 'N/A' }}</p>
                                    <p class="mb-1"><strong>Heart Rate:</strong> {{ $mcu->heart_rate ?? 'N/A' }} bpm</p>
                                    <p class="mb-0"><strong>Notes:</strong> {{ $mcu->notes ?? 'No additional notes' }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4 d-flex flex-column justify-content-center align-items-end">
                        @if($mcu->status === 'completed')
                            <a href="{{ route('user.mcu.show', $mcu->id) }}" class="btn btn-primary mb-2">
                                <i class="fas fa-file-medical me-2"></i>View Full Results
                            </a>
                            @if($mcu->report_pdf)
                                <a href="{{ route('user.mcu.download-report', $mcu->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-download me-2"></i>Download Report
                                </a>
                            @endif
                        @elseif($mcu->status === 'pending')
                            <a href="{{ route('user.mcu.show', $mcu->id) }}" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>View Details
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $mcuHistory->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
            <h3 class="h4 text-muted">No MCU History Found</h3>
            <p class="text-muted mb-4">You haven't had any medical check-ups yet.</p>
            <a href="{{ route('hospitals.selection') }}" class="btn btn-primary">
                <i class="fas fa-calendar-plus me-2"></i>Book Your First MCU
            </a>
        </div>
    @endif
</section>
@endsection 