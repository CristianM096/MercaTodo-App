<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Admin']);
        $client = Role::create(['name' => 'Client']);

        Permission::create(['name'=>'users.index'])->syncRoles([$admin]);
        Permission::create(['name'=>'users.edit'])->syncRoles([$admin]);
        Permission::create(['name'=>'users.update'])->syncRoles([$admin]);
        Permission::create(['name'=>'dashboard'])->syncRoles([$admin,$client]);
    }
}
