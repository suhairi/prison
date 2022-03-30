<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create([
            'name'  => 'Gula',
            'price' => 4.30,

        ]);

        Products::create([
            'name'  => 'Kopi',
            'price' => 6.70,

        ]);

        Products::create([
            'name'  => 'Tepung',
            'price' => 2.80,

        ]);

        
    }
}
