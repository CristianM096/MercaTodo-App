<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\ProductCategory;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Faker\Factory as Faker;

class ProductsImport implements ToModel,WithHeadingRow
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $faker = Faker::create();
        dump($row);
        return new Product([
            'name' => Arr::get($row,'name'),
            'price' => Arr::get($row,'price'),
            'discount' => Arr::get($row,'discount'),
            'photo' => $faker->image($dir = 'storage/productImages', $width = 640, $height = 480),
            'description' => Arr::get($row,'description'),
            'stock' => Arr::get($row,'stock'),
            'color' => Arr::get($row,'color'),
            'weight' => Arr::get($row,'weight'),
            'size' => Arr::get($row,'size'),
            'active' => (function($row)
                { 
                    $response = Arr::get($row,'active',0);
                    if(null === $response){
                        dump($response);
                        return false;
                        
                    }
                    dump($response);
                    return true;
                })($row),
            'category_id' => Arr::get($row,'category_id'),
        ]);
    }
}
