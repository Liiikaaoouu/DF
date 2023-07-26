<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_project' => $this->faker->word,
            'name_of_the_manager' => $this->faker->name,
            'email_of_the_manager' => $this->faker->email,
            'start_date_of_execution' => $this->faker->date,
            'status' => $this->faker->randomElement(['unkow', 'active', 'inactive']),
            // 'user_id' => function () {
            //     return User::all()->random()->id;
            // },
        ];
    }
}
