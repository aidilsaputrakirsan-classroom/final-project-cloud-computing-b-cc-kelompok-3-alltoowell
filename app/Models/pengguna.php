<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;

    protected $table = 'pengguna'; // sesuaikan nama tabel
    protected $fillable = ['nama', 'email', 'telepon', 'status_checkin'];
}
