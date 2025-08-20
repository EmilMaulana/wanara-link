<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shortlink extends Model
{
    protected $fillable = [
        'alias',
        'original_url',
        'clicks',
    ];
}
