<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Trait\HasUlid;

class Mail extends Model
{
    use HasFactory, HasUlid;

    public const UPDATED_AT = null;
    protected $primaryKey = 'mail_id';
    protected $fillable = [
        'user_id'
    ];
    protected $hidden = [
        'user_id'
    ];

    public function content()
    {
        return $this->hasOne(MailContent::class, 'mail_id', 'mail_id');
    }
    public function active()
    {
        return $this->hasOne(MailActive::class, 'mail_id', 'mail_id');
    }
    public function readed()
    {
        return $this->hasOne(MailRead::class, 'mail_id', 'mail_id');
    }

    public static function find_all()
    {
        return Mail::where('user_id', auth()->id())
            ->has('active')
            ->with('readed')
            ->get();
    }
    public static function find_one(string $mail_id)
    {
        return Mail::where('user_id', auth()->id())
                    ->has('active')
                    ->with('readed')
                    ->find($mail_id);
    }
}
