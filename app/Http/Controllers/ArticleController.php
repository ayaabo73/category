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
          $articales=Article::with('categories')->get();
        return view('article',compact('categorys','articales'));
    }


     public function store( Request $request)
    {

       
       $article=Article::create([
      
       'title'=>$request->title,
       'body'=>$request->body,
        
       ]);
        $article->categories()->sync($request->category_ids);
    
          return 'تمت الاضافة بنجاح';

    }

}
