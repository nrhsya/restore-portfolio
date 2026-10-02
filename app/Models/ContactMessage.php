<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public const STATUS_NEW = 'new';
    public const STATUS_READ = 'read';
    public const STATUS_REPLIED = 'replied';
    public const STATUS_ARCHIVED = 'archived';

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
            'replied_at' => 'datetime',
        ];
    }

    public function markAsRead(): void
    {
        if ($this->status !== self::STATUS_NEW) {
            return;
        }

        $this->update([
            'status' => self::STATUS_READ,
            'read_at' => now(),
        ]);
    }

    public function markAsReplied(): void
    {
        $this->update([
            'status' => self::STATUS_REPLIED,
            'read_at' => $this->read_at ?? now(),
            'replied_at' => now(),
        ]);
    }

    public function archive(): void
    {
        $this->update([
            'status' => self::STATUS_ARCHIVED,
        ]);
    }
}
