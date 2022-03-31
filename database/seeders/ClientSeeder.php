<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use PDO;

use function GuzzleHttp\Promise\each;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(20)
            ->create()
            ->each(function (User $user){
                $user->assignRole('Client');
            });
    }
}
