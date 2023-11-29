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

        Excercise::factory()->create(['name' => 'Press de banca plano con barra']);
        Excercise::factory()->create(['name' => 'Press de banca plano con mancuernas']);
        Excercise::factory()->create(['name' => 'Press de banca inclinado con barra']);
        Excercise::factory()->create(['name' => 'Press de banca inclinado con mancuernas']);
        Excercise::factory()->create(['name' => 'Press de banca declinado con barra']);
        Excercise::factory()->create(['name' => 'Press de banca declinado con mancuernas']);
        Excercise::factory()->create(['name' => 'Fondos en paralelas']);
        Excercise::factory()->create(['name' => 'Flexiones']);
        Excercise::factory()->create(['name' => 'Flexiones con los pies en alto']);
        Excercise::factory()->create(['name' => 'Cruces en polea']);
        Excercise::factory()->create(['name' => 'Aperturas con mancuerna']);
        Excercise::factory()->create(['name' => 'Dominadas']);
        Excercise::factory()->create(['name' => 'Remo 90 º']);
        Excercise::factory()->create(['name' => 'Remo gironda']);
        Excercise::factory()->create(['name' => 'Remo serrucho']);
        Excercise::factory()->create(['name' => 'Remo en punta']);
        Excercise::factory()->create(['name' => 'Jalón al pecho']);
        Excercise::factory()->create(['name' => 'Press militar con barra']);
        Excercise::factory()->create(['name' => 'Press de hombro con mancuerna']);
        Excercise::factory()->create(['name' => 'Elevaciones frontales']);
        Excercise::factory()->create(['name' => 'Elevaciones laterales']);
        Excercise::factory()->create(['name' => 'YWT +I']);
        Excercise::factory()->create(['name' => 'Face Pull']);
        Excercise::factory()->create(['name' => 'Rotaciones externas']);
        Excercise::factory()->create(['name' => 'Curl bíceps con barra recta']);
        Excercise::factory()->create(['name' => 'Curl bíceps con barra Z']);
        Excercise::factory()->create(['name' => 'Curl bíceps con mancuernas']);
        Excercise::factory()->create(['name' => 'Curl bíceps con mancuernas (martillo)']);
        Excercise::factory()->create(['name' => 'Curl bíceps en polea']);
        Excercise::factory()->create(['name' => 'Extensiones de tríceps en polea']);
        Excercise::factory()->create(['name' => 'Press francés barra Z']);
        Excercise::factory()->create(['name' => 'Press francés barra recta']);
        Excercise::factory()->create(['name' => 'Elevaciones por encima de la cabeza']);
        Excercise::factory()->create(['name' => 'Sentadilla con barra']);
        Excercise::factory()->create(['name' => 'Sentadilla frontal con barra']);
        Excercise::factory()->create(['name' => 'Sentadilla frontal con KTB']);
        Excercise::factory()->create(['name' => 'Sentadillas con salto']);
        Excercise::factory()->create(['name' => 'Sentadilla española']);
        Excercise::factory()->create(['name' => 'Sentadilla búlgara']);
        Excercise::factory()->create(['name' => 'Zancadas con mancuernas']);
        Excercise::factory()->create(['name' => 'Peso muerto con barra recta']);
        Excercise::factory()->create(['name' => 'Peso muerto con barra hexagonal']);
        Excercise::factory()->create(['name' => 'Swing KTB']);
        Excercise::factory()->create(['name' => 'Subidas al cajón']);
        Excercise::factory()->create(['name' => 'Elevación de talones unilateral']);
        Excercise::factory()->create(['name' => 'Sentadilla con salto']);
        Excercise::factory()->create(['name' => 'Abdominales en V']);
        Excercise::factory()->create(['name' => 'Plancha abdominales']);
        Excercise::factory()->create(['name' => 'Elevación de piernas en barra']);
        Excercise::factory()->create(['name' => 'Dominadas con anillas']);
        Excercise::factory()->create(['name' => 'Press hombro KTB invertida ']);
        Excercise::factory()->create(['name' => 'Hiperextension con clubbell']);
        Excercise::factory()->create(['name' => 'Remo lateral a una mano TRX']);
        Excercise::factory()->create(['name' => 'Press inclinado máquina shock']);
        Excercise::factory()->create(['name' => 'Peso muerto sumo']);
        Excercise::factory()->create(['name' => 'Press palof']);
        Excercise::factory()->create(['name' => 'Cruces en polea de arriba a abajo']);
        Excercise::factory()->create(['name' => 'Rueda abs']);
        Excercise::factory()->create(['name' => 'Hip Thrust']);
        Excercise::factory()->create(['name' => 'Extensión tríceps en polea unilateral ']);
        Excercise::factory()->create(['name' => 'Dominadas neutras']);
        Excercise::factory()->create(['name' => 'Jalón máquina shock']);
        Excercise::factory()->create(['name' => 'Press francés barra romana ']);
        Excercise::factory()->create(['name' => 'Extensión de cuádriceps ']);
        Excercise::factory()->create(['name' => 'Curl femoral ']);
        Excercise::factory()->create(['name' => 'Elevación de piernas colgado']);
        Excercise::factory()->create(['name' => 'Extensión gemelo piernas flexionadas ']);
        Excercise::factory()->create(['name' => 'Sentadilla jaca']);
        Excercise::factory()->create(['name' => 'Encogimiento de abdominales en TRX']);
        Excercise::factory()->create(['name' => 'Jalón shock unilateral']);
        Excercise::factory()->create(['name' => 'Patada tríceps ']);
        Excercise::factory()->create(['name' => 'Cruces con goma horizontal ']);
        Excercise::factory()->create(['name' => 'Press hombro shock polea']);
        Excercise::factory()->create(['name' => 'Remo gironda unilateral']);
        Excercise::factory()->create(['name' => 'Cruces en polea de abajo a arriba ']);
        Excercise::factory()->create(['name' => 'Jalón al pecho unilateral']);
        Excercise::factory()->create(['name' => 'Caídas nórdicas']);
        Excercise::factory()->create(['name' => 'Remo TRX']);
        Excercise::factory()->create(['name' => 'Remo gironda palanca unilateral']);
        Excercise::factory()->create(['name' => 'Prensa de discos unilateral']);
        Excercise::factory()->create(['name' => 'Peso muerto rumano unilateral']);
        Excercise::factory()->create(['name' => 'Prensa de discos']);
        Excercise::factory()->create(['name' => 'Remo gironda agarre U']);
        Excercise::factory()->create(['name' => 'Cleans KTB']);
        

    }
}
