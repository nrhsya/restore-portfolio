<?php

namespace App\Models;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Education extends Model
{
    protected $guarded = [];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }
}
