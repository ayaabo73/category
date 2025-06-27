<?php

namespace App\Models\Contracts;

use Illuminate\Support\Collection;

interface HasReactions
{
    public function getClassType(): string;

    public function getClassId(): int;

    public function getReactions(): Collection;
}
