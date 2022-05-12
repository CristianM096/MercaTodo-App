<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\InvoiceReportRequest;
use App\Models\Invoice;
use Carbon\Carbon;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use Facade\FlareClient\Http\Response as HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateHttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Inertia\Response;
use SebastianBergmann\Type\TypeName;

class InvoiceReportsController extends Controller
{
    public function index() : Response
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
                ->where('payment_status','=','APPROVED')
                ->where('updated_at','<=',$endDate)
                ->select(DB::raw('Date(updated_at) as date'),DB::raw('Sum(total) as total'))->groupBy('date')
                ->get();
        $data = $data->all();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);
        
        $pdf = PDF::loadView('Report/Invoice/invoiceReportShow',
        [
            'data'=> $data,
            'initialDate'=> $initialDate,
            'endDate' => $endDate,
            'date' => Carbon::now()->format('Y-m-d'),
        ]);
        return $pdf->stream('archivo.pdf');
    }
}
