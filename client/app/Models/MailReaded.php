<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailReaded extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;
    protected $table = 'mail_readed';
    protected $primaryKey = 'mail_id';
    protected $fillable = [
        'mail_id',
    ];
    protected $hidden = [
        'created_at'
    ];
}
