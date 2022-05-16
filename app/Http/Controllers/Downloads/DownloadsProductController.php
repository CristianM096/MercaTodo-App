<?php

namespace App\Http\Controllers\Downloads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DownloadsProductController extends Controller
{
    public function index()
    {
        return Inertia::render('Download/downloadProduct');
    }

    public function export()
    {
        $file = Storage::disk('public')->get('files/productExport.csv');
        return (new Response($file, 200))
               ->header('Content-Type', 'text/csv');
        return 1;
    }

    public function report()
    {
        $file = Storage::disk('public')->get('files/invoiceReport.pdf');
        return (new Response($file, 200))
               ->header('Content-Type', 'application/pdf');
    }
}
