@extends('layouts.shared')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Medical Check-Up Registration</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('user.mcu.register.submit') }}">
                        @csrf
                        
                        <!-- Hospital Selection -->
                        <div class="mb-4">
                            <label for="hospital_id" class="form-label">Select Hospital</label>
                            <select name="hospital_id" id="hospital_id" class="form-select @error('hospital_id') is-invalid @enderror" required>
                                <option value="">Choose a hospital...</option>
                                @foreach($hospitals as $hospital)
                                    <option value="{{ $hospital->id }}" 
                                            data-facilities="{{ json_encode($hospital->facilities) }}"
                                            {{ old('hospital_id') == $hospital->id ? 'selected' : '' }}>
                                        {{ $hospital->name }} - {{ $hospital->location }}
                                    </option>
                                @endforeach
                            </select>
                            @error('hospital_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Hospital Details -->
                            <div id="hospitalDetails" class="mt-3" style="display: none;">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="hospital-name"></h5>
                                        <p class="hospital-address"></p>
                                        <div class="facilities"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MCU Package Selection -->
                        <div class="mb-4">
                            <label for="mcu_package" class="form-label">MCU Package</label>
                            <select name="mcu_package" id="mcu_package" class="form-select @error('mcu_package') is-invalid @enderror" required>
                                <option value="">Select a package...</option>
                                <option value="basic" {{ old('mcu_package') == 'basic' ? 'selected' : '' }}>
                                    Basic Package - Rp 500.000
                                </option>
                                <option value="standard" {{ old('mcu_package') == 'standard' ? 'selected' : '' }}>
                                    Standard Package - Rp 1.000.000
                                </option>
                                <option value="premium" {{ old('mcu_package') == 'premium' ? 'selected' : '' }}>
                                    Premium Package - Rp 2.500.000
                                </option>
                            </select>
                            @error('mcu_package')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                            <!-- Package Details -->
                            <div id="packageDetails" class="mt-3" style="display: none;">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="package-name"></h5>
                                        <div class="package-description"></div>
                                        <div class="package-price font-weight-bold mt-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Appointment Date and Time -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="appointment_date" class="form-label">Appointment Date</label>
                                <input type="date" name="appointment_date" id="appointment_date" 
                                       class="form-control @error('appointment_date') is-invalid @enderror"
                                       min="{{ date('Y-m-d') }}"
                                       value="{{ old('appointment_date') }}" required>
                                @error('appointment_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="appointment_time" class="form-label">Appointment Time</label>
                                <select name="appointment_time" id="appointment_time" 
                                        class="form-select @error('appointment_time') is-invalid @enderror" required>
                                    <option value="">Select time...</option>
                                    <option value="09:00" {{ old('appointment_time') == '09:00' ? 'selected' : '' }}>09:00 AM</option>
                                    <option value="10:00" {{ old('appointment_time') == '10:00' ? 'selected' : '' }}>10:00 AM</option>
                                    <option value="11:00" {{ old('appointment_time') == '11:00' ? 'selected' : '' }}>11:00 AM</option>
                                    <option value="13:00" {{ old('appointment_time') == '13:00' ? 'selected' : '' }}>01:00 PM</option>
                                    <option value="14:00" {{ old('appointment_time') == '14:00' ? 'selected' : '' }}>02:00 PM</option>
                                    <option value="15:00" {{ old('appointment_time') == '15:00' ? 'selected' : '' }}>03:00 PM</option>
                                </select>
                                @error('appointment_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Medical Notes -->
                        <div class="mb-4">
                            <label for="medical_notes" class="form-label">Medical Notes (Optional)</label>
                            <textarea name="medical_notes" id="medical_notes" rows="3" 
                                      class="form-control @error('medical_notes') is-invalid @enderror"
                                      placeholder="Any specific medical conditions or concerns...">{{ old('medical_notes') }}</textarea>
                            @error('medical_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                Register for Medical Check-Up
                            </button>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Package details
    const packageDetails = {
        basic: {
            name: 'Basic Package',
            description: `
                <ul>
                    <li>General physical examination</li>
                    <li>Basic blood test</li>
                    <li>Urine test</li>
                    <li>Blood pressure check</li>
                    <li>BMI measurement</li>
                </ul>
            `,
            price: 'Rp 500.000'
        },
        standard: {
            name: 'Standard Package',
            description: `
                <ul>
                    <li>All Basic Package tests</li>
                    <li>Complete blood count</li>
                    <li>Chest X-ray</li>
                    <li>ECG</li>
                    <li>Basic dental check</li>
                </ul>
            `,
            price: 'Rp 1.000.000'
        },
        premium: {
            name: 'Premium Package',
            description: `
                <ul>
                    <li>All Standard Package tests</li>
                    <li>Comprehensive blood chemistry</li>
                    <li>Cardiac stress test</li>
                    <li>Ultrasound</li>
                    <li>Cancer screening</li>
                    <li>Vision and hearing tests</li>
                </ul>
            `,
            price: 'Rp 2.500.000'
        }
    };

    // Update hospital details
    $('#hospital_id').change(function() {
        const selectedOption = $(this).find('option:selected');
        if (selectedOption.val()) {
            $.get(`/hospitals/${selectedOption.val()}/details`, function(response) {
                $('#hospitalDetails').show();
                $('.hospital-name').text(response.hospital.name);
                $('.hospital-address').text(response.hospital.address);
                
                let facilitiesHtml = '<h6>Facilities:</h6><ul>';
                response.facilities.forEach(facility => {
                    facilitiesHtml += `<li>${facility}</li>`;
                });
                facilitiesHtml += '</ul>';
                $('.facilities').html(facilitiesHtml);
            });
        } else {
            $('#hospitalDetails').hide();
        }
    });

    // Update package details
    $('#mcu_package').change(function() {
        const selectedPackage = $(this).val();
        if (selectedPackage && packageDetails[selectedPackage]) {
            const details = packageDetails[selectedPackage];
            $('#packageDetails').show();
            $('.package-name').text(details.name);
            $('.package-description').html(details.description);
            $('.package-price').text(details.price);
        } else {
            $('#packageDetails').hide();
        }
    });

    // Initialize if values are pre-selected
    if ($('#hospital_id').val()) {
        $('#hospital_id').trigger('change');
    }
    if ($('#mcu_package').val()) {
        $('#mcu_package').trigger('change');
    }
});
</script>
@endsection 