<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(DepartmentSeeder::class);

         \App\Models\User::create([
             'first_name' => fake()->name(),
             'last_name' => fake()->name(),
             'phone' => "01027060835",
             'salary' => fake()->numberBetween(15000,25000),
             'image' => null,
             'manager_id' => null,
             'email' =>"mahmoud@gmail.com",
             'email_verified_at' => now(),
             'password' => 'password',
             'remember_token' => Str::random(10),
         ])->attachRole("administrator");
    }
}
