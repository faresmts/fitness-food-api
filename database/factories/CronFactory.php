<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cron>
 */
class CronFactory extends Factory
{
    public function definition(): array
    {
        return [
            'runtime_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'errors' => '[]',
            'sucess' => true,
            'inserted_quantity' => fake()->numberBetween(700, 900)
        ];
    }
}
