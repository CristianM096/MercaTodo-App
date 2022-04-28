<?php

namespace App\Actions;

use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Services\WebcheckoutService;
use App\Http\Controllers\Cart\CartController;
use Illuminate\Http\Request;
use App\Constants\PaymentStatus;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Models\Invoice;

class CreateSessionAction
{
    public function handle(): ? String
    {
        $request = Cart::Content()->toArray();
        $sessionData = $this->getSessionData($request);
        $session = (new WebcheckoutService())->createSession($sessionData);
        $products = $this->getProductCart($request);
        $processUrl = null;
        if ('OK'===$session->status->status) {
            (new CartController())->destroy();
            $invoice = $this->createInvoice($sessionData,$session,$products);
            (new InvoiceController())->store($invoice);
            $processUrl = $session->processUrl;
            
        }
        return $processUrl ?? null;
    }

    private function createInvoice(array $sessionData,object $session, array $products): Request
    {
        $invoice = (new Request());
        $invoice->setMethod('post');
        $invoice->request->add([
            'total' => $sessionData['payment']['amount']['total'],
            'reference' => $session->requestId,
            'payment_status'=> PaymentStatus::PENDING,
            'payment_url' => $session->processUrl,
            'customer_id' => auth()->user()->id,
            'user_id' => auth()->user()->id,
            'products' => $products,
        ]);
        return $invoice;
    }
    
    private function getProductCart(array $data): array
    {
        $products = array();
        foreach ($data as $element) {
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
        foreach ($data as $element) {
            $description = $description.''.'name:'.$element['name'].' quantity:'.$element['qty'].' price:'.$element['price'].' & ';
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
            'returnUrl' => 'http://127.0.0.1:8000/invoice',
            'expiration' => date('c', strtotime('+10 minutes')),
        ];
    }
}