<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'status' => $this->faker->randomElement(['unknow', 'active', 'inactive']),
            'category_id' => Category::get()->random()->id,
        ];
    }
}
