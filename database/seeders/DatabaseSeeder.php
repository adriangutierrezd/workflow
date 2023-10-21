<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

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

    }
}
