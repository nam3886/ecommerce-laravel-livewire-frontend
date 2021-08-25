<?php

namespace Database\Seeders;

use App\Models\Delivery;
use Illuminate\Database\Seeder;

class DeliveriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Delivery::create([
            'code' => 'delivery_ghn',
            'secret_id' => 'db98c7ef-d1de-11eb-86d6-d6ee83481554',
            'name' => 'giao hàng nhanh',
            'description' => 'giao hàng nhanh',
            'updated_by' => 1,
        ]);
        // Delivery::create([
        //     'code' => 'delivery_free',
        //     'name' => 'giao miễn phí',
        //     'description' => 'giao miễn phí',
        //     'updated_by' => 1,
        // ]);
    }
}
