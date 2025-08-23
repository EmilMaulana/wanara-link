<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shortlink extends Model
{
    protected $fillable = [
        'alias',
        'original_url',
        'clicks',
        'user_id', // Tambahkan ini
    ];

    /**
     * Get the user that owns the shortlink.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}