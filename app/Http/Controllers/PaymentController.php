<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function showPaymentPage(Request $request)
    {
        // Retrieve registration data from the session
        $registrationData = $request->session()->get('registration_data');

        // Define package prices
        $prices = [
            'basic' => 'Rp. 500.000',
            'standard' => 'Rp. 1.000.000',
            'premium' => 'Rp. 2.500.000',
        ];

        // Determine the price based on the selected package
        $selectedPackage = $registrationData['package'] ?? 'basic'; // Default to 'basic' if not set
        $packagePrice = $prices[$selectedPackage] ?? 'N/A'; // Fallback to 'N/A' if the package is not found

        return view('payment', [
            'registrationData' => $registrationData,
            'packagePrice' => $packagePrice,
        ]);
    }

    public function processPayment(Request $request)
    {
        // Implement your payment processing logic here
        // For example, integrating with a payment gateway

        return redirect()->route('payment.success');
    }
}
