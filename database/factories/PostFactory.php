<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'title' => $this->faker->text($maxNbChars =200),
            'body' =>  $this->faker->paragraph(),
            'status' => $this->faker->numberBetween(0,1),
            
        ];
    }
}
