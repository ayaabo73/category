<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Category::factory(50)->create();
        Article::factory(500)->create()->each(fn ($article) => $article->categories()->sync(Category::inRandomOrder()->limit(random_int(1, 4))->pluck('id')));
    }
}
