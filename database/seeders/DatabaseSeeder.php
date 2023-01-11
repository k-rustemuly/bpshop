<?php

namespace Database\Seeders;

use App\Models\Characteristic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            CharacteristicSeeder::class,
            ProductCharacteristicValueSeeder::class,
        ]);
    }
}
