<?php

namespace Database\Seeders;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(RolesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(BrandsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(BannersSeeder::class);
        $this->call(AttributesSeeder::class);
        $this->call(PaymentsSeeder::class);
        $this->call(VouchersSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(MenusSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(ArticleSeeder::class);
        $this->call(DeliveriesSeeder::class);
        $this->call(ProductsSeeder::class);
        cache()->flush();
        session()->flush();
    }
}
