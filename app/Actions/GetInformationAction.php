<?php
namespace App\Actions;

use App\Models\Invoice;
use League\CommonMark\Reference\Reference;
use App\Services\WebcheckoutService;
use Faker\Provider\ar_EG\Payment;

class GetInformationAction
{
    public function handle()
    {
        $invoices = Invoice::where('payment_status','=','PENDING')->get();
        foreach($invoices as $invoice){
            $payment_status= (new WebcheckoutService())->getInformation($invoice->reference);
            $response = $invoice->update([
                'payment_status' => $payment_status->status->status,
            ]);
        }
    }
}
