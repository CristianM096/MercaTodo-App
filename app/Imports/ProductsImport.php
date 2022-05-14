<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\ProductCategory;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Faker\Factory as Faker;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ProductsImport implements ToModel,WithHeadingRow,WithChunkReading, ShouldQueue, WithUpserts
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'id' => Arr::get($row,'id'),
            'name' => Arr::get($row,'name'),
            'price' => Arr::get($row,'price'),
            'discount' => Arr::get($row,'discount'),
            'photo' => Arr::get($row,'photo') ? Arr::get($row,'photo') : "blank.jpg",
            'description' => Arr::get($row,'description'),
            'stock' => Arr::get($row,'stock'),
            'color' => Arr::get($row,'color'),
            'weight' => Arr::get($row,'weight'),
            'size' => Arr::get($row,'size'),
            'active' => Arr::get($row,'active') ? true : false,
            'category_id' => Arr::get($row,'category_id'),
        ]);
    }

    public function uniqueBy()
    {
        return ['id'];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

}
