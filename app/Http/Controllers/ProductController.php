<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index():Response
    {
        $products = Product::all();
        return Inertia::render('Product/index',['products' => $products]);
    }
}
