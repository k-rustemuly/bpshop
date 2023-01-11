<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCharacteristicValue;
use Faker\Factory as Faker;

class ProductCharacteristicValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        ProductCharacteristicValue::truncate();
        foreach (range(1, 400) as $index)  {
            ProductCharacteristicValue::upsert(
                [[
                    "product_id" => $faker->numberBetween(1, 200),
                    "characteristic_id" => $faker->numberBetween(1, 3),
                    "value" => $faker->numberBetween(1, 1250)*10,
                ]],
                ["product_id", "characteristic_id"],
                ["value"]
            );
        }
    }
}
