<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Illuminate\Support\Facades\Redirect;
use Inertia\Response;

class CartController extends Controller
{
    public function index(): Response
    {
        $cartContent = Cart::content();
        return Inertia::render('Cart/index', compact('cartContent'));
    }
    public function store(Request $request): RedirectResponse
    {
        $product = $request->product;
        $cart = Cart::add(
            $product['id'],
            $product['name'],
            $request->qty,
            $product['price'],
        );

        return redirect()->route('productsClient.index');
    }

    public function update(Request $request): RedirectResponse
    {
        Cart::update($request->rowId, $request->quantity);
        return redirect()->back();
    }

    public function remove(String $rowId): RedirectResponse
    {
        Cart::remove($rowId);
        return Redirect::route('cart-content.index');
    }
    public function destroy(): RedirectResponse
    {
        Cart::destroy();
        return Redirect::route('cart-content.index');
    }
}
