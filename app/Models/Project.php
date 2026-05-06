<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'tags',
        'github_url', 'live_url', 'stack', 'visible', 'sort_order'
    ];

    protected $casts = [
        'tags' => 'array',
        'visible' => 'boolean'
    ];
}