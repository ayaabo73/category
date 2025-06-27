<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleIndexRequest;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    protected ArticleService $service;

    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    public function index(ArticleIndexRequest $request, ArticleService $service)
    {
        $articles = $this->service->all($request->input('per_page'), $request->validated());

        return ArticleResource::collection($articles);
    }

    public function show(int $article)
    {
        $model = $this->service->first($article, ['categories']);
        if (filled($model)) {
            return ArticleResource::make($model);
        } else {
            abort(404, 'Article Not Found');
        }

    }

    public function store(ArticleRequest $request)
    {

        $article = $this->service->create($request->input('title'), $request->input('body'), $request->input('category_ids'), $request->file('image'));

        $article->load('categories');

        return ArticleResource::make($article);

    }

    public function update(ArticleRequest $request, Article $article, ArticleService $service)
    {

        $article = $this->service->update($article, $request->input('title'), $request->input('body'), $request->input('category_ids'), $request->file('image'));

        $article->load('categories');

        return ArticleResource::make($article);

    }

    public function destroy(Article $article, ArticleService $service)
    {

        $this->service->delete($article);

        return response()->json(['message' => 'Article Deleted']);

    }
}
