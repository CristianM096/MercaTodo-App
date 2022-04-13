<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Response;
use Inertia\Inertia;

class ProductClientController extends Controller
{
    public function index(Request $request): Response
    {
        $products = Product::name($request->input('filterName'))
                    ->priceMin($request->input('filterMinPrice'))
                    ->priceMax($request->input('filterMaxPrice'))
                    ->where('active', '=', true);
        $products = $products->paginate(12);     
        $featured = $products->orderByRaw('RAND()')->take(1)->get();
        return Inertia::render('Product/indexClient', compact('products','featured'));
    }
}
