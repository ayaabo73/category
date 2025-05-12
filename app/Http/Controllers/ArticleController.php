<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\category;

class ArticleController extends Controller
{

    
    public function index()
    {
          $categorys=Category::all();
          $articales=Article::all();
        return view('article',compact('categorys','articales'));
    }


     public function store( Request $request)
    {
         $categorys=Category::all();
          $articales=Article::all();
       Article::create([
       'title'=>$request->title,
       'body'=>$request->body,
       'category'=>$request->category_ids
       ]);
    
          return view('article',compact('categorys','articales'));

    }

}
