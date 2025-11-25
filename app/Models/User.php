<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasUuids, Notifiable;

    /**
     * Nama tabel dalam database.
     */
    protected $table = 'users';

    /**
     * Kolom primary key menggunakan UUID (string, bukan auto increment).
     */
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * Kolom yang dapat diisi massal.
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
    ];

    /**
     * Kolom yang harus disembunyikan saat model diubah menjadi array/json.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe data otomatis untuk casting.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Event model untuk membuat UUID otomatis.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }

            // Pastikan password di-hash otomatis saat create
            if (!empty($model->password) && !Str::startsWith($model->password, '$2y$')) {
                $model->password = bcrypt($model->password);
            }
        });
    }
}
