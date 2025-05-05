@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Registration Details</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.registrations') }}">MCU Registrations</a></li>
        <li class="breadcrumb-item active">Registration Details</li>
    </ol>

    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-info-circle me-1"></i>
                    Registration Information
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Registration Number:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->registration_number }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Status:</strong>
                        </div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $registration->status === 'completed' ? 'success' : ($registration->status === 'confirmed' ? 'primary' : ($registration->status === 'cancelled' ? 'danger' : 'warning')) }}">
                                {{ ucfirst($registration->status) }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>MCU Package:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ ucfirst($registration->mcu_package) }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Appointment Date:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->appointment_date->format('d M Y') }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Appointment Time:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->appointment_time->format('H:i') }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Medical Notes:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->medical_notes ?? 'No medical notes provided' }}
                        </div>
                    </div>
                </div>
            </div>

            @if($registration->payment)
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-credit-card me-1"></i>
                    Payment Information
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Payment Number:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->payment->payment_number }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Amount:</strong>
                        </div>
                        <div class="col-md-8">
                            Rp {{ number_format($registration->payment->amount, 0, ',', '.') }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Status:</strong>
                        </div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $registration->payment->status === 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($registration->payment->status) }}
                            </span>
                        </div>
                    </div>
                    @if($registration->payment->paid_at)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Paid At:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->payment->paid_at->format('d M Y H:i') }}
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-user me-1"></i>
                    Patient Information
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->user->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->user->email }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-hospital me-1"></i>
                    Hospital Information
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->hospital->name }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Address:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->hospital->address }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Phone:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $registration->hospital->phone }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-cog me-1"></i>
                    Actions
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#statusModal">
                        <i class="fas fa-edit me-1"></i> Update Status
                    </button>
                    <a href="{{ route('admin.registrations') }}" class="btn btn-secondary w-100">
                        <i class="fas fa-arrow-left me-1"></i> Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.registrations.update-status', $registration->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Update Registration Status</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" required>
                            <option value="pending" {{ $registration->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $registration->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="completed" {{ $registration->status === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $registration->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 