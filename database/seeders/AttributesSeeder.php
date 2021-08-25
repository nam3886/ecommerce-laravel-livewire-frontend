<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $size = Attribute::create([
            'code' => 'size',
            'name' => 'Size',
            'frontend_type' => 'radio',
            'is_filterable' => 1,
            'updated_by' => 1,
        ]);
        $size->values()->createMany([
            ...array_map(fn ($item) => ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => $item], range(38, 45)),
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'S'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'M'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'L'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'XL'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'XXL'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'XXXL'],
        ]);

        $color = Attribute::create([
            'code' => 'color',
            'name' => 'Color',
            'frontend_type' => 'radio',
            'is_filterable' => 1,
            'updated_by' => 1,
        ]);
        $color->values()->createMany([
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'gray'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'green'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'white'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'black'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'blue'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'navy'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'creamy white'],
        ]);

        $material = Attribute::create([
            'code' => 'material',
            'name' => 'Material',
            'frontend_type' => 'radio',
            'updated_by' => 1,
        ]);
        $material->values()->createMany([
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'wood'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'cotton'],
            ['updated_by' => 1, 'code' => strtoupper(bin2hex(random_bytes(4))), 'name' => 'paper'],
        ]);
    }
}
