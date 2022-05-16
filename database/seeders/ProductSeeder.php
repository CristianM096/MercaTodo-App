<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', 'Admin');
        })->first();
        //print($user);

        Product::factory(30)
            ->make()
            ->each(function (Product $product) use ($user) {
                //$product->user()->associate($user);
                $product->category()->associate(ProductCategory::inRandomOrder()->first());
                $product->save();
            });
    }
}
