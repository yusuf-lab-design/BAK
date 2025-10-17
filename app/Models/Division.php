<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    protected $fillable = [
        'name',
        'head_user_id',
        'is_active',
    ];

    public function head(): BelongsTo
    {
        return $this->belongsTo(User::class, 'head_user_id');
    }

    function users(): HasMany
    {
        return $this->hasMany(User::class, 'division_id');
    }
}
