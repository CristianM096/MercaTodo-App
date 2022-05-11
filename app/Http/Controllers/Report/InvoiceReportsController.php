<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\InvoiceReportRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoiceReportsController extends Controller
{
    public function index()
    {
        $initialDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::tomorrow()->format('Y-m-d');
        return Inertia::Render('Report/Invoice/invoiceReportIndex',compact('initialDate','endDate'));
    }

    public function generate(InvoiceReportRequest $request)
    {
        dd($request);
    }
}
