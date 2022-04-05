<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    


    public function store(Request $request):RedirectResponse
    {
        $invoice = Invoice::create([
            'total' => $request->total,
            'reference' => $request->reference,
            'payment_status' => $request->payment_status,
            'payment_url' => $request->payment_url,
            'customer_id' => $request->customer_id,
            'user_id' => $request->user_id,
        ]);
        $Products = $request->products;
        $invoice->save();
        $invoice->products()->attach($Products);
        return redirect()->route('cart-content.index');
    }
}
