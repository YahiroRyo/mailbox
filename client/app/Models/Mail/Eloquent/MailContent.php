<?php

namespace App\Models\Mail\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailContent extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;
    protected $primaryKey = 'mail_id';
    protected $fillable = [
        'mail_id',
        'subject',
        'body',
        'cc'
    ];
}
