<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\InvoiceReportRequest;
use App\Jobs\InvoiceReportJob;
use App\Models\Invoice;
use Carbon\Carbon;
use Inertia\Inertia;
use Barryvdh\DomPDF\Facade\Pdf;
use Facade\FlareClient\Http\Response as HttpResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as IlluminateHttpResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
        // $data = Invoice::where('updated_at','>=',$request->initialDate)
        //         ->where('payment_status','=','APPROVED')
        //         ->where('updated_at','<=',$request->endDate)
        //         ->select(DB::raw('Date(updated_at) as date'),DB::raw('Sum(total) as total'))->groupBy('date')
        //         ->get();
        // $data = $data->all();
        // return view('Report/Invoice/invoiceReportShow',[
        //     'data'=> $data,
        //     'initialDate'=> $request->initialDate,
        //     'endDate' => $request->endDate,
        //     'date' => Carbon::now()->format('Y-m-d'),
        // ]);
        InvoiceReportJob::dispatch($request);
        return Redirect::route('reportInvoices.index');
    }
}
