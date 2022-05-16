<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\indexProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Response;
use Inertia\Inertia;
use Gloudemans\Shoppingcart\Facades\Cart;
use Ramsey\Uuid\Type\Integer;

class ProductClientController extends Controller
{
    public function index(indexProductRequest $request): Response
    {
        $filter = [
            'filterName' => $request->input('filterName'),
            'filterMinPrice' => $request->input('filterMinPrice'),
            'filterMaxPrice' => $request->input('filterMaxPrice'),
        ];
        $products = Product::name($request->input('filterName'))
            ->priceMin($request->input('filterMinPrice'))
            ->priceMax($request->input('filterMaxPrice'))
            ->where('active', '=', true)
            ->paginate(12)
            ->appends($request->only($filter));
        $featured = null;
        $qtyCart = Cart::count();
        if ($filter === null) {
            return Inertia::render('Product/indexClient', compact('products', 'featured', 'qtyCart'));
        }
        return Inertia::render('Product/indexClient', compact('products', 'filter', 'featured', 'qtyCart'));
    }

    public function show(Request $request, Product $product): Response
    {
        $qtyCart = Cart::count();
        return Inertia::render('Product/showClient', compact('product', 'qtyCart'));
    }
}
