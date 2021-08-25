<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'name' => 'home',
                'slug' => 'home',
            ],
            [
                'name' => 'shop',
                'slug' => 'shop',
            ],
            [
                'name' => 'blog',
                'slug' => 'articles',
            ],
            [
                'name' => 'about us',
                'slug' => 'about-us',
            ],
            [
                'name' => 'contact us',
                'slug' => 'contact-us',
            ]
        ];

        foreach ($menus as $menu) {
            $menu['updated_by'] = 1;
            Menu::create($menu);
        }
    }
}
