<?php

namespace App\Http\Controllers\Webcheckout;

use App\Actions\CreateSessionAction;
use App\Constants\PaymentStatus;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Models\Invoice;
use App\Request\CreateSessionRequest;
use App\Services\WebcheckoutService;
use Illuminate\Http\Request;
use League\CommonMark\Reference\Reference;
use Illuminate\Support\Str;
use FFI\Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;

class WebcheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function store(CreateSessionAction $createSessionAction)
    {
        $processUrl = $createSessionAction->handle();
        return response()->json(['processUrl'=>$processUrl]);
    }
}
