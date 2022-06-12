<?php

namespace Database\Factories\ReceiveUser\Eloquent;

use App\Models\ReceiveUser\Eloquent\ReceiveUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReceiveUserFactory extends Factory
{
    protected $model = ReceiveUser::class;

    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'name' => $this->faker->name()
        ];
    }
}
