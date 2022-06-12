<?php

namespace App\Models\ReceiveUser\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceiveUser extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;
    protected $primaryKey = 'receive_user_id';
    protected $fillable = [
        'email',
        'name'
    ];
    protected $hidden = [
        'created_at'
    ];
}
