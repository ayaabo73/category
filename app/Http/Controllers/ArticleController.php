<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;

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

            'title' => $request->input('title'),
            'body' => $request->input('body'),

        ]);
        $article->categories()->sync($request->input('category_ids'));

        return 'تمت الاضافة بنجاح';

    }
}
