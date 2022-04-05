<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function index()
    {
        $cartContent = Cart::content();
        return Inertia::render('Cart/index',compact('cartContent'));
    }


    public function store(Request $request)
    {
        $product = $request->product;
        $cart = Cart::add(
            $product['id'],
            $product['name'],
            1,
            $product['price'],
        );

        return Redirect::route('products.show');
    }

    public function update(Request $request)
    {
        Cart::update($request->rowId,$request->quantity);
        return redirect()->back();
    }

    public function destroy(String $rowId)
    {
        Cart::remove($rowId);
        return Redirect::route('cart-content.index');
    }
}
