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
        $product = Product::findOrfail($request->input('productId'));
        $card = Cart::add(
            $product->id,
            $product->name,
            $request->input('quantity'),
            $product->price,
        );

        return Redirect::route('products.show');
    }

    public function destroy($rowId)
    {
        $item = Cart::get($rowId);
        if($item->qty==1){
            Cart::remove($rowId);
            return redirect()->route('cart-content.index');
        }else{
            $item->qty= $item->qty - 1;
            return redirect()->route('cart-content.index');
        }

    }
}
