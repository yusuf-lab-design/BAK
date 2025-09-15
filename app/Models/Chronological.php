<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Chronological extends Model
{
    protected $fillable = [
            'status',
            'signed_file_path',
            'judul',
            'no',
            'uuid',
            'area',
            'subject',
            'kronologis',
            'solutions',
        ];
    
        protected $casts = [
            'date' => 'date',
            'subject' => 'array',
            'solutions' => 'array',
        ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    use HasFactory;

    
}
