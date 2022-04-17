<?php

namespace App\Actions;

use App\Models\Invoice;
use App\Services\WebcheckoutService;

class GetInformationAction
{
    public function handle(): void
    {
        $invoices = Invoice::where('payment_status', '=', 'PENDING')->get();
        foreach ($invoices as $invoice) {
            $payment_status = (new WebcheckoutService())->getInformation($invoice->reference);
            $response = $invoice->update([
                'payment_status' => $payment_status->status->status,
            ]);
        }
    }
}
