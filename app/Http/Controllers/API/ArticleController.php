<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleIndexRequest;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(ArticleIndexRequest $request)
    {
        $articles = Article::paginate($request->input('per_page'))->withQueryString();

        return ArticleResource::collection($articles);
    }

    public function show(Article $article)
    {
        $article->load('categories');

        return ArticleResource::make($article);
    }

    public function store(ArticleRequest $request)
    {

        $article = Article::create([

            'title' => $request->input('title'),
            'body' => $request->input('body'),

        ]);
        $article->categories()->sync($request->input('category_ids'));

        $article->load('categories');

        return ArticleResource::make($article);

    }

    public function update(ArticleRequest $request, Article $article)
    {

        $article->update([

            'title' => $request->input('title'),
            'body' => $request->input('body'),

        ]);
        $article->categories()->sync($request->input('category_ids'));

        $article->load('categories');

        return ArticleResource::make($article);

    }

    public function destroy(Article $article)
    {

        Article::destroy($article->id);

        return response()->json(['message' => 'Article Deleted']);

    }
}
