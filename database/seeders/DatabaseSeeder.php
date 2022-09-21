<?php

namespace Database\Seeders;

use App\Models\Lokasi;
use App\Models\Admin;
use App\Models\User;
use App\Models\Login;
use App\Models\MasterStatus;
use App\Models\Petugas;
use App\Models\Plts;
use App\Models\Status;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        MasterStatus::create([
            'nama_status' => 'Belum Terbayar',
        ]);
        MasterStatus::create([
            'nama_status' => 'Menunggu Konfirmasi',
        ]);
        MasterStatus::create([
            'nama_status' => 'Terbayar',
        ]);
        MasterStatus::create([
            'nama_status' => 'Di Batalkan',
        ]);
        MasterStatus::create([
            'nama_status' => 'Berhenti',
        ]);

        Lokasi::create([
            'nama_lokasi' => 'VIKTOR',
        ]);

        Lokasi::create([
            'nama_lokasi' => 'SUTOMO',
        ]);

        Login::create([
            'email' => 'admin@gmail.com',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'roles' => 'admin',
            'is_active' => true,
        ]);

        Admin::create([
            'nama_lengkap' => 'Admin',
            'nik' => '121323243',
            'alamat' => 'serpong',
            'login_id' => 1,
            'lokasi_id' => 2,
            'nip' => '182011022201',
            'no_hp' => '0897129202100',
            'jenis_kelamin' => 'Laki-Laki'
        ]);

        Login::create([
            'email' => 'operator@gmail.com',
            'username' => 'operator',
            'password' => bcrypt('operator123'),
            'roles' => 'operator',
            'is_active' => true,
        ]);

        Petugas::create([
            'nama_lengkap' => 'Operator',
            'nik' => '1213234532',
            'alamat' => 'viktor',
            'login_id' => 2,
            'lokasi_id' => 1,
            'nip' => '182011022201',
            'no_hp' => '0897129202100',
            'jenis_kelamin' => 'Laki-Laki'
        ]);

        Login::create([
            'email' => 'juminten@gmail.com',
            'username' => 'juminten',
            'password' => bcrypt('juminten123'),
            'roles' => 'user',
            'is_active' => true,
        ]);

        User::create([
            'nama_lengkap' => 'juminten',
            'nama_rekening' => 'JUMINTEN',
            'nik' => '121323434',
            'alamat' => 'bsd',
            'login_id' => 3,
            'lokasi_id' => 1,
            'nik' => '3174109020120001',
            'no_hp' => '085778992100',
            'jenis_kelamin' => 'Perempuan',
            'rekening' => '99210020011'
        ]);

        Login::create([
            'email' => 'plts@gmail.com',
            'username' => 'plts',
            'password' => bcrypt('plts123'),
            'roles' => 'plts',
            'is_active' => true,
        ]);

        Plts::create([
            'nama_lengkap' => 'plts',
            'nik' => '121324352',
            'alamat' => 'ciputat',
            'login_id' => 4,
            'lokasi_id' => 1,
            'nip' => '182011022201',
            'no_hp' => '0897129202100',
            'jenis_kelamin' => 'Laki-Laki'
        ]);
    }
}
