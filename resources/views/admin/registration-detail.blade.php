@extends('layouts.shared')

@section('content')
<div class="container-fluid py-4">
    <!-- Back Button -->
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('admin.registrations') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left me-2"></i>Back to Registrations
            </a>
        </div>
    </div>

    <!-- Registration Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="text-primary mb-1">Registration #{{ $registration->registration_number }}</h4>
                            <p class="text-muted mb-0">Created on {{ $registration->created_at->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            <span class="badge bg-{{ $registration->status === 'pending' ? 'warning' : 
                                ($registration->status === 'completed' ? 'success' : 
                                ($registration->status === 'approved' ? 'info' : 'danger')) }} fs-6">
                                {{ ucfirst($registration->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- User Information -->
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ $registration->user->avatar ?? asset('images/default-avatar.png') }}" 
                             class="rounded-circle me-3" width="64" height="64">
                        <div>
                            <h5 class="mb-1">{{ $registration->user->name }}</h5>
                            <p class="mb-0 text-muted">
                                <i class="fas fa-envelope me-2"></i>{{ $registration->user->email }}
                            </p>
                            <p class="mb-0 text-muted">
                                <i class="fas fa-phone me-2"></i>{{ $registration->user->phone ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Gender</label>
                            <p class="mb-0">{{ ucfirst($registration->user->gender ?? 'N/A') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Date of Birth</label>
                            <p class="mb-0">{{ $registration->user->date_of_birth ? $registration->user->date_of_birth->format('d M Y') : 'N/A' }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted">Address</label>
                            <p class="mb-0">{{ $registration->user->address ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Appointment Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Hospital</label>
                            <p class="mb-0">{{ $registration->hospital->name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">MCU Package</label>
                            <p class="mb-0">{{ $registration->mcu_package }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Appointment Date</label>
                            <p class="mb-0">{{ $registration->appointment_date->format('d M Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Appointment Time</label>
                            <p class="mb-0">{{ $registration->appointment_time->format('H:i') }}</p>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label text-muted">Hospital Address</label>
                            <p class="mb-0">{{ $registration->hospital->address }}</p>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-muted">Medical Notes</label>
                            <p class="mb-0">{{ $registration->medical_notes ?? 'No medical notes available.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Information -->
    @if($registration->payment)
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Payment Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted">Payment Number</label>
                            <p class="mb-0">{{ $registration->payment->payment_number }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted">Amount</label>
                            <p class="mb-0">Rp {{ number_format($registration->payment->amount, 0, ',', '.') }}</p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted">Status</label>
                            <p class="mb-0">
                                <span class="badge bg-{{ $registration->payment->status === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($registration->payment->status) }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label text-muted">Payment Method</label>
                            <p class="mb-0">{{ ucfirst($registration->payment->payment_method) }}</p>
                        </div>
                        @if($registration->payment->payment_details)
                        <div class="col-12">
                            <label class="form-label text-muted">Payment Details</label>
                            <p class="mb-0">{{ $registration->payment->payment_details }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Action Buttons -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            @if($registration->status === 'pending')
                            <button type="button" class="btn btn-success me-2" 
                                    onclick="updateStatus('{{ $registration->id }}', 'approved')">
                                <i class="fas fa-check me-2"></i>Approve Registration
                            </button>
                            @endif
                            
                            @if(!in_array($registration->status, ['completed', 'cancelled']))
                            <button type="button" class="btn btn-danger me-2"
                                    onclick="updateStatus('{{ $registration->id }}', 'cancelled')">
                                <i class="fas fa-times me-2"></i>Cancel Registration
                            </button>
                            @endif

                            @if($registration->status === 'approved')
                            <button type="button" class="btn btn-info me-2"
                                    onclick="updateStatus('{{ $registration->id }}', 'completed')">
                                <i class="fas fa-check-double me-2"></i>Mark as Completed
                            </button>
                            @endif
                        </div>
                        
                        <div>
                            <button type="button" class="btn btn-outline-primary me-2" onclick="window.print()">
                                <i class="fas fa-print me-2"></i>Print Details
                            </button>
                            <a href="{{ route('admin.registrations.export.single', $registration->id) }}" 
                               class="btn btn-outline-success">
                                <i class="fas fa-file-excel me-2"></i>Export Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
@media print {
    .btn, .back-button {
        display: none !important;
    }
}
</style>
@endpush

@push('scripts')
<script>
function updateStatus(registrationId, status) {
    if (confirm('Are you sure you want to ' + status + ' this registration?')) {
        fetch(`/admin/registrations/${registrationId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Error updating status: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the status');
        });
    }
}
</script>
@endpush
@endsection 