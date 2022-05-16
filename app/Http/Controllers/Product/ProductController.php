<?php

namespace App\Http\Controllers\Product;

use App\Exports\ProductsExport;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Imports\ProductsImport;
use App\Jobs\ProductExportJob;
use Maatwebsite\Excel\Facades\Excel;

use function PHPSTORM_META\type;

class ProductController extends Controller
{
    public function index(Request $request): Response
    {
        $products = Product::paginate(12);
        if (Arr::has($request->session()->all(), 'message')) {
            $info = $request->session()->all()['message'];

            return Inertia::render('Product/indexAdmin', compact('products', 'info'));
        } else {
            return Inertia::render('Product/indexAdmin', compact('products'));
        }
    }

    public function create(): Response
    {
        $categories = ProductCategory::all();
        return Inertia::render('Product/createAdmin', compact('categories'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        return Inertia::render('Product/editAdmin', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'color' => $request->color,
            'discount' => $request->discount,
            'weight' => $request->weight,
            'size' => $request->size,
            'active' => $request->active,
            'category_id' => $request->category,
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->photo;
            $namePhoto = (string)Str::uuid().'.'.$photo->getClientOriginalExtension();
            $photo->storeAs('public/productImages', $namePhoto);
            Storage::delete('public/productImages/'.$product->getImageName());
            $product->update(['photo'=>$namePhoto]);
        }
        $message = 'Se actualizó el usuario correctamente';
        return Redirect::route('products.index');
    }


    public function store(StoreProductRequest $request): RedirectResponse
    {
        $photo = $request->photo;
        $namePhoto = (string)Str::uuid().'.'.$photo->getClientOriginalExtension();
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'photo' => $namePhoto,
            'photoName' => $namePhoto,
            'discount' => $request->discount,
            'description' => $request->description,
            'stock' => $request->stock,
            'color' => $request->color,
            'weight' => $request->weight,
            'size' => $request->size,
            'active' => $request->active,
            'category_id' => $request->category,
            'discount' => $request->discount
        ]);
        event(new Registered($product));
        $photo->storeAs('public/productImages', $namePhoto);

        $message = "Se creó el Producto correctamente";

        return Redirect::route('products.index');
    }

    public function show(Product $product): Response
    {
        return Inertia::render('Product/showAdmin', compact('product'));
    }

    public function import(Request $request): RedirectResponse
    {
        $file = $request->file;
        Excel::queueImport(new ProductsImport, $file);
        return Redirect::route('products.index');
    }
    public function export()
    {
        (new ProductsExport())->store('public/files/productExport.csv');
        return Redirect::route('products.index');
    }
}
