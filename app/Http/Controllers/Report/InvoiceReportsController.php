<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InvoiceReportsController extends Controller
{
    public function index()
    {
        $initialDate = Carbon::now()->format('Y-m-d');
        return Inertia::Render('Report/invoiceReportIndex',compact('initialDate'));
    }
}
