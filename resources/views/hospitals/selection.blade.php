@extends('layouts.shared')

@section('content')
<section class="page-title bg-1">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block text-center">
                    <h1 class="text-capitalize mb-5 text-lg">Select Hospital</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <!-- Search and Filter Section -->
        <div class="row mb-5">
            <div class="col-md-12">
                <form action="{{ route('hospitals.selection') }}" method="GET" class="form-inline justify-content-center">
                    <div class="form-group mx-2 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Search hospitals..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="form-group mx-2 mb-2">
                        <select name="specialty" class="form-control">
                            <option value="">All Specialties</option>
                            @foreach($specialties as $specialty)
                                <option value="{{ $specialty }}" {{ request('specialty') == $specialty ? 'selected' : '' }}>
                                    {{ ucfirst($specialty) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mx-2 mb-2">
                        <select name="sort" class="form-control">
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Sort by Rating</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                            <option value="reviews" {{ request('sort') == 'reviews' ? 'selected' : '' }}>Sort by Reviews</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Apply Filters</button>
                </form>
            </div>
        </div>

        <!-- Hospitals Grid -->
        <div class="row">
            @forelse($hospitals as $hospital)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 hospital-card">
                        <img src="{{ $hospital->image_url ?? asset('images/default-hospital.jpg') }}" 
                             class="card-img-top" alt="{{ $hospital->name }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $hospital->name }}</h5>
                            <p class="card-text">
                                <i class="fas fa-map-marker-alt text-primary"></i> {{ $hospital->location }}
                            </p>
                            <div class="mb-2">
                                <span class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $hospital->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span class="text-muted">({{ $hospital->reviews_count }} reviews)</span>
                            </div>
                            <p class="card-text small text-muted">
                                {{ Str::limit($hospital->description, 100) }}
                            </p>
                            <div class="mt-3">
                                <button class="btn btn-outline-primary btn-sm view-details" 
                                        data-hospital-id="{{ $hospital->id }}">
                                    View Details
                                </button>
                                <a href="{{ route('user.mcu.register', ['hospital' => $hospital->id]) }}" 
                                   class="btn btn-primary btn-sm">
                                    Select Hospital
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>No hospitals found matching your criteria.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $hospitals->links() }}
            </div>
        </div>
    </div>
</section>

<!-- Hospital Details Modal -->
<div class="modal fade" id="hospitalDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hospital Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3" id="modalLoader">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div id="hospitalDetails" style="display: none;">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('.view-details').click(function() {
        const hospitalId = $(this).data('hospital-id');
        $('#modalLoader').show();
        $('#hospitalDetails').hide();
        $('#hospitalDetailsModal').modal('show');

        $.get(`/hospitals/${hospitalId}/details`, function(response) {
            const hospital = response.hospital;
            let content = `
                <div class="row">
                    <div class="col-md-6">
                        <img src="${hospital.image_url || '/images/default-hospital.jpg'}" 
                             class="img-fluid mb-3" alt="${hospital.name}">
                    </div>
                    <div class="col-md-6">
                        <h4>${hospital.name}</h4>
                        <p><i class="fas fa-map-marker-alt"></i> ${hospital.location}</p>
                        <p><i class="fas fa-phone"></i> ${hospital.phone}</p>
                        <p><i class="fas fa-envelope"></i> ${hospital.email}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <h5>About</h5>
                        <p>${hospital.description}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5>Specialties</h5>
                        <ul>
                            ${response.specialties.map(s => `<li>${s}</li>`).join('')}
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5>Facilities</h5>
                        <ul>
                            ${response.facilities.map(f => `<li>${f}</li>`).join('')}
                        </ul>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <p><strong>Number of Doctors:</strong> ${response.doctors_count}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Success Rate:</strong> ${response.success_rate}%</p>
                    </div>
                </div>
            `;
            
            $('#modalLoader').hide();
            $('#hospitalDetails').html(content).show();
        });
    });
});
</script>
@endsection 