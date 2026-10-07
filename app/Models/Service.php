<?php

namespace App\Models;

use App\Models\ContactMessage;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }
}
