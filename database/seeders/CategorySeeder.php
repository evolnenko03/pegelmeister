<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'General Knowledge', 'description' => 'Random facts and trivia']);
        Category::create(['name' => 'Pop Culture', 'description' => 'Movies, music, celebrities']);
        Category::create(['name' => 'Sports', 'description' => 'Sports and athletics']);
        Category::create(['name' => 'History', 'description' => 'Historical events and figures']);
        Category::create(['name' => 'Science', 'description' => 'Scientific facts and discoveries']);
    }
}
