<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Jukebox extends Model
{
    protected $table = 'project_jukebox';

    protected $fillable = [
        'music_title',
        'music_link',
        'music_thumbnail',
    ];

    public function linkedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
