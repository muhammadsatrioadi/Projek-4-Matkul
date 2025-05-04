@extends('layouts.shared')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="mb-3">Select a Hospital</h1>
            <p class="mb-4">Choose from our network of trusted healthcare facilities to schedule your appointment</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Search Bar -->
            <div class="col-lg-8 mb-4">
                <div class="input-group">
                    <input type="text" id="hospitalSearch" class="form-control" placeholder="Search hospitals by name or location...">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i> Search
                    </button>
                </div>
            </div>

            <!-- Filters -->
            <div class="col-lg-8 mb-4">
                <div class="d-flex flex-wrap gap-2">
                    <select class="form-select" style="width: auto;">
                        <option selected>Filter by Specialty</option>
                        <option value="general">General Hospital</option>
                        <option value="cardiac">Cardiac Care</option>
                        <option value="pediatric">Pediatric</option>
                        <option value="orthopedic">Orthopedic</option>
                    </select>
                    <select class="form-select" style="width: auto;">
                        <option selected>Sort By</option>
                        <option value="distance">Distance</option>
                        <option value="rating">Rating</option>
                        <option value="name">Name</option>
                    </select>
                </div>
            </div>

            <!-- Hospital Cards -->
            <div class="col-lg-12">
                <div class="row g-4" id="hospitalList">
                    <!-- Hospital Card Template -->
                    @foreach($hospitals ?? [] as $hospital)
                    <div class="col-lg-4 col-md-6">
                        <div class="hospital-card bg-light rounded p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img class="flex-shrink-0 rounded-circle" src="{{ $hospital->image ?? asset('img/hospital-default.jpg') }}" alt="Hospital" style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h5 class="mb-1">{{ $hospital->name ?? 'Hospital Name' }}</h5>
                                    <span><i class="fa fa-map-marker-alt text-primary me-1"></i>{{ $hospital->location ?? 'Location' }}</span>
                                </div>
                            </div>
                            <p class="mb-2"><i class="fa fa-star text-warning me-1"></i>{{ $hospital->rating ?? '4.5' }} ({{ $hospital->reviews_count ?? '123' }} Reviews)</p>
                            <p class="mb-3">{{ $hospital->description ?? 'Hospital description goes here...' }}</p>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-outline-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#hospitalDetails{{ $hospital->id ?? '1' }}">
                                    View Details
                                </a>
                                <a class="btn btn-primary btn-sm" href="{{ route('appointment.create', ['hospital' => $hospital->id ?? 1]) }}">
                                    Select Hospital
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Fallback Content if No Hospitals -->
                    @if(empty($hospitals))
                    <div class="col-12 text-center">
                        <div class="p-4 rounded bg-light">
                            <h3>Sample Hospitals</h3>
                            <div class="row g-4 mt-2">
                                <!-- Sample Hospital 1 -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="hospital-card bg-white rounded p-4 shadow-sm">
                                        <div class="d-flex align-items-center mb-3">
                                            <img class="flex-shrink-0 rounded-circle" src="{{ asset('img/hospital-default.jpg') }}" alt="Hospital" style="width: 45px; height: 45px;">
                                            <div class="ms-3">
                                                <h5 class="mb-1">City General Hospital</h5>
                                                <span><i class="fa fa-map-marker-alt text-primary me-1"></i>Downtown</span>
                                            </div>
                                        </div>
                                        <p class="mb-2"><i class="fa fa-star text-warning me-1"></i>4.8 (520 Reviews)</p>
                                        <p class="mb-3">Leading healthcare facility with state-of-the-art equipment and expert medical staff.</p>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-outline-primary btn-sm">View Details</button>
                                            <button class="btn btn-primary btn-sm">Select Hospital</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sample Hospital 2 -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="hospital-card bg-white rounded p-4 shadow-sm">
                                        <div class="d-flex align-items-center mb-3">
                                            <img class="flex-shrink-0 rounded-circle" src="{{ asset('img/hospital-default.jpg') }}" alt="Hospital" style="width: 45px; height: 45px;">
                                            <div class="ms-3">
                                                <h5 class="mb-1">St. Mary's Medical Center</h5>
                                                <span><i class="fa fa-map-marker-alt text-primary me-1"></i>Uptown</span>
                                            </div>
                                        </div>
                                        <p class="mb-2"><i class="fa fa-star text-warning me-1"></i>4.6 (380 Reviews)</p>
                                        <p class="mb-3">Specialized in cardiac care and emergency services with 24/7 availability.</p>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-outline-primary btn-sm">View Details</button>
                                            <button class="btn btn-primary btn-sm">Select Hospital</button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sample Hospital 3 -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="hospital-card bg-white rounded p-4 shadow-sm">
                                        <div class="d-flex align-items-center mb-3">
                                            <img class="flex-shrink-0 rounded-circle" src="{{ asset('img/hospital-default.jpg') }}" alt="Hospital" style="width: 45px; height: 45px;">
                                            <div class="ms-3">
                                                <h5 class="mb-1">Children's Hope Hospital</h5>
                                                <span><i class="fa fa-map-marker-alt text-primary me-1"></i>Westside</span>
                                            </div>
                                        </div>
                                        <p class="mb-2"><i class="fa fa-star text-warning me-1"></i>4.9 (450 Reviews)</p>
                                        <p class="mb-3">Dedicated pediatric care facility with child-friendly environment and specialists.</p>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-outline-primary btn-sm">View Details</button>
                                            <button class="btn btn-primary btn-sm">Select Hospital</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hospital Details Modal -->
<div class="modal fade" id="hospitalDetailsModal" tabindex="-1" aria-labelledby="hospitalDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hospitalDetailsModalLabel">Hospital Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Hospital details will be loaded here -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Hospital search functionality
        const searchInput = document.getElementById('hospitalSearch');
        searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const hospitalCards = document.querySelectorAll('.hospital-card');
            
            hospitalCards.forEach(card => {
                const hospitalName = card.querySelector('h5').textContent.toLowerCase();
                const hospitalLocation = card.querySelector('span').textContent.toLowerCase();
                
                if (hospitalName.includes(searchTerm) || hospitalLocation.includes(searchTerm)) {
                    card.closest('.col-lg-4').style.display = '';
                } else {
                    card.closest('.col-lg-4').style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
@endsection 