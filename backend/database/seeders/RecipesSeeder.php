<?php

namespace Database\Seeders;

use App\Models\Recipes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Recipes::factory()->count(10)->create();
    }
}
