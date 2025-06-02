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
                <form action="{{ route('hospitals.selection') }}" method="GET" id="filterForm" class="form-inline justify-content-center">
                    <div class="input-group mx-2 mb-2" style="width: 300px;">
                        <input type="text" name="search" class="form-control" placeholder="Search hospitals..." 
                               value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group mx-2 mb-2">
                        <select name="specialty" class="form-control" onchange="document.getElementById('filterForm').submit()">
                            <option value="">All Specialties</option>
                            @foreach($specialties as $specialty)
                                <option value="{{ $specialty }}" {{ request('specialty') == $specialty ? 'selected' : '' }}>
                                    {{ ucfirst($specialty) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mx-2 mb-2">
                        <select name="sort" class="form-control" onchange="document.getElementById('filterForm').submit()">
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Sort by Rating</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Sort by Name</option>
                            <option value="reviews" {{ request('sort') == 'reviews' ? 'selected' : '' }}>Sort by Reviews</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <!-- Hospitals Grid -->
        <div class="row">
            @forelse($hospitals as $hospital)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 hospital-card shadow-sm">
                        <div class="position-relative">
                            <img src="{{ $hospital->image_url ? asset('storage/' . $hospital->image_url) : asset('assets/images/default-hospital.jpg') }}" 
                                 class="card-img-top" alt="{{ $hospital->name }}" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="position-absolute top-0 end-0 p-2">
                                <span class="badge bg-primary">
                                    {{ number_format($hospital->rating, 1) }} <i class="fas fa-star text-warning"></i>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-primary">{{ $hospital->name }}</h5>
                            <p class="card-text mb-2">
                                <i class="fas fa-map-marker-alt text-danger"></i> {{ $hospital->location }}
                            </p>
                            <div class="mb-2">
                                @php
                                    $rating = round($hospital->rating);
                                @endphp
                                <span class="text-warning">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $rating)
                                            <i class="fas fa-star"></i>
                                        @elseif($i - 0.5 <= $rating)
                                            <i class="fas fa-star-half-alt"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span class="text-muted">({{ $hospital->reviews_count ?? 0 }} reviews)</span>
                            </div>
                            <p class="card-text small text-muted">
                                {{ Str::limit($hospital->description, 100) }}
                            </p>
                            <div class="mt-3 d-flex justify-content-between">
                                <button class="btn btn-outline-primary btn-sm view-details" 
                                        data-hospital-id="{{ $hospital->id }}">
                                    <i class="fas fa-info-circle"></i> View Details
                                </button>
                                <a href="{{ route('user.mcu.register', ['hospital' => $hospital->id]) }}" 
                                   class="btn btn-primary btn-sm">
                                    <i class="fas fa-check-circle"></i> Select Hospital
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> No hospitals found matching your criteria.
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="row mt-4">
            <div class="col-12 d-flex justify-content-center">
                {{ $hospitals->withQueryString()->links() }}
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3" id="modalLoader">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
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

@push('scripts')
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
                        <img src="${hospital.image_url ? '/storage/' + hospital.image_url : '/assets/images/default-hospital.jpg'}" 
                             class="img-fluid rounded mb-3" alt="${hospital.name}">
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-primary">${hospital.name}</h4>
                        <p><i class="fas fa-map-marker-alt text-danger"></i> ${hospital.location}</p>
                        <p><i class="fas fa-phone text-success"></i> ${hospital.phone}</p>
                        <p><i class="fas fa-envelope text-primary"></i> ${hospital.email}</p>
                        <div class="mt-3">
                            <span class="badge bg-primary">Rating: ${hospital.rating.toFixed(1)} <i class="fas fa-star text-warning"></i></span>
                            <span class="badge bg-info">${response.doctors_count} Doctors</span>
                            <span class="badge bg-success">${response.success_rate}% Success Rate</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <h5 class="border-bottom pb-2">About</h5>
                        <p>${hospital.description}</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2">Specialties</h5>
                        <ul class="list-unstyled">
                            ${response.specialties.map(s => `<li><i class="fas fa-check-circle text-success"></i> ${s}</li>`).join('')}
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h5 class="border-bottom pb-2">Facilities</h5>
                        <ul class="list-unstyled">
                            ${response.facilities.map(f => `<li><i class="fas fa-check-circle text-success"></i> ${f}</li>`).join('')}
                        </ul>
                    </div>
                </div>
            `;
            
            $('#modalLoader').hide();
            $('#hospitalDetails').html(content).show();
        });
    });
});
</script>
@endpush 