<?php

namespace App\Models;

use App\Models\Contracts\HasReactions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia, HasReactions
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = ['title', 'body'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function getClassType(): string
    {
        return get_class($this);
    }

    public function getClassId(): int
    {
        return $this->id;
    }

    public function getReactions(): Collection
    {
        return $this->reactions;
    }

    public function reactions(): MorphMany
    {
        return $this->morphMany(Reaction::class, 'has_reactions');
    }
}
