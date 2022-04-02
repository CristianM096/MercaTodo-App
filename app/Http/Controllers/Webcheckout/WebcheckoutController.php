<?php

namespace App\Http\Controllers\Webcheckout;

use App\Http\Controllers\Controller;
use App\Http\Controllers\InvoiceController;
use App\Models\Invoice;
use App\Request\CreateSessionRequest;
use App\Services\WebcheckoutService;
use Illuminate\Http\Request;
use League\CommonMark\Reference\Reference;
use Illuminate\Support\Str;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use PDO;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Collection;

class WebcheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartContent = Cart::content()->toArray();
        $sessionData = $this->getSessionData($cartContent);
        $session = (new WebcheckoutService())->createSession($sessionData);
        $products = $this->getProductCart($cartContent);

        if('OK'===$session->status->status){
            $invoice = (new InvoiceController)->store(collect([
                'total' => $sessionData['payment']['amount']['total'],
                'reference' => $session->requestId,
                'payment_status' => 'PENDING',
                'url_payment' => $session->processUrl,
                'customer_id' => auth()->user()->id,
                'user_id' => auth()->user()->id
            ]));
            $invoice->products()->attach($products);
            $invoice->save();
            return Redirect::away($session->processUrl);
        }

        return Redirect::route('cart-content.index');
    }

    public function store()
    {
    }



    private function getProductCart(array $data): array
    {
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
