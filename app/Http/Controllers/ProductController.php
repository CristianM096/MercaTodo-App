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
        $products = Product::paginate(5);
        //$products = Product::all();
        //dd($products);
        return Inertia::render('Product/index',compact('products'));
    }
}
