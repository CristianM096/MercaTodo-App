<?php

namespace App\Http\Controllers\Webcheckout;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Request\CreateSessionRequest;
use App\Services\WebcheckoutService;
use Illuminate\Http\Request;
use League\CommonMark\Reference\Reference;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use PDO;

class WebcheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sessionData = $this->getSessionData($request->cartContent);
        $session = (new WebcheckoutService())->createSession($sessionData);
        $products = $this->getProductCart($request->cartContent);
        if('OK'===$session->status->status){
            $invoice = Invoice::create([
                'total' => $sessionData['payment']['amount']['total'],
                'reference' => $session->requestId,
                'payment_status'=> 'PENDING',
                'customer_id' => auth()->user()->id,
                'user_id' => auth()->user()->id
            ]);
            $invoice->products()->attach($products);
            $invoice->save();
            return redirect()->away($session->processUrl);
        }
        return redirect()->route('cart-content.index');
    }



    private function getProductCart(array $data){
        $products = array();
        foreach($data as $element){
            $products[$element['id']]=[
                'quantity' => $element['qty'],
                'price' => $element['price'],
                'subtotal' => $element['subtotal'],
            ];
        }
        return $products;
    }

    private function getSessionData(array $data): array
    {
        $description='';
        $total = 0;
        foreach($data as $element){
            $description = $description.'----'.'name:'.$element['name'].' cuantity:'.$element['qty'].' price:'.$element['price'];
            $total += $element['subtotal'];
        }
        $reference = Str::random(10);
        $amount = [
            'currency' => 'COP',
            'total' => $total,
        ];
        return [
            'payment' => [
                'reference' => $reference,
                'description' => $description,
                'amount' => $amount
            ],
            'returnUrl' => 'http://127.0.0.1:8000/dashboard',
            'expiration' => date('c',strtotime('+2 days')),

        ];
    }
}
