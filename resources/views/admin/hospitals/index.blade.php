@extends('layouts.shared')

@section('admin-content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Manage Hospitals</h1>
        <a href="{{ route('admin.hospitals.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Hospital
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Rating</th>
                            <th>Reviews</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($hospitals as $hospital)
                            <tr>
                                <td class="text-center">
                                    @if($hospital->image_url)
                                        <img src="{{ Storage::url($hospital->image_url) }}" 
                                             alt="{{ $hospital->name }}" 
                                             class="img-thumbnail"
                                             style="max-height: 50px;">
                                    @else
                                        <i class="fas fa-hospital fa-2x text-secondary"></i>
                                    @endif
                                </td>
                                <td>{{ $hospital->name }}</td>
                                <td>{{ $hospital->location }}</td>
                                <td>{{ $hospital->phone }}</td>
                                <td>{{ $hospital->email }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">{{ number_format($hospital->rating, 1) }}</span>
                                        <div class="text-warning">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $hospital->rating)
                                                    <i class="fas fa-star"></i>
                                                @elseif($i - 0.5 <= $hospital->rating)
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $hospital->reviews_count }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" 
                                                class="btn btn-sm btn-info" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#hospitalModal{{ $hospital->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="{{ route('admin.hospitals.edit', $hospital) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.hospitals.destroy', $hospital) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Are you sure you want to delete this hospital?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Hospital Details Modal -->
                                    <div class="modal fade" id="hospitalModal{{ $hospital->id }}" tabindex="-1">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">{{ $hospital->name }} Details</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            @if($hospital->image_url)
                                                                <img src="{{ Storage::url($hospital->image_url) }}" 
                                                                     alt="{{ $hospital->name }}" 
                                                                     class="img-fluid rounded mb-3">
                                                            @endif
                                                            <h6>Contact Information</h6>
                                                            <p><strong>Email:</strong> {{ $hospital->email }}</p>
                                                            <p><strong>Phone:</strong> {{ $hospital->phone }}</p>
                                                            <p><strong>Address:</strong> {{ $hospital->address }}</p>
                                                            <p><strong>Location:</strong> {{ $hospital->location }}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h6>Rating & Reviews</h6>
                                                            <div class="d-flex align-items-center mb-2">
                                                                <div class="text-warning me-2">
                                                                    @for($i = 1; $i <= 5; $i++)
                                                                        @if($i <= $hospital->rating)
                                                                            <i class="fas fa-star"></i>
                                                                        @elseif($i - 0.5 <= $hospital->rating)
                                                                            <i class="fas fa-star-half-alt"></i>
                                                                        @else
                                                                            <i class="far fa-star"></i>
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                                <span>({{ $hospital->reviews_count }} reviews)</span>
                                                            </div>
                                                            
                                                            <h6>Specialties</h6>
                                                            <p>
                                                                @if(is_array($hospital->specialties) && count($hospital->specialties) > 0)
                                                                    {{ implode(', ', $hospital->specialties) }}
                                                                @elseif(is_string($hospital->specialties) && !empty($hospital->specialties))
                                                                    {{ $hospital->specialties }}
                                                                @else
                                                                    No specialties listed
                                                                @endif
                                                            </p>
                                                            
                                                            <h6>Description</h6>
                                                            <p>{{ $hospital->description ?: 'No description available' }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No hospitals found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $hospitals->links() }}
            </div>
        </div>
    </div>
</div>
@endsection 