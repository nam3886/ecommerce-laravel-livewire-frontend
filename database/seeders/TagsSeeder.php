<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            [
                'updated_by'        =>  1,
                'name'              =>  'shoes',
                'slug'              =>  Str::slug('shoes') . '-' . uniqid(),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  "women's shoes",
                'slug'              =>  Str::slug("women's shoes") . '-' . uniqid(),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  "men's shoes",
                'slug'              =>  Str::slug("men's shoes") . '-' . uniqid(),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  't-shirt',
                'slug'              =>  Str::slug('t-shirt') . '-' . uniqid(),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  'electronics',
                'slug'              =>  Str::slug('electronics') . '-' . uniqid(),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  'furniture',
                'slug'              =>  Str::slug('furniture') . '-' . uniqid(),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  'beauty',
                'slug'              =>  Str::slug('beauty') . '-' . uniqid(),
            ],
            [
                'updated_by'        =>  1,
                'name'              =>  'white',
                'slug'              =>  Str::slug('white') . '-' . uniqid(),
            ],
        ];

        Tag::insert($tags);
    }
}
