<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        return view('category');
    }

    public function store(CategoryRequest $request)
    {
        Category::create([
            'name' =>$request->input('name')
        ]);

        return response('تمت الاضافة ');

    }
}
