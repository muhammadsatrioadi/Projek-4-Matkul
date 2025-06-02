@extends('layouts.shared')

@section('content')
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Payment Details</h4>
                    </div>
                    <div class="card-body">
                        <!-- Order Summary -->
                        <div class="mb-4">
                            <h5>Order Summary</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>Registration Number</td>
                                        <td class="text-end"><strong>{{ $registration->registration_number }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>MCU Package</td>
                                        <td class="text-end"><strong>{{ ucfirst($registration->mcu_package) }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Hospital</td>
                                        <td class="text-end"><strong>{{ $registration->hospital->name }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Appointment Date</td>
                                        <td class="text-end"><strong>{{ $registration->appointment_date->format('l, d F Y') }}</strong></td>
                                    </tr>
                                    <tr class="table-primary">
                                        <td><strong>Total Amount</strong></td>
                                        <td class="text-end"><strong>Rp {{ number_format($registration->total_cost, 0, ',', '.') }}</strong></td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <!-- Payment Method Selection -->
                        <form action="{{ route('process.payment', $registration) }}" method="POST" id="paymentForm">
                            @csrf
                            <div class="mb-4">
                                <h5>Select Payment Method</h5>
                                <div class="row g-3">
                                    <!-- Bank Transfer -->
                                    <div class="col-md-6">
                                        <div class="form-check payment-method-card">
                                            <input class="form-check-input" type="radio" name="payment_method" id="bankTransfer" value="bank_transfer" checked>
                                            <label class="form-check-label" for="bankTransfer">
                                                <div class="d-flex align-items-center">
                                                    <i class="icofont-bank-alt mr-2"></i>
                                                    <div>
                                                        <strong>Bank Transfer</strong>
                                                        <div class="text-muted small">Transfer to our bank account</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    <!-- Credit Card -->
                                    <div class="col-md-6">
                                        <div class="form-check payment-method-card">
                                            <input class="form-check-input" type="radio" name="payment_method" id="creditCard" value="credit_card">
                                            <label class="form-check-label" for="creditCard">
                                                <div class="d-flex align-items-center">
                                                    <i class="icofont-credit-card mr-2"></i>
                                                    <div>
                                                        <strong>Credit Card</strong>
                                                        <div class="text-muted small">Pay with Visa/Mastercard</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- E-Wallet -->
                                    <div class="col-md-6">
                                        <div class="form-check payment-method-card">
                                            <input class="form-check-input" type="radio" name="payment_method" id="eWallet" value="e_wallet">
                                            <label class="form-check-label" for="eWallet">
                                                <div class="d-flex align-items-center">
                                                    <i class="icofont-wallet mr-2"></i>
                                                    <div>
                                                        <strong>E-Wallet</strong>
                                                        <div class="text-muted small">GoPay, OVO, DANA</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- QRIS -->
                                    <div class="col-md-6">
                                        <div class="form-check payment-method-card">
                                            <input class="form-check-input" type="radio" name="payment_method" id="qris" value="qris">
                                            <label class="form-check-label" for="qris">
                                                <div class="d-flex align-items-center">
                                                    <i class="icofont-qr-code mr-2"></i>
                                                    <div>
                                                        <strong>QRIS</strong>
                                                        <div class="text-muted small">Scan to pay</div>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{ route('user.mcu.show', $registration->id) }}" class="btn btn-secondary">
                                    <i class="icofont-arrow-left mr-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="icofont-check-circled mr-1"></i> Proceed to Pay
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.payment-method-card {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 1rem;
    margin-bottom: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-method-card:hover {
    border-color: #0d6efd;
    background-color: #f8f9fa;
}

.payment-method-card .form-check-input {
    margin-right: 1rem;
}

.payment-method-card i {
    font-size: 1.5rem;
    margin-right: 1rem;
}

.form-check-input:checked + .form-check-label .payment-method-card {
    border-color: #0d6efd;
    background-color: #f8f9fa;
}
</style>
@endsection 