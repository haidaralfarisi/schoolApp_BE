<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nip' => '1234567890',  // Sesuaikan dengan format NIP
            'fullname' => 'Super Admin',  // Pastikan pakai fullname, bukan name
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('admin123'), // Hash password agar aman
            'level' => 'SUPERADMIN', // Sesuaikan dengan sistem role yang kamu pakai
            'photo' => null, // Bisa diisi dengan URL foto jika ada
        ]);

        User::create([
            'nip' => '9876543210', // Sesuaikan dengan format NIP
            'fullname' => 'Guru Pengajar',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('admin123'),
            'level' => 'GURU',
            'photo' => null,
        ]);

        User::create([
            'nip' => '9876543246', // Sesuaikan dengan format NIP
            'fullname' => 'Slamet Zakaria',
            'email' => 'tusekolah@gmail.com',
            'password' => Hash::make('admin123'),
            'level' => 'TUSEKOLAH',
            'photo' => null,
        ]);
    }
}
