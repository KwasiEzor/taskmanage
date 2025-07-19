<?php

namespace Database\Seeders;

use App\Models\Assignment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $this->call([
            CategorySeeder::class,
        ]);

        User::factory(5)
            ->has(Project::factory()->count(rand(1, 3))
                ->has(
                    Task::factory()->count(rand(2, 5))
                        ->has(
                            Assignment::factory()->count(2)
                                ->state(function (array $attributes, Task $task) {
                                    return ['user_id' => $task->project->user_id];
                                })
                        )
                ))
            ->create();
    }
}
