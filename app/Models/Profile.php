<?php

namespace App\Models;

use App\Models\SocialLink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Profile extends Model
{
    protected $guarded = [];

    protected $casts = [
        'urls' => 'array',
        'available_for_work' => 'boolean',
    ];

    public function socialLinks(): HasMany
    {
        return $this->hasMany(SocialLink::class);
    }
}
