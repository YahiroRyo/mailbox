<?php

namespace App\Models\Mail\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
    public function profile()
    {
        return $this->hasOne(MailProfile::class, 'mail_id', 'mail_id');
    }
    public function active()
    {
        return $this->hasOne(MailActive::class, 'mail_id', 'mail_id');
    }
    public function readed()
    {
        return $this->hasOne(MailReaded::class, 'mail_id', 'mail_id');
    }
    public function send()
    {
        return $this->hasOne(MailSend::class, 'mail_id', 'mail_id');
    }

    public static function find_all()
    {
        return Mail::where('user_id', auth()->id())
            ->orderBy('mail_id', 'desc')
            ->doesntHave('send')
            ->has('active')
            ->get();
    }
    public static function find_one(string $mail_id)
    {
        return DB::transaction(function () use ($mail_id) {
            $mail = Mail::where('user_id', auth()->id())
                        ->has('active')
                        ->find($mail_id);
            MailReaded::updateOrCreate([
                'mail_id' => $mail_id
            ]);
            return $mail;
        });
    }
}
