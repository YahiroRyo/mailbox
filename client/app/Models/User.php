<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const UPDATED_AT = null;
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'created_at',
        'remember_token',
    ];

    public function active()
    {
        return $this->hasOne(UserActive::class, 'user_id', 'user_id');
    }
}
