<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name'     => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ],
            [
                'name'     => 'Budi Santoso',
                'username' => 'guru_budi',
                'password' => Hash::make('password'),
                'role'     => 'guru',
                'nip'      => '197001012000011001',
            ],
            [
                'name'     => 'Andi Pratama',
                'username' => 'siswa_andi',
                'password' => Hash::make('password'),
                'role'     => 'siswa',
                'nis'      => '2024001',
                'kelas'    => 'X IPA 1',
            ],
            [
                'name'     => 'Siti Rahayu',
                'username' => 'ortu_siti',
                'password' => Hash::make('password'),
                'role'     => 'orangtua',
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['username' => $user['username']],
                $user
            );
        }
    }
}
