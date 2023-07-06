<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_title' => fake()->title,
            'event_start_date' => fake()->dateTime,
            'event_end_date' => fake()->dateTime,
            'organization_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
