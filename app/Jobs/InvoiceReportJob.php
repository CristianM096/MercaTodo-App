<?php

namespace App\Jobs;

use App\Actions\InvoiceReportAction;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\PDF;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\Cast\String_;

class InvoiceReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private String $initialDate;
    private String $endDate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->initialDate = $request->initialDate;
        $this->endDate = $request->endDate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(InvoiceReportAction $invoiceReportAction)
    {
        return $invoiceReportAction->handle($this->initialDate,$this->endDate);
    }
}
