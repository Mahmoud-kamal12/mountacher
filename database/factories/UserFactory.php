<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'phone' => fake()->phoneNumber(),
            'salary' => fake()->numberBetween(15000,25000),
            'image' => null,
            'manager_id' => null,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $role = fake()->randomElement(["manager","employee"]);
            if ($role == "employee"){
                $manager = User::whereNull("manager_id")->inRandomOrder()->first();
                if ($manager){
                    $user->update([
                        "manager_id" => $manager->id
                    ]);
                }
            }
            $user->attachRole($role);
        });
    }
}
