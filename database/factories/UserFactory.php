<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now()->format('Y-m-d H:i:s'),
            'password' =>  bcrypt('password'), 
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Define a user with the "admin" role.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    // public function admin()
    // {
    //     return $this->state(function (array $attributes) {
    //         return [
    //             'role' => 'admin',
    //         ];
    //     });
    // }

    // public function withRole(string $roleName)
    // {
    //     return $this->state(function (array $attributes) use ($roleName) {
    //         $role = Role::where('name', $roleName)->where('guard_name', 'web')->first();
    //         return [
    //             'role_id' => $role->id ?? null,
    //         ];
    //     });
    // }
}
