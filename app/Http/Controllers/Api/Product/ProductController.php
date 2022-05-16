<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreApiProductRequest;
use App\Http\Requests\Product\UpdateApiProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Auth\Events\Registered;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(12);
        return ProductResource::collection($products);
    }

    public function store(StoreApiProductRequest $request): ProductResource
    {
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'photo' => $request->photo,
            'discount' => $request->discount,
            'description' => $request->description,
            'stock' => $request->stock,
            'color' => $request->color,
            'weight' => $request->weight,
            'size' => $request->size,
            'active' => $request->active,
            'category_id' => $request->category,
        ]);
        event(new Registered($product));

        return new ProductResource($product);
    }

    public function update(UpdateApiProductRequest $request, Product $product): ProductResource
    {
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'photo' => $request->photo,
            'stock' => $request->stock,
            'color' => $request->color,
            'discount' => $request->discount,
            'weight' => $request->weight,
            'size' => $request->size,
            'active' => $request->active,
            'category_id' => $request->category,
        ]);

        return new ProductResource($product);
    }
    public function show(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
