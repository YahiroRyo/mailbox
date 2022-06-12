<?php

namespace App\Models\Mail\Eloquent;

use App\Models\ReceiveUser\Eloquent\ReceiveUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailProfile extends Model
{
    use HasFactory;

    public const UPDATED_AT = null;
    protected $primaryKey = 'mail_id';
    protected $fillable = [
        'mail_id',
        'receive_user_id',
        'mail_text_url',
        'mail_created_at',
    ];
    protected $hidden = [
        'created_at'
    ];

    public function receive_user()
    {
        return $this->belongsTo(ReceiveUser::class, 'receive_user_id', 'receive_user_id');
    }
}
