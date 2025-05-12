<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
    public function index()
    {

        return view('category');
    }


     public function store( Request $request)
    {
       category::create([
       'name'=>$request->name,
       ]);
    
          return response('تمت الاضافة ');

    }
}
