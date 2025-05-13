<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $categorys = Category::all();
        $articales = Article::with('categories')->get();

        return view('article', compact('categorys', 'articales'));
    }

    public function store(ArticleRequest $request)
    {

      
        $article = Article::create([
       
            'title' => $request->title,
            'body' => $request->body,

        ]);
        $article->categories()->sync($request->category_ids);

        return 'تمت الاضافة بنجاح';

    }
}

