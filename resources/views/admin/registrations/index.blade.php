@extends('layouts.shared')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">MCU Registrations</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">MCU Registrations</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            All Registrations
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="registrationsTable">
                    <thead>
                        <tr>
                            <th>Registration No.</th>
                            <th>Patient Name</th>
                            <th>Hospital</th>
                            <th>Package</th>
                            <th>Appointment Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $registration)
                        <tr>
                            <td>{{ $registration->registration_number }}</td>
                            <td>{{ $registration->user->name }}</td>
                            <td>{{ $registration->hospital->name }}</td>
                            <td>{{ ucfirst($registration->mcu_package) }}</td>
                            <td>{{ $registration->appointment_date->format('d M Y') }} {{ $registration->appointment_time->format('H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ $registration->status === 'completed' ? 'success' : ($registration->status === 'confirmed' ? 'primary' : ($registration->status === 'cancelled' ? 'danger' : 'warning')) }}">
                                    {{ ucfirst($registration->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.registrations.show', $registration->id) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#statusModal{{ $registration->id }}">
                                    <i class="fas fa-edit"></i> Update Status
                                </button>
                            </td>
                        </tr>

                        <!-- Status Update Modal -->
                        <div class="modal fade" id="statusModal{{ $registration->id }}" tabindex="-1" aria-labelledby="statusModalLabel{{ $registration->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('admin.registrations.update-status', $registration->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="statusModalLabel{{ $registration->id }}">Update Registration Status</h5>
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
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No registrations found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                {{ $registrations->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#registrationsTable').DataTable({
            "order": [[4, "desc"]], // Sort by appointment date by default
            "pageLength": 15,
            "searching": true,
            "responsive": true
        });
    });
</script>
@endpush
@endsection 