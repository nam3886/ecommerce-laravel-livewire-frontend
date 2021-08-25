<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customer               =   Role::create([
            'name'              =>  'Customer',
            'slug'              =>  'customer',
            'permissions'       =>  [
                'read'          =>  true,
            ],
            'updated_by'        =>  1,
        ]);

        $admin                  = Role::create([
            'name'              =>  'Administrator',
            'slug'              =>  'admin',
            'permissions'       =>  [
                'root'          =>  true,
            ],
            'updated_by'        =>  1,
        ]);
    }
}
