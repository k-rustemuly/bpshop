<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Смартфоны и гаджеты', 'parent_id' => 0, 'created_at' => now() ],
            ['name' => 'Ноутбуки и компьютеры', 'parent_id' => 0, 'created_at' => now() ],
            ['name' => 'Бытовая техника', 'parent_id' => 0, 'created_at' => now() ],
            ['name' => 'Смартфоны и телефоны', 'parent_id' => 1, 'created_at' => now() ],
            ['name' => 'Гаджеты', 'parent_id' => 1, 'created_at' => now() ],
            ['name' => 'Наушники', 'parent_id' => 1, 'created_at' => now() ],
            ['name' => 'Планшеты', 'parent_id' => 1, 'created_at' => now() ],
            ['name' => 'Ноутбуки', 'parent_id' => 2, 'created_at' => now() ],
            ['name' => 'Компьютеры', 'parent_id' => 2, 'created_at' => now() ],
            ['name' => 'Аксессуары', 'parent_id' => 2, 'created_at' => now() ],
            ['name' => 'Холодильники', 'parent_id' => 3, 'created_at' => now() ],
            ['name' => 'Рукоделие', 'parent_id' => 3, 'created_at' => now() ],
            ['name' => 'Уход за домом', 'parent_id' => 3, 'created_at' => now() ],
            ['name' => 'Смартфоны Samsung', 'parent_id' => 4, 'created_at' => now() ],
            ['name' => 'Смартфоны Oppo', 'parent_id' => 4, 'created_at' => now() ],
            ['name' => 'Смартфоны Xiaomi', 'parent_id' => 4, 'created_at' => now() ],
            ['name' => 'Смарт часы', 'parent_id' => 5, 'created_at' => now() ],
            ['name' => 'Смарт часы Apple', 'parent_id' => 5, 'created_at' => now() ],
            ['name' => 'Смарт часы Huawei', 'parent_id' => 5, 'created_at' => now() ],
            ['name' => 'AirPods', 'parent_id' => 6, 'created_at' => now() ],
            ['name' => 'Наушники Xiaomi', 'parent_id' => 6, 'created_at' => now() ],
            ['name' => 'Беспроводные', 'parent_id' => 6, 'created_at' => now() ],
            ['name' => 'Планшеты Samsung', 'parent_id' => 7, 'created_at' => now() ],
            ['name' => 'Планшеты Apple iPad', 'parent_id' => 7, 'created_at' => now() ],
            ['name' => 'Аксессуары для iPad', 'parent_id' => 7, 'created_at' => now() ],
            ['name' => 'Игровые ноутбуки', 'parent_id' => 8, 'created_at' => now() ],
            ['name' => 'Apple MacBook', 'parent_id' => 8, 'created_at' => now() ],
            ['name' => 'Чехлы для ноутбуков', 'parent_id' => 8, 'created_at' => now() ],
        ];
        Category::truncate();
        Category::insert($categories);
    }
}
