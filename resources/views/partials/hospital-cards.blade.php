@forelse($hospitals as $hospital)
<div class="col-lg-4 col-md-6 hospital-item">
    <div class="hospital-card bg-white rounded p-4 shadow-sm">
        <div class="d-flex align-items-center mb-3">
            <img class="flex-shrink-0 rounded-circle" 
                 src="{{ $hospital->image_url ?? asset('img/hospital-default.jpg') }}" 
                 alt="{{ $hospital->name }}" 
                 style="width: 45px; height: 45px; object-fit: cover;">
            <div class="ms-3">
                <h5 class="mb-1">{{ $hospital->name }}</h5>
                <span><i class="fa fa-map-marker-alt text-primary me-1"></i>{{ $hospital->location }}</span>
            </div>
        </div>
        <p class="mb-2">
            <i class="fa fa-star text-warning me-1"></i>
            {{ number_format($hospital->rating, 1) }} 
            ({{ $hospital->reviews_count }} Reviews)
        </p>
        <p class="mb-3">{{ Str::limit($hospital->description, 100) }}</p>
        <div class="d-flex justify-content-between">
            <button type="button" 
                    class="btn btn-outline-primary btn-sm view-details" 
                    data-bs-toggle="modal" 
                    data-bs-target="#hospitalDetails" 
                    data-hospital-id="{{ $hospital->id }}">
                <i class="fas fa-info-circle me-1"></i> View Details
            </button>
            <a href="{{ route('hospital.show', $hospital->id) }}" 
               class="btn btn-primary btn-sm">
                <i class="fas fa-check-circle me-1"></i> Select Hospital
            </a>
        </div>
    </div>
</div>
@empty
<div class="col-12 text-center">
    <div class="alert alert-info">
        <i class="fas fa-info-circle me-2"></i>
        No hospitals found matching your criteria.
    </div>
</div>
@endforelse 