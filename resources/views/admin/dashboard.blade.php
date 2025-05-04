@extends('layouts.shared')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12 mb-4">
            <h2 class="text-primary">
                <i class="fas fa-tachometer-alt me-2"></i>
                Admin Dashboard
            </h2>
            <p class="text-muted">Welcome back, {{ auth()->user()->name }}!</p>
        </div>
    </div>

    <div class="row">
        <!-- Total Users Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Registrations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total MCU Registrations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalRegistrations }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Registrations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Registrations</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingRegistrations }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Registrations Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Completed MCUs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedRegistrations }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Registrations Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent MCU Registrations</h6>
                    <a href="{{ route('admin.registrations') }}" class="btn btn-sm btn-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Registration #</th>
                                    <th>User</th>
                                    <th>Hospital</th>
                                    <th>Package</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentRegistrations as $registration)
                                <tr>
                                    <td>{{ $registration->registration_number }}</td>
                                    <td>{{ $registration->user->name }}</td>
                                    <td>{{ $registration->hospital->name }}</td>
                                    <td>{{ $registration->mcu_package }}</td>
                                    <td>{{ $registration->appointment_date->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge bg-{{ $registration->status === 'pending' ? 'warning' : ($registration->status === 'completed' ? 'success' : 'info') }}">
                                            {{ ucfirst($registration->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.registrations.show', $registration->id) }}" 
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No recent registrations found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.border-left-primary {
    border-left: .25rem solid #4e73df!important;
}
.border-left-success {
    border-left: .25rem solid #1cc88a!important;
}
.border-left-warning {
    border-left: .25rem solid #f6c23e!important;
}
.border-left-info {
    border-left: .25rem solid #36b9cc!important;
}
</style>
@endpush
@endsection 