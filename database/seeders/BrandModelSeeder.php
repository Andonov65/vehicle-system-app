<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand1 = Brand::query()->find(1);
        $brand1->brandModels()->createMany([
            [
                'name' => 'Brand Model 1',
            ],
            [
                'name' => 'Brand Model 2',
            ],
            [
                'name' => 'Brand Model 3',
            ]
        ]);

        $brand2 = Brand::query()->find(2);
        $brand2->brandModels()->createMany([
            [
                'name' => 'Brand Model 4',
            ],
            [
                'name' => 'Brand Model 5',
            ]
        ]);

        $brand3 = Brand::query()->find(3);
        $brand3->brandModels()->create([
           'name' => 'Brand Model 6'
        ]);

    }
}
