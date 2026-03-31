<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password',
        'role', 'nis', 'nip', 'kelas',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'password' => 'hashed',
    ];

    // Gunakan 'username' sebagai auth credential (bukan email)
    public function getAuthIdentifierName(): string
    {
        return 'username';
    }
}
