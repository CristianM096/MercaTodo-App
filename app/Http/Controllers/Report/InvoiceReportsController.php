<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\InvoiceReportRequest;
use App\Models\Invoice;
use Carbon\Carbon;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

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
        $initialDate = $request->initialDate;
        $endDate = $request->endDate;
        $data = Invoice::where('updated_at','>=',$initialDate)
                ->groupBy('payment_status')
                ->where('payment_status','=','APPROVED')
                ->where('updated_at','<=',$endDate)
                ->select(DB::raw('Date(updated_at) as date'),DB::raw('Sum(total) as total'))->groupBy('date')
                ->get();
        $data = $data->all();
        return view('Report.Invoice.invoiceReportShow')
            ->with(['data'=> $data,
                'initialDate'=> $initialDate,
                'endDate' => $endDate,
                'date' => Carbon::now()->format('Y-m-d'),
            ]);
        
        $pdf = PDF::loadView('Report.Invoice.invoiceReportShow', $data->all());
        dd($pdf);
        return $pdf->download('invoice.pdf');
    }
}
