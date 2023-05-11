<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
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
            'name'=> fake()->sentence(),
            'description'=> fake()->paragraph(),
            'summary'=> fake()->sentence(),
            'priority'=> fake()->randomElement(['Low','Medium','High']),
            'status'=> fake()->randomElement(['Open','Closed']),
            'project_id'=> Project::factory(),
            'developer_id' => User::where('role','Developer')->inRandomOrder()->first(),

        ];
    }
}
