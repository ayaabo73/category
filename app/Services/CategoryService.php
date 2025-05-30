<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function create(string $name): Category
    {
        return Category::create([
            'name' => $name,
        ]);
    }

    public function update(Category $category, string $name): Category
    {
        $category->update([
            'name' => $name,
        ]);

        return $category;
    }

    public function delete(Category $category): bool
    {
        return $category->delete();

    }
}
