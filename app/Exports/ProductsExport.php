<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::all(['id','name','price','discount','photo','description','stock','color','weight','size','active','category_id'])->take(10);
        $products->prepend(['id','name','price','discount','photo','description','stock','color','weight','size','active','category_id']);
        //$products->prepend(['id,name,price,discount,photo,description,stock,color,weight,size,active,category_id']);
        
        return $products;
    }
}
