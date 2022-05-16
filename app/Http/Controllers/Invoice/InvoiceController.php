<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Models\Invoice;
use Inertia\Inertia;
use Inertia\Response;
use App\Jobs\GetInformationJob;

class InvoiceController extends Controller
{
    public function index(): Response
    {
        $invoices = Invoice::where('customer_id', '=', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return Inertia::render('Invoice/index', compact('invoices'));
    }

    public function show(Invoice $invoice): Response
    {
        $products = $invoice->products()->get(['name','description','discount']);
        return Inertia::render('Invoice/show', compact('invoice', 'products'));
    }

    public function store(Request $request): ?Invoice
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
        return $invoice ?? null;
    }
}
