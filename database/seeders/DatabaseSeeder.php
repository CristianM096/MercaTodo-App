<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use \App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        User::factory(10)->create();
        Product::factory(20)->create();
    }
}
