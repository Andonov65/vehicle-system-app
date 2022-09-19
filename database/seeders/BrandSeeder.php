<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::query()->create([
            'name'=> 'Toyota'
        ]);

        Brand::query()->create([
            'name'=> 'BMW'
        ]);

        Brand::query()->create([
            'name'=> 'Audi'
        ]);

        Brand::query()->create([
            'name'=> 'Opel'
        ]);
    }
}
