<?php

namespace App\Http\Controllers\Webcheckout;

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
    public function index(): RedirectResponse
    {
        $request = Cart::Content()->toArray();
        $sessionData = $this->getSessionData($request);
        if (!$request or $sessionData['payment']['amount']['total']<10000) {
            return redirect()->route('cart-content.index');
        }
        try {
            $session = (new WebcheckoutService())->createSession($sessionData);
            $products = $this->getProductCart($request);
            if ('OK'===$session->status->status) {
                (new CartController())->destroy();
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
                (new InvoiceController())->store($invoice);
                return redirect()->to($session->processUrl);
            }
            redirect()->route('cart-content.index');
        } catch (Exception $e) {
            return redirect()->route('cart-content.index');
        }
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
            'returnUrl' => 'http://127.0.0.1:8000/invoice',
            'expiration' => date('c', strtotime('+10 minutes')),
        ];
    }
}
