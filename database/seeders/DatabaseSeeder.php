<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Excercise;
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

        Excercise::factory()->create(['name' => 'Press de banca']);
        Excercise::factory()->create(['name' => 'Sentadillas']);
        Excercise::factory()->create(['name' => 'Peso muerto']);
        Excercise::factory()->create(['name' => 'Dominadas']);
        Excercise::factory()->create(['name' => 'Curl de bíceps con barra']);
        Excercise::factory()->create(['name' => 'Extensiones de tríceps con polea']);
        Excercise::factory()->create(['name' => 'Press militar']);
        Excercise::factory()->create(['name' => 'Prensa de piernas']);
        Excercise::factory()->create(['name' => 'Remo con barra']);
        Excercise::factory()->create(['name' => 'Elevaciones laterales con mancuernas']);
        Excercise::factory()->create(['name' => 'Crunch abdominal']);
        Excercise::factory()->create(['name' => 'Hip Thrust']);
        Excercise::factory()->create(['name' => 'Elevación de talones']);
        Excercise::factory()->create(['name' => 'Pull-over con mancuerna']);
        Excercise::factory()->create(['name' => 'Patada de glúteos']);
        Excercise::factory()->create(['name' => 'Encogimientos de hombros']);
        Excercise::factory()->create(['name' => 'Abdominales en polea alta']);
        Excercise::factory()->create(['name' => 'Máquina de aductores']);
        Excercise::factory()->create(['name' => 'Máquina de abductores']);

    }
}
