<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {

        return view('category');
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
        ]);

        return response('تمت الاضافة ');

    }
}
