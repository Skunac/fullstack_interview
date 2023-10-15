<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert([
            ['name' => 'chicken'],
            ['name' => 'beef'],
            ['name' => 'pork'],
            ['name' => 'shrimp'],
            ['name' => 'tofu'],
            ['name' => 'egg'],
            ['name' => 'onions'],
            ['name' => 'garlic'],
            ['name' => 'bell peppers'],
            ['name' => 'tomato'],
            ['name' => 'carrot'],
            ['name' => 'celery'],
            ['name' => 'potato'],
            ['name' => 'broccoli'],
            ['name' => 'spinach'],
            ['name' => 'mushroom'],
            ['name' => 'zucchini'],
            ['name' => 'green beans'],
            ['name' => 'cabbage'],
            ['name' => 'salt'],
            ['name' => 'black pepper'],
            ['name' => 'pepper'],
            ['name' => 'oregano'],
            ['name' => 'basil'],
            ['name' => 'thyme'],
            ['name' => 'rosemary'],
            ['name' => 'cumin'],
            ['name' => 'paprika'],
            ['name' => 'chili powder'],
            ['name' => 'red pepper flakes'],
            ['name' => 'cinnamon'],
            ['name' => 'nutmeg'],
            ['name' => 'rice'],
            ['name' => 'pasta'],
            ['name' => 'bread'],
            ['name' => 'flour'],
            ['name' => 'cornmeal'],
            ['name' => 'quinoa'],
            ['name' => 'milk'],
            ['name' => 'cheese'],
            ['name' => 'yogurt'],
            ['name' => 'sour cream'],
            ['name' => 'almond milk'],
            ['name' => 'olive oil'],
            ['name' => 'vegetable oil'],
            ['name' => 'butter'],
            ['name' => 'coconut oil']
        ]);
    }
}
