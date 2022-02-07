<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Extension\Attributes\Node\Attributes;
use SebastianBergmann\Type\TypeName;
use Illuminate\Support\Str;

use function PHPSTORM_META\type;

class ProductController extends Controller
{
    public function index(Request $request):Response
    {
        
        $products = Product::paginate(12);
        if (Arr::has($request->session()->all(), 'info')){
            $info = $request->session()->all()['info'];
            return Inertia::render('Product/indexAdmin',compact('products','info'));
        }else{
            return Inertia::render('Product/indexAdmin',compact('products'));
        }
        
    }
    public function show(Request $request):Response
    {
        /*
        if($request->input('filterMaxPrice')){
            dd($request->input('filterMaxPrice'));  
        }*/
        //dd($request->input('filterName'));
        $products = Product::name($request->input('filterName'))
                    ->priceMin($request->input('filterMinPrice'))
                    ->priceMax($request->input('filterMaxPrice'))
                    ->paginate(12);
        return Inertia::render('Product/indexClient',compact('products'));
        
    }

    public function create():Response
    {
        return Inertia::render('Product/createAdmin');
    }

    public function edit(Product $product){
        return Inertia::render('Product/editAdmin',compact('product'));
    }

    public function update(Request $request, Product $product):RedirectResponse
    {
        $request->validate([
            'name' => 'string|max:255',
            'price' => 'between:0,99999999.99',
            //'photo' => 'image',
            'description' => 'string|max:100',
            'stock' => 'between:0,9999999|nullable',
            'color' => 'string|max:100',
            'weight' => 'between:0,9999.99',
            'size' => 'string|max:100',
            'active' => 'boolean'
        ]);

        $product->update($request->except(['photo']));
        
        if($request->hasFile('photo'))
        {
            $photo = $request->photo;
            $namePhoto = (string)Str::uuid().'.'.$photo->getClientOriginalExtension();
            $photo->storeAs('public/productImages',$namePhoto);
            Storage::delete('public/productImages/'.$product->getImageName());
            $product->update(['photo'=>$namePhoto]);
        }
        return Redirect::route('products.index')->with('info','Se actualizó el usuario correctamente');
    }


    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|between:0,99999999.99',
            //'photo' => 'required|string|max:255',
            'description' => 'string|max:100',
            'stock' => 'between:0,9999999|nullable',
            'color' => 'required|string|max:100',
            'weight' => 'required|between:0,9999.99',
            'size' => 'string|max:100',
            'active' => 'required|boolean'
        ]);
        
        $photo = $request->photo;
        $namePhoto = (string)Str::uuid().'.'.$photo->getClientOriginalExtension();
        
        //dd($namePhoto);
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'photo' => $namePhoto,
            'photoName' => $namePhoto,
            'description' => $request->description,
            'stock' => $request->stock,
            'color' => $request->color,
            'weight' => $request->weight,
            'size' => $request->size,
            'active' => $request->active
        ]);
        event(new Registered($product));
        $photo->storeAs('public/productImages',$namePhoto);

        $message = "Se creó el Producto correctamente";

        return redirect(route('products.index'))->with('info',$message);
    }

}
