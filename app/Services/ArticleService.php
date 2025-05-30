<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    public function create(string $title, string $body, array $category_ids): Article
    {
        $article = Article::create([
            'title' => $title,
            'body' => $body,
        ]);
        $article->categories()->sync($category_ids);

        return $article;
    }

    public function update(Article $article, string $title, string $body, array $category_ids): Article
    {
        $article->update([
            'title' => $title,
            'body' => $body,
        ]);
        $article->categories()->sync($category_ids);

        return $article;
    }

    public function delete(Article $article): bool
    {
        return $article->delete();

    }
}
