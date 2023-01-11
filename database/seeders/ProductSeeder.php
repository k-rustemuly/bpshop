<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create("ru_RU");
        Product::truncate();
        foreach (range(1, 200) as $index)  {
            Product::create(
                [
                    "name" => $faker->sentence(3),
                    "slug" => $faker->unique()->slug,
                    "description" => $faker->paragraph(2),
                    "category_id" => $faker->numberBetween(4, 28),
                    "price" => $faker->numberBetween(1, 1250)*1000,
                ]
            );
        }
    }
}
