<?php

namespace Database\Factories;

use App\Models\team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    protected $model = team::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company(),
        ];
    }
}
