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

    public function index(ArticleIndexRequest $request)
    {
        $articles = Article::query()
            ->latest()
            ->when($request->filled('keyword'), fn ($query) => $query->where('title', 'like', '%'.$request->input('keyword').'%'))
            ->when($request->filled('category_ids'), fn ($query) => $query->whereHas('categories', fn ($categoriesQuery) => $categoriesQuery->whereIn('categories.id', $request->input('category_ids'))))
            ->paginate($request->input('per_page'))->withQueryString();

        return ArticleResource::collection($articles);
    }

    public function show(Article $article)
    {
        $article->load('categories');

        return ArticleResource::make($article);
    }

    public function store(ArticleRequest $request)
    {

        $article = $this->service->create($request->input('title'), $request->input('body'), $request->input('category_ids'));

        $article->load('categories');

        return ArticleResource::make($article);

    }

    public function update(ArticleRequest $request, Article $article, ArticleService $service)
    {

        $article = $this->service->update($article, $request->input('title'), $request->input('body'), $request->input('category_ids'));

        $article->load('categories');

        return ArticleResource::make($article);

    }

    public function destroy(Article $article, ArticleService $service)
    {

        $this->service->delete($article);

        return response()->json(['message' => 'Article Deleted']);

    }
}
