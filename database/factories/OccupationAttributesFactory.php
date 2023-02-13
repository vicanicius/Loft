<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OccupationAttributesFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'life' => fake()->randomNumber(),
            'strength' => fake()->randomNumber(),
            'dexterity' => fake()->randomNumber(),
            'intelligence' => fake()->randomNumber(),
            'attack' => fake()->randomNumber(),
            'speed' => fake()->randomNumber()
        ];
    }
}
