@extends('layouts.shared')

@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="mb-3">Pilih Rumah Sakit di Yogyakarta</h1>
            <p class="mb-4">Pilih dari jaringan fasilitas kesehatan terpercaya di Yogyakarta untuk menjadwalkan janji temu Anda</p>
        </div>

        <div class="row g-4 justify-content-center">
            <!-- Search Bar -->
            <div class="col-lg-8 mb-4">
                <form id="searchForm" action="{{ route('selection.hospital') }}" method="GET">
                    <div class="input-group">
                        <input type="text" id="hospitalSearch" name="search" 
                               class="form-control" 
                               placeholder="Cari rumah sakit berdasarkan nama atau lokasi..."
                               value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search me-1"></i> Cari
                        </button>
                    </div>
                </form>
            </div>

            <!-- Filters -->
            <div class="col-lg-8 mb-4">
                <div class="d-flex flex-wrap gap-2">
                    <select class="form-select" name="specialty" style="width: auto;">
                        <option value="all">Semua Spesialisasi</option>
                        <option value="general" {{ request('specialty') == 'general' ? 'selected' : '' }}>Rumah Sakit Umum</option>
                        <option value="cardiac" {{ request('specialty') == 'cardiac' ? 'selected' : '' }}>Perawatan Jantung</option>
                        <option value="pediatric" {{ request('specialty') == 'pediatric' ? 'selected' : '' }}>Anak</option>
                        <option value="orthopedic" {{ request('specialty') == 'orthopedic' ? 'selected' : '' }}>Ortopedi</option>
                    </select>
                    <select class="form-select" name="sort" style="width: auto;">
                        <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Urutkan berdasarkan Nama</option>
                        <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Urutkan berdasarkan Rating</option>
                        <option value="reviews" {{ request('sort') == 'reviews' ? 'selected' : '' }}>Urutkan berdasarkan Ulasan</option>
                    </select>
                </div>
            </div>

            <!-- Hospital Cards -->
            <div class="col-lg-12">
                <div class="row g-4" id="hospitalList">
                    @include('partials.hospital-cards')
                </div>
                
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $hospitals->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Hospital Details Modal -->
<div class="modal fade" id="hospitalDetails" tabindex="-1" aria-labelledby="hospitalDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hospitalDetailsLabel">Detail Rumah Sakit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.hospital-card {
    transition: transform 0.2s ease-in-out;
}
.hospital-card:hover {
    transform: translateY(-5px);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle specialty and sort changes
    document.querySelectorAll('select[name="specialty"], select[name="sort"]').forEach(select => {
        select.addEventListener('change', function() {
            document.getElementById('searchForm').submit();
        });
    });

    // Live search functionality
    let searchTimeout;
    const searchInput = document.getElementById('hospitalSearch');
    
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 500);
    });

    // Handle hospital details modal
    const modal = document.getElementById('hospitalDetails');
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function() {
            const hospitalId = this.getAttribute('data-hospital-id');
            const modalBody = modal.querySelector('.modal-body');
            
            // Show loading spinner
            modalBody.innerHTML = `
                <div class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `;
            
            // Fetch hospital details
            fetch(`/hospital/${hospitalId}`)
                .then(response => response.text())
                .then(html => {
                    modalBody.innerHTML = html;
                })
                .catch(error => {
                    modalBody.innerHTML = `
                        <div class="alert alert-danger">
                            Error loading hospital details. Please try again.
                        </div>
                    `;
                });
        });
    });
});
</script>
                    <!-- Hospital Card Template -->
                    @foreach($hospitals ?? [] as $hospital)
                    <div class="col-lg-4 col-md-6">
                        <div class="hospital-card bg-light rounded p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img class="flex-shrink-0 rounded-circle" src="{{ $hospital->image ?? asset('img/hospital-default.jpg') }}" alt="Hospital" style="width: 45px; height: 45px;">
                                <div class="ms-3">
                                    <h5 class="mb-1">{{ $hospital->name ?? 'Nama Rumah Sakit' }}</h5>
                                    <span><i class="fa fa-map-marker-alt text-primary me-1"></i>{{ $hospital->location ?? 'Lokasi' }}</span>
                                </div>
                            </div>
                            <p class="mb-2"><i class="fa fa-star text-warning me-1"></i>{{ $hospital->rating ?? '4.5' }} ({{ $hospital->reviews_count ?? '123' }} Ulasan)</p>
                            <p class="mb-3">{{ $hospital->description ?? 'Deskripsi rumah sakit...' }}</p>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-outline-primary btn-sm" href="#" data-bs-toggle="modal" data-bs-target="#hospitalDetails{{ $hospital->id ?? '1' }}">
                                    Lihat Detail
                                </a>
                                <a class="btn btn-primary btn-sm" href="{{ route('appointment.create', ['hospital' => $hospital->id ?? 1]) }}">
                                    Pilih Rumah Sakit
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Fallback Content if No Hospitals -->
                    @if(empty($hospitals))
                    <div class="col-12 text-center">
                        <div class="p-4 rounded bg-light">
                            <h3>Contoh Rumah Sakit di Yogyakarta</h3>
                            <div class="row g-4 mt-2">
                                <!-- Sample Hospital 1 -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="hospital-card bg-white rounded p-4 shadow-sm">
                                        <div class="d-flex align-items-center mb-3">
                                            <img class="flex-shrink-0 rounded-circle" src="{{ asset('img/hospital-default.jpg') }}" alt="Hospital" style="width: 45px; height: 45px;">
                                            <div class="ms-3">
                                                <h5 class="mb-1">RSUP Dr. Sardjito</h5>
                                                <span><i class="fa fa-map-marker-alt text-primary me-1"></i>Jalan Kesehatan, Sleman</span>
                                            </div>
                                        </div>
                                        <p class="mb-2"><i class="fa fa-star text-warning me-1"></i>4.8 (520 Ulasan)</p>
                                        <p class="mb-3">Rumah sakit rujukan nasional dengan fasilitas lengkap dan tenaga medis berpengalaman.</p>
                                        <div class="d-flex justify-content-between">
                                            <button class="btn btn-outline-primary btn-sm">Lihat Detail</button>
                                            <button class="btn btn-primary btn-sm">Pilih Rumah Sakit</button>
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