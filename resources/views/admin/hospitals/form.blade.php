@extends('layouts.admin')

@section('admin-content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">{{ isset($hospital) ? 'Edit Hospital' : 'Add New Hospital' }}</h1>
        <a href="{{ route('admin.hospitals.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ isset($hospital) ? route('admin.hospitals.update', $hospital) : route('admin.hospitals.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @if(isset($hospital))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <!-- Basic Information -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Hospital Name</label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $hospital->name ?? '') }}" 
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', $hospital->email ?? '') }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   id="phone" 
                                   name="phone" 
                                   value="{{ old('phone', $hospital->phone ?? '') }}" 
                                   required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" 
                                      name="address" 
                                      rows="3" 
                                      required>{{ old('address', $hospital->address ?? '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" 
                                   class="form-control @error('location') is-invalid @enderror" 
                                   id="location" 
                                   name="location" 
                                   value="{{ old('location', $hospital->location ?? '') }}" 
                                   required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3">{{ old('description', $hospital->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="specialties" class="form-label">Specialties (Comma separated)</label>
                            <textarea class="form-control @error('specialties') is-invalid @enderror" 
                                      id="specialties" 
                                      name="specialties" 
                                      rows="3" 
                                      placeholder="e.g. Cardiology, Neurology, Pediatrics">{{ old('specialties', isset($hospital) ? (is_array($hospital->specialties) ? implode(', ', $hospital->specialties) : $hospital->specialties) : '') }}</textarea>
                            @error('specialties')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <input type="number" 
                                   class="form-control @error('rating') is-invalid @enderror" 
                                   id="rating" 
                                   name="rating" 
                                   value="{{ old('rating', $hospital->rating ?? '') }}"
                                   min="0"
                                   max="5"
                                   step="0.1">
                            @error('rating')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="reviews_count" class="form-label">Reviews Count</label>
                            <input type="number" 
                                   class="form-control @error('reviews_count') is-invalid @enderror" 
                                   id="reviews_count" 
                                   name="reviews_count" 
                                   value="{{ old('reviews_count', $hospital->reviews_count ?? 0) }}"
                                   min="0">
                            @error('reviews_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Hospital Image</label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if(isset($hospital) && $hospital->image_url)
                                <div class="mt-2">
                                    <img src="{{ Storage::url($hospital->image_url) }}" 
                                         alt="Hospital Image" 
                                         class="img-thumbnail" 
                                         style="max-height: 150px;">
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> 
                        {{ isset($hospital) ? 'Update Hospital' : 'Create Hospital' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Preview image before upload
    document.getElementById('image').addEventListener('change', function(e) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.createElement('img');
            img.src = event.target.result;
            img.classList.add('img-thumbnail', 'mt-2');
            img.style.maxHeight = '150px';
            
            const previewContainer = document.querySelector('#image').parentElement;
            const oldPreview = previewContainer.querySelector('img');
            if (oldPreview) {
                oldPreview.remove();
            }
            previewContainer.appendChild(img);
        }
        reader.readAsDataURL(e.target.files[0]);
    });
</script>
@endpush
@endsection 