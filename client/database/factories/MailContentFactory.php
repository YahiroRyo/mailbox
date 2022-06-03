<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MailContentFactory extends Factory
{
    public function definition()
    {
        return [
            'subject' => $this->faker->realText(100),
            'body' => $this->faker->realText(1000),
        ];
    }
}
