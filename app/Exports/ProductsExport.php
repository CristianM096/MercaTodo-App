<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class ProductsExport implements FromCollection,FromQuery,ShouldQueue
{

    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $products = Product::all(['id','name','price','discount','photo','description','stock','color','weight','size','active','category_id']);
        $products->prepend(['id','name','price','discount','photo','description','stock','color','weight','size','active','category_id']);
        //$products->prepend(['id,name,price,discount,photo,description,stock,color,weight,size,active,category_id']);
        
        return $products;
    }
    public function query()
    {
        $products = Product::all(['id','name','price','discount','photo','description','stock','color','weight','size','active','category_id']);
        $products->prepend(['id','name','price','discount','photo','description','stock','color','weight','size','active','category_id']);
        //$products->prepend(['id,name,price,discount,photo,description,stock,color,weight,size,active,category_id']);
        
        return $products;
    }
}
