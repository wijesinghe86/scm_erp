<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Roleseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'superAdmin']);
        $role = Role::create(['name' => 'admin']);

        $role2 = Role::create(['name' => 'deuser']);


        $adminUser = User::create([
            "name"=> "Admin",
            "email"=> "admin@admin.com",
            "password"=> Hash::make("123admin"),
            "is_active"=> true,
        ]);

        $adminUser->assignRole('admin');

    }
}
