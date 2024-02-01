<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

        $penghuniRole = \App\Models\Role::where('name', 'penghuni')->first();
        $nakesRole = \App\Models\Role::where('name', 'nakes')->first();
        $superVisorRole = \App\Models\Role::where('name', 'super_visor')->first();

        // Assign permissions to roles
        $penghuniPermissions = [
            1,
            2,
            5,
            6,
            7,
            8,
            11,
            12,
            37,
            38,
            41,
            42,
            43,
            44,
            47,
            48,
            49,
            50,
            53,
            54,
            55,
            56,
            59,
            60,
            91,
            92,
            93
        ];

        $nakesPermissions = [
            1,
            2,
            5,
            6,
            7,
            8,
            11,
            12
        ];

        $superVisorPermissions = [
            1,
            2,
            3,
            4,
            5,
            6,
            7,
            8,
            9,
            10,
            11,
            12,
            37,
            38,
            39,
            40,
            41,
            42,
            43,
            44,
            45,
            46,
            47,
            48,
            49,
            50,
            51,
            52,
            53,
            54,
            55,
            56,
            57,
            58,
            59,
            60,
            93,
            94,
            95,
            96,
            97,
            98
        ];

        foreach ($penghuniPermissions as $permissionId) {
            DB::table('role_has_permissions')->insert([
                'role_id' => $penghuniRole->id,
                'permission_id' => $permissionId
            ]);
        }

        foreach ($nakesPermissions as $permissionId) {
            DB::table('role_has_permissions')->insert([
                'role_id' => $nakesRole->id,
                'permission_id' => $permissionId
            ]);
        }

        foreach ($superVisorPermissions as $permissionId) {
            DB::table('role_has_permissions')->insert([
                'role_id' => $superVisorRole->id,
                'permission_id' => $permissionId
            ]);
        }
    }
}
