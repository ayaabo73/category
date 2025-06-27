<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'has_reaction_id', 'has_reaction_type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hasReaction(): MorphTo
    {
        return $this->morphTo('has_reaction');
    }
}
