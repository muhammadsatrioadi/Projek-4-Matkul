@extends('layouts.shared')

@section('content')
<div class="container py-5">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">MCU Registration Details</h5>
                    <span class="badge bg-light text-primary">{{ ucfirst($registration->status) }}</span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="text-muted">Registration Information</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%">Registration Number</td>
                                    <td><strong>{{ $registration->registration_number }}</strong></td>
                                </tr>
                                <tr>
                                    <td>MCU Package</td>
                                    <td><strong>{{ ucfirst($registration->mcu_package) }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Total Cost</td>
                                    <td><strong>Rp {{ number_format($registration->total_cost, 0, ',', '.') }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Payment Status</td>
                                    <td>
                                        @if($registration->payment_status == 'paid')
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">Appointment Details</h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%">Hospital</td>
                                    <td><strong>{{ $registration->hospital->name }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td><strong>{{ $registration->appointment_date->format('l, d F Y') }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Time</td>
                                    <td><strong>{{ \Carbon\Carbon::parse($registration->appointment_time)->format('H:i') }}</strong></td>
                                </tr>
                                <tr>
                                    <td>Medical Notes</td>
                                    <td>{{ $registration->medical_notes ?? 'No notes provided' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($registration->medicalRecord)
                    <div class="row">
                        <div class="col-12">
                            <h6 class="text-muted mb-3">Medical Record</h6>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="20%">Record Number</td>
                                        <td><strong>{{ $registration->medicalRecord->record_number }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Examination Date</td>
                                        <td>{{ $registration->medicalRecord->examination_date->format('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Diagnosis</td>
                                        <td>{{ $registration->medicalRecord->diagnosis ?? 'Not available yet' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Treatment</td>
                                        <td>{{ $registration->medicalRecord->treatment ?? 'Not available yet' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Doctor Notes</td>
                                        <td>{{ $registration->medicalRecord->doctor_notes ?? 'No notes available' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <span class="badge bg-{{ $registration->medicalRecord->status == 'completed' ? 'success' : 'info' }}">
                                                {{ ucfirst($registration->medicalRecord->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="{{ route('user.mcu.history') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>Back to History
                            </a>
                            @if($registration->status == 'pending' && $registration->payment_status != 'paid')
                            <a href="{{ route('payment.show', $registration->id) }}" class="btn btn-primary">
                                <i class="fas fa-credit-card me-2"></i>Proceed to Payment
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 