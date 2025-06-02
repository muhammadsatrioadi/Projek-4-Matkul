<?php

namespace App\Http\Controllers;

use App\Models\McuRegistration;
use App\Models\Payment;
use Illuminate\Http\Request;
use TCPDF;

class PaymentController extends Controller
{
    /**
     * Show the payment page for a specific MCU registration.
     */
    public function show(McuRegistration $registration)
    {
        // Ensure the user owns this registration
        if ($registration->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($registration->payment_status === 'paid') {
            return redirect()->route('user.mcu.show', $registration->id)
                ->with('error', 'This registration has already been paid.');
        }

        return view('user.payment.show', compact('registration'));
    }

    /**
     * Process the payment for a specific MCU registration.
     */
    public function processPayment(Request $request, McuRegistration $registration)
    {
        // Ensure the user owns this registration
        if ($registration->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($registration->payment_status === 'paid') {
            return redirect()->route('user.mcu.show', $registration->id)
                ->with('error', 'This registration has already been paid.');
        }

        // Validate payment method
        $request->validate([
            'payment_method' => 'required|in:bank_transfer,credit_card,e_wallet,qris'
        ]);

        // Here you would typically integrate with a payment gateway
        // For now, we'll just mark it as paid
        $registration->update([
            'payment_status' => 'paid',
            'payment_method' => $request->payment_method,
            'paid_at' => now()
        ]);

        // Create a payment record
        $payment = $registration->payment()->create([
            'amount' => $registration->total_cost,
            'payment_method' => $request->payment_method,
            'status' => 'completed',
            'transaction_id' => 'TRX-' . time() . '-' . $registration->id,
            'payment_date' => now()
        ]);

        // Redirect to success page with payment ID
        return redirect()->route('payment.success', $payment->id);
    }

    /**
     * Show the payment success page.
     */
    public function success(Request $request, $id = null)
    {
        // If no payment ID is provided but there's a query parameter, redirect to dashboard
        if (!$id && $request->has('10')) {
            return redirect()->route('user.dashboard')
                ->with('success', 'Your payment has been processed successfully.');
        }

        // If no valid payment ID, redirect to dashboard
        if (!$id) {
            return redirect()->route('user.dashboard')
                ->with('error', 'Invalid payment reference.');
        }

        $payment = Payment::with(['mcuRegistration.hospital'])
            ->whereHas('mcuRegistration', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->findOrFail($id);

        return view('user.payment.success', compact('payment'));
    }

    /**
     * Generate and download PDF receipt
     */
    public function downloadPdf($id)
    {
        $payment = Payment::with(['mcuRegistration.hospital'])
            ->whereHas('mcuRegistration', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->findOrFail($id);

        // Create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('HealthNav');
        $pdf->SetAuthor('HealthNav');
        $pdf->SetTitle('Payment Receipt');

        // Remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(20, 20, 20);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 20);

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 11);

        // Content
        $html = view('user.payment.pdf', compact('payment'))->render();
        
        // Print text
        $pdf->writeHTML($html, true, false, true, false, '');

        // Close and output PDF document
        return $pdf->Output('payment-receipt-' . $payment->transaction_id . '.pdf', 'D');
    }
}
