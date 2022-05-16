<?php

namespace App\Actions;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class InvoiceReportAction
{
    public function handle(String $initialDate, String $endDate)
    {
        $data = Invoice::where('updated_at', '>=', $initialDate)
                ->where('payment_status', '=', 'APPROVED')
                ->where('updated_at', '<=', $endDate)
                ->select(DB::raw('Date(updated_at) as date'), DB::raw('Sum(total) as total'))->groupBy('date')
                ->get();
        $data = $data->all();

        $pdf = app('dompdf.wrapper');
        $pdf->getDomPDF()->set_option("enable_php", true);

        $pdf = Pdf::loadView(
            'Report/Invoice/invoiceReportShow',
            [
            'data'=> $data,
            'initialDate'=> $initialDate,
            'endDate' => $endDate,
            'date' => Carbon::now()->format('Y-m-d'),
        ]
        );
        return $pdf->save('storage/app/public/files/invoiceReport.pdf');
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'invoice.pdf');
    }
}
