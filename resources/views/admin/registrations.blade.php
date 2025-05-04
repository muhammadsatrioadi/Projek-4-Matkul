@extends('layouts.shared')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="text-primary">
                <i class="fas fa-clipboard-list me-2"></i>
                MCU Registrations
            </h2>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.registrations') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="hospital" class="form-label">Hospital</label>
                    <select name="hospital_id" id="hospital" class="form-select">
                        <option value="">All Hospitals</option>
                        @foreach($hospitals as $hospital)
                            <option value="{{ $hospital->id }}" {{ request('hospital_id') == $hospital->id ? 'selected' : '' }}>
                                {{ $hospital->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="date_from" class="form-label">Date From</label>
                    <input type="date" class="form-control" id="date_from" name="date_from" 
                           value="{{ request('date_from') }}">
                </div>
                <div class="col-md-3">
                    <label for="date_to" class="form-label">Date To</label>
                    <input type="date" class="form-control" id="date_to" name="date_to" 
                           value="{{ request('date_to') }}">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-filter me-2"></i>Apply Filters
                    </button>
                    <a href="{{ route('admin.registrations') }}" class="btn btn-secondary">
                        <i class="fas fa-undo me-2"></i>Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Registrations Table -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Registrations</h6>
            <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>Print
                </button>
                <a href="{{ route('admin.registrations.export') }}" class="btn btn-sm btn-outline-success">
                    <i class="fas fa-file-excel me-2"></i>Export
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="registrationsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Registration #</th>
                            <th>User</th>
                            <th>Hospital</th>
                            <th>Package</th>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $registration)
                        <tr>
                            <td>{{ $registration->registration_number }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ $registration->user->avatar ?? asset('images/default-avatar.png') }}" 
                                         class="rounded-circle me-2" width="30" height="30">
                                    {{ $registration->user->name }}
                                </div>
                            </td>
                            <td>{{ $registration->hospital->name }}</td>
                            <td>{{ $registration->mcu_package }}</td>
                            <td>{{ $registration->appointment_date->format('d M Y') }}</td>
                            <td>{{ $registration->appointment_time->format('H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ $registration->status === 'pending' ? 'warning' : 
                                    ($registration->status === 'completed' ? 'success' : 
                                    ($registration->status === 'approved' ? 'info' : 'danger')) }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </td>
                            <td>{{ $registration->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.registrations.show', $registration->id) }}" 
                                       class="btn btn-sm btn-info" title="View Details">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-success" 
                                            onclick="updateStatus('{{ $registration->id }}', 'approved')"
                                            {{ $registration->status !== 'pending' ? 'disabled' : '' }}
                                            title="Approve">
                                        <i class="fas fa-check"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger"
                                            onclick="updateStatus('{{ $registration->id }}', 'cancelled')"
                                            {{ in_array($registration->status, ['completed', 'cancelled']) ? 'disabled' : '' }}
                                            title="Cancel">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No registrations found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $registrations->links() }}
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.table-hover tbody tr:hover {
    background-color: rgba(0,0,0,.075);
}
@media print {
    .btn-group, .pagination, .filters {
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

document.addEventListener('DOMContentLoaded', function() {
    // Initialize date range validation
    const dateFrom = document.getElementById('date_from');
    const dateTo = document.getElementById('date_to');

    dateFrom.addEventListener('change', function() {
        dateTo.min = this.value;
    });

    dateTo.addEventListener('change', function() {
        dateFrom.max = this.value;
    });
});
</script>
@endpush
@endsection 