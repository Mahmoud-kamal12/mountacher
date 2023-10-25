<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::factory()
            ->count(rand(10,20))
            ->has(
                User::factory()
                    ->count(rand(10,20))
                    ->afterCreating(function (User $user) {
                        $tasks = Task::factory()->count(rand(5, 10))->create();
                        $user->tasks()->saveMany($tasks);
                }), 'users')
            ->create();
    }
}
