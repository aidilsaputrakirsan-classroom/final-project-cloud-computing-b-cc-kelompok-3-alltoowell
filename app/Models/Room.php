<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // <-- DI SINI! DI LUAR CLASS

class Room extends Model
{
    // UUID sebagai primary key
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name', 'price', 'description', 'facilities',
        'capacity', 'image', 'status', 'location', 'contact_owner'
    ];

    protected $casts = [
        'id' => 'string',
        'facilities' => 'array',
        'price' => 'integer',
        'capacity' => 'integer',
    ];

    // Auto-generate UUID saat create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}