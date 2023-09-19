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
        $role1 = Role::create(['name' => 'Super Admin']);
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Master Data Entry']);
        $role4 = Role::create(['name' => 'Master Data Editor']);
        $role5 = Role::create(['name' => 'Sales User']);
        $role6 = Role::create(['name' => 'Sales Admin']);
        $role7 = Role::create(['name' => 'Production User']);
        $role8 = Role::create(['name' => 'Production Admin']);
        $role9 = Role::create(['name' => 'Warehouse User']);
        $role10 = Role::create(['name' => 'Warehouse Admin']);


        $adminUser = User::create([
            "name"=> "Super Admin",
            "email"=> "admin@admin.com",
            "password"=> Hash::make("123admin"),
            "is_active"=> true,
        ]);

        $adminUser->assignRole('Super Admin');

    }
}
