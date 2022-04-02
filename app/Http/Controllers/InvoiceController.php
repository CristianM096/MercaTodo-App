<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\Redirect;


class InvoiceController extends Controller
{
    public function store(SupportCollection $data): Invoice
    {
        $invoice = Invoice::create([
            'total' => $data['total'],
            'reference' => $data['reference'],
            'payment_status'=> $data['payment_status'],
            'url_payment' => $data['payment_status'],
            'customer_id' => $data['customer_id'],
            'user_id' => $data['user_id'],
        ]);
        return $invoice;
    }
}
