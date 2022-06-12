<?php

namespace Tests\Feature;

use App\Models\Mail\Eloquent\Mail;
use App\Models\User\Eloquent\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class MailReceiveTest extends TestCase
{
    private User $to_user;
    private array $mail_form_data;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh --path=database/migrations/**');
        Artisan::call('db:seed');
        $this->to_user = User::first();
        $this->mail_form_data = [
            'mail_text_url' => 'https://example.com',
            'mail_created_at' => Carbon::now()->toString(),
            'name' => 'テスト',
            'cc' => '',
            'from_email' => 'a@a.aa',
            'to_email' => $this->to_user->email,
            'subject' => '件名',
            'body' => '本文',
        ];
        $this->actingAs($this->to_user);
    }

    public function test_メールの受信を行える()
    {
        $response = $this->post('/api/mails', $this->mail_form_data);
        $response->assertOk();
        $mail = Mail::where('user_id', auth()->id())
                    ->orderBy('mail_id', 'desc')
                    ->doesntHave('send')
                    ->has('active')
                    ->first();
        $this->assertEquals(
            $this->mail_form_data['mail_text_url'],
            $mail->profile->mail_text_url
        );
    }
}
