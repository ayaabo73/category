<?php

namespace App\Services;

use App\Models\Contracts\HasReactions;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Support\Collection;

class ReactionService
{
    public function create(HasReactions $hassReaction, User $user, string $type): Reaction
    {
        return $user->reactions()->create([
            'type' => $type,
            'has_reaction_type' => $hassReaction->getClassType(),
            'has_reaction_id' => $hassReaction->getClassId(),
        ]);

    }

    public function getReaction(HasReactions $hassReaction): Collection
    {
        return $hassReaction->getReactions();
    }
}
