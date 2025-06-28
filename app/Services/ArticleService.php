<?php

namespace App\Services;

use App\Models\Article;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleService
{
    public function all(int $pagination = 20, array $options = [], array $with = []): LengthAwarePaginator
    {
        return Article::query()
            ->with($with)
            ->latest()
            ->when(isset($options['keyword']) && filled($options['keyword']), fn ($query) => $query->where('title', 'like', '%'.$options['keyword'].'%'))
            ->when(isset($options['category_ids']) && filled($options['category_ids']), fn ($query) => $query->whereHas('categories', fn ($categoriesQuery) => $categoriesQuery->whereIn('categories.id', $options['category_ids'])))
            ->paginate($pagination)->withQueryString();

    }

    public function first(int $id, array $with = []): ?Article
    {
        return Article::query()
            ->with($with)
            ->find($id);

    }

    public function create(string $title, string $body, array $category_ids, UploadedFile $image): Article
    {
        $article = Article::create([
            'title' => $title,
            'body' => $body,

        ]);
        $article->categories()->sync($category_ids);
        $article->addMedia($image)->toMediaCollection('images');

        return $article;
    }

    public function update(Article $article, string $title, string $body, array $category_ids, UploadedFile $image): Article
    {
        $article->update([
            'title' => $title,
            'body' => $body,
        ]);
        $article->categories()->sync($category_ids);
        $article->clearMediaCollection('images');
        $article->addMedia($image)->toMediaCollection('images');

        return $article;
    }

    public function delete(Article $article): bool
    {
        return $article->delete();

    }
}
