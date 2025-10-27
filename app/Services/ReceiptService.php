<?php

namespace App\Services;

use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ReceiptService
{
    /**
     * Generate a PDF receipt for a payment
     */
    public function generateReceipt(Payment $payment): string
    {
        // Generate PDF
        $pdf = PDF::loadView('pdf.payment-receipt', ['payment' => $payment]);

        // Create receipts directory if it doesn't exist
        $directory = 'public/receipts';
        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory);
        }

        // Generate filename
        $filename = sprintf(
            'receipt_%s_%s.pdf',
            $payment->id,
            $payment->created_at->format('Y_m_d_His')
        );

        // Save PDF to storage
        $path = $directory . '/' . $filename;
        Storage::put($path, $pdf->output());

        // Return the public URL
        return Storage::url('receipts/' . $filename);
    }
}