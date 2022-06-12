<?php

namespace Database\Factories\Mail\Eloquent;

use App\Models\Mail\Eloquent\MailContent;
use Illuminate\Database\Eloquent\Factories\Factory;

class MailContentFactory extends Factory
{
    protected $model = MailContent::class;

    public function definition()
    {
        return [
            'subject' => $this->faker->realText(100),
            'body' => $this->faker->realText(1000),
            'cc' => $this->faker->safeEmail(),
        ];
    }
}
