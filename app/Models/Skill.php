<?php

namespace App\Models;

use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    protected $guarded = [];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public function experiences(): BelongsToMany
    {
        return $this->belongsToMany(Experience::class);
    }

    public function educations(): BelongsToMany
    {
        return $this->belongsToMany(Education::class);
    }

    public function certifications(): BelongsToMany
    {
        return $this->belongsToMany(Certification::class);
    }
}
