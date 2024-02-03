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

        \App\Models\Hospital::create([
            'name' => 'Mitra Keluarga',
        ]);

        $panmas = \App\Models\District::create([
            'name' => 'Pancoran Mas',
        ]);

        $sawangan = \App\Models\District::create([
            'name' => 'Sawangan',
        ]);

        $bojong_sari = \App\Models\District::create([
            'name' => 'Bojong Sari',
        ]);

        $cipayung = \App\Models\District::create([
            'name' => 'Cipayung',
        ]);

        $sukmajaya = \App\Models\District::create([
            'name' => 'Sukmajaya',
        ]);

        $cilodong = \App\Models\District::create([
            'name' => 'Cilodong',
        ]);

        $cimanggis = \App\Models\District::create([
            'name' => 'Cimanggis',
        ]);

        $tapos = \App\Models\District::create([
            'name' => 'Tapos',
        ]);

        $beji = \App\Models\District::create([
            'name' => 'Beji',
        ]);

        $limo = \App\Models\District::create([
            'name' => 'Limo',
        ]);

        $cinere = \App\Models\District::create([
            'name' => 'Cinere',
        ]);

        // panmas
        \App\Models\SubDistrict::create([
            'name' => 'Pancoran Mas',
            'district_id' => $panmas->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Depok',
            'district_id' => $panmas->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Depok Jaya',
            'district_id' => $panmas->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Mampang',
            'district_id' => $panmas->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Rangkapan Jaya Baru',
            'district_id' => $panmas->id,
        ]);

        // sawangan
        \App\Models\SubDistrict::create([
            'name' => 'Sawangan Baru',
            'district_id' => $sawangan->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Sawangan Lama',
            'district_id' => $sawangan->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Pasir Putih',
            'district_id' => $sawangan->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Kedaung',
            'district_id' => $sawangan->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Cinangka',
            'district_id' => $sawangan->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Pengasinan',
            'district_id' => $sawangan->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Bedahan',
            'district_id' => $sawangan->id,
        ]);

        // bojongsari
        \App\Models\SubDistrict::create([
            'name' => 'Bojongsari Baru',
            'district_id' => $bojong_sari->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Curug',
            'district_id' => $bojong_sari->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Pondok Petir',
            'district_id' => $bojong_sari->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Serua',
            'district_id' => $bojong_sari->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Duren Seribu',
            'district_id' => $bojong_sari->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Duren Mekar',
            'district_id' => $bojong_sari->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Bojongsari Lama',
            'district_id' => $bojong_sari->id,
        ]);

        // cipayung
        \App\Models\SubDistrict::create([
            'name' => 'Cipayung',
            'district_id' => $cipayung->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Cipayung Jaya',
            'district_id' => $cipayung->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Bojong Pondok Terong',
            'district_id' => $cipayung->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Pondok Jaya',
            'district_id' => $cipayung->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Ratujaya',
            'district_id' => $cipayung->id,
        ]);

        //sukmajaya
        \App\Models\SubDistrict::create([
            'name' => 'Tirtajaya',
            'district_id' => $sukmajaya->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Mekar Jaya',
            'district_id' => $sukmajaya->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Abadijaya',
            'district_id' => $sukmajaya->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Cisalak',
            'district_id' => $sukmajaya->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Bakti Jaya',
            'district_id' => $sukmajaya->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Sukmajaya',
            'district_id' => $sukmajaya->id,
        ]);

        // cilodong
        \App\Models\SubDistrict::create([
            'name' => 'Kalibaru',
            'district_id' => $cilodong->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Cilodong',
            'district_id' => $cilodong->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Sukamaju',
            'district_id' => $cilodong->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Kalimulya',
            'district_id' => $cilodong->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Jatimulya',
            'district_id' => $cilodong->id,
        ]);

        // cimanggis
        \App\Models\SubDistrict::create([
            'name' => 'Curug',
            'district_id' => $cimanggis->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Tugu',
            'district_id' => $cimanggis->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Harjamukti',
            'district_id' => $cimanggis->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Pasir Gunung Selatan',
            'district_id' => $cimanggis->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Mekarsari',
            'district_id' => $cimanggis->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Cisalak Pasar',
            'district_id' => $cimanggis->id,
        ]);

        // tapos
        \App\Models\SubDistrict::create([
            'name' => 'Tapos',
            'district_id' => $tapos->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Leuwinaggung',
            'district_id' => $tapos->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Sukatani',
            'district_id' => $tapos->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Jatijajar',
            'district_id' => $tapos->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Cilangkap',
            'district_id' => $tapos->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Cimpaeun',
            'district_id' => $tapos->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Sukamaju Baru',
            'district_id' => $tapos->id,
        ]);

        // beji
        \App\Models\SubDistrict::create([
            'name' => 'Beji',
            'district_id' => $beji->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Beji Timur',
            'district_id' => $beji->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Kukusan',
            'district_id' => $beji->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Tanah Baru',
            'district_id' => $beji->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Kemirimuka',
            'district_id' => $beji->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Pondok Cina',
            'district_id' => $beji->id,
        ]);

        // limo
        \App\Models\SubDistrict::create([
            'name' => 'Meruyung',
            'district_id' => $limo->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Limo',
            'district_id' => $limo->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Grogol',
            'district_id' => $limo->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Krukut',
            'district_id' => $limo->id,
        ]);

        // cinere
        \App\Models\SubDistrict::create([
            'name' => 'Cinere',
            'district_id' => $cinere->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Gandul',
            'district_id' => $cinere->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Pangkalanjati Baru',
            'district_id' => $cinere->id,
        ]);

        \App\Models\SubDistrict::create([
            'name' => 'Pangkalanjati',
            'district_id' => $cinere->id,
        ]);

    }
}
