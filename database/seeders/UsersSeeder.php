<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin          =   Role::whereSlug('admin')->first();
        $customer       =   Role::whereSlug('customer')->first();

        $user1          =   User::create([
            'name'      =>  'Nguyễn Văn An',
            'email'     =>  'nphuongnam8@gmail.com',
            'password'  =>  '123456',
            'phone'     =>  '0987654324',
            'birthday'  =>  now(),
            'currency'  =>  'USD',
            'country'   =>  'en_US',
        ]);
        $user1->roles()->attach($admin);

        $user2          =   User::create([
            'name'      =>  'Nguyễn Văn B',
            'email'     =>  'test1@truemark.cus',
            'password'  =>  '123456',
            'phone'     =>  '0909594444',
            'birthday'  =>  now(),
        ]);
        $user2->roles()->attach($customer);

        $user3 = User::create([
            'name'      =>  'Nguyễn Văn C',
            'email'     =>  'test2@truemark.cus',
            'password'  =>  '123456',
            'phone'     =>  '0909495555',
            'birthday'  =>  now(),
        ]);
        $user3->roles()->attach($customer);
    }
}
