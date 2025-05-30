<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;

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

    public function store(CategoryRequest $request, CategoryService $service)
    {

        $Category = $service->create($request->input('name'));

        return CategoryResource::make($Category);
    }

    public function update(CategoryRequest $request, Category $Category, CategoryService $service)
    {

        $Category = $service->update($Category, $request->input('name'));

        return CategoryResource::make($Category);

    }

    public function destroy(Category $Category, CategoryService $service)
    {

        $service->delete($Category);

        return response()->json(['message' => 'Category Deleted']);

    }
}
