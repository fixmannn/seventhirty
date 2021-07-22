<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $attributes = [
        'username' => 0,
        'email' => 0,
        'password' => 0,
        'nama_depan' => 0,
        'nama_belakang' => 0,
        'alamat' => 0,
        'kecamatan' => 0,
        'kota' => 0,
        'provinsi' => 0,
        'nomor_handphone' => 0
    ];

    protected $fillable = ['username', 'email', 'password', 'nama_depan', 'nama_belakang', 'alamat', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'nomor_handphone'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
