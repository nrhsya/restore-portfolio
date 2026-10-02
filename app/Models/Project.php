<?php

namespace App\Models;

use App\Models\Experience;
use App\Models\ProjectImage;
use App\Models\Skill;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Project extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'featured' => 'boolean',
            'status' => 'boolean',
        ];
    }

    public function projectImages(): HasMany
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function thumbnail(): HasOne
    {
        return $this->hasOne(ProjectImage::class)
            ->where('is_thumbnail', true);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function experiences(): BelongsToMany
    {
        return $this->belongsToMany(Experience::class);
    }
}
