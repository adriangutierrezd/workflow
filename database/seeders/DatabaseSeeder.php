<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ExcerciseSeeder;

use App\Models\Role;
use App\Models\WorkoutStatus;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::factory()->create(['name' => 'ADMIN', 'selectable' => 0]);
        Role::factory()->create(['name' => 'USER']);
        Role::factory()->create(['name' => 'TRAINER']);

        WorkoutStatus::factory()->create(['name' => 'Borrador']);
        WorkoutStatus::factory()->create(['name' => 'Pendiente']);
        WorkoutStatus::factory()->create(['name' => 'En progreso']);
        WorkoutStatus::factory()->create(['name' => 'Completado']);
        WorkoutStatus::factory()->create(['name' => 'Cancelado']);

        $this->call([
            ExcerciseSeeder::class
        ]);


    }
}
