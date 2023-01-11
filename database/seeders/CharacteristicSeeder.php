<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Characteristic;

class CharacteristicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Characteristic::truncate();
        Characteristic::create(
            [
                "code" => "length",
                "name" => "Длина",
                "validation" => "sometimes|numeric|min:0",
                "is_filterable" => true
            ]
        );

        Characteristic::create(
            [
                "code" => "width",
                "name" => "Ширина",
                "validation" => "sometimes|numeric|min:0",
                "is_filterable" => true
            ]
        );

        Characteristic::create(
            [
                "code" => "weight",
                "name" => "Вес",
                "validation" => "sometimes|numeric|min:0",
                "is_filterable" => true
            ]
        );
    }
}
