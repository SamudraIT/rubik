<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Role::create([
            'name' => 'penghuni',
            'guard_name' => 'web'
        ]);

        \App\Models\Role::create([
            'name' => 'nakes',
            'guard_name' => 'web'
        ]);

        \App\Models\Role::create([
            'name' => 'super_visor',
            'guard_name' => 'web'
        ]);
    }
}
