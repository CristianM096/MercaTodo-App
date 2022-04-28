<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Response;
use Inertia\Inertia;
use Gloudemans\Shoppingcart\Facades\Cart;

class ProductClientController extends Controller
{
    public function index(Request $request): Response
    {
        $products = Product::name($request->input('filterName'))
            ->priceMin($request->input('filterMinPrice'))
            ->priceMax($request->input('filterMaxPrice'))
            ->where('active', '=', true);
        $featured = $products->orderByRaw('RAND()')->take(1)->first();
        $products = $products->paginate(12);
        $qtyCart = Cart::count();
        return Inertia::render('Product/indexClient', compact('products','featured','qtyCart'));
    }

    public function show(Request $request, Product $product): Response
    {
        $qtyCart = Cart::count();
        return Inertia::render('Product/showClient',compact('product','qtyCart'));
    }
}
