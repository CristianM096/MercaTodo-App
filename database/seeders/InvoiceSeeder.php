<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereHas('roles', function ($query){
            $query->where('name','Admin');
        })->first();

        Invoice::factory()
            ->count(20)
            ->make()
            ->each(function (Invoice $invoice) use ($user){
                $client = User::whereHas('roles', function ($query){
                        $query->where('name','Client');
                    })
                    ->inRandomOrder()
                    ->first();
                $products =Product::inRandomOrder()
                    ->limit(3)
                    ->get();
                $data = [];

                foreach ($products as $product){
                    $quantity = random_int(2,6);
                    $data[$product->id] = [
                        'quantity' => $quantity,
                        'price' => (float) $product->price,
                        'subtotal' => (float) $product->price * $quantity,
                    ];
                }

                //$paymentStatus = (new PaymentStatus())->toArray();

                $invoice->total = collect(array_values($data))->sum('subtotal');
                //$invoice->payment_status = $paymentStatus[random_int(0,1)];
                $invoice->customer()->associate($client);
                $invoice->user()->associate($user);
                $invoice->save();
                $invoice->products()->attach($data);

            });
    }
}
