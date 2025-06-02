@extends('layouts.shared')

@section('content')
<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h2 class="mb-3">Payment Successful!</h2>
                        <p class="text-muted mb-4">Your MCU registration payment has been processed successfully.</p>
                        
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">Payment Details</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Transaction ID</td>
                                            <td class="text-end"><strong>{{ $payment->transaction_id }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Amount Paid</td>
                                            <td class="text-end"><strong>Rp {{ number_format($payment->amount, 0, ',', '.') }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Payment Method</td>
                                            <td class="text-end"><strong>{{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Payment Date</td>
                                            <td class="text-end"><strong>{{ $payment->payment_date->format('d F Y H:i') }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">MCU Registration Details</h5>
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td>Registration Number</td>
                                            <td class="text-end"><strong>{{ $payment->mcuRegistration->registration_number }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Hospital</td>
                                            <td class="text-end"><strong>{{ $payment->mcuRegistration->hospital->name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>MCU Package</td>
                                            <td class="text-end"><strong>{{ ucfirst($payment->mcuRegistration->mcu_package) }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td>Appointment Date</td>
                                            <td class="text-end"><strong>{{ $payment->mcuRegistration->appointment_date->format('l, d F Y') }}</strong></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            A confirmation email has been sent to your registered email address.
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('user.mcu.show', $payment->mcuRegistration->id) }}" class="btn btn-primary me-2">
                                <i class="fas fa-eye me-1"></i> View MCU Details
                            </a>
                            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                                <i class="fas fa-home me-1"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection 