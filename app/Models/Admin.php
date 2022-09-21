<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'lokasi_id',
        'nip',
        'no_hp',
        'nama_lengkap',
        'alamat',
        'login_id',
        'jenis_kelamin'
    ];

    public function Lokasi(): BelongsTo
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id', 'id');
    }

    public function Login(): BelongsTo
    {
        return $this->belongsTo(Login::class, 'login_id', 'id');
    }
}
