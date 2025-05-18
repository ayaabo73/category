<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
    }

    public function show(Category $Category)
    {

        $Category->load('articles');

        return CategoryResource::make($Category);
    }

    public function store(CategoryRequest $request)
    {

        $Category = Category::create([

            'name' => $request->input('name'),

        ]);

        $Category->load('articles');

        return CategoryResource::make($Category);
    }

    public function update(CategoryRequest $request, Category $Category)
    {

        $Category->update([

            'name' => $request->input('name'),
        ]);

        $Category->load('articles');

        return CategoryResource::make($Category);

    }

    public function delete(Category $Category)
    {

        Category::destroy($Category->id);

        return response()->json(['message' => 'Category Deleted']);

    }
}
