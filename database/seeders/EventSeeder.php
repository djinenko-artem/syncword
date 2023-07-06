<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::factory(50)->create();

        foreach (User::with('events')->get() as $item) {
            if (!$item->events()->count()) {
                Event::factory()->create([
                    'event_title' => fake()->title,
                    'event_start_date' => fake()->dateTime,
                    'event_end_date' => fake()->dateTime,
                    'organization_id' => $item->id,
                ]);
            }
        }
    }
}
