<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class VerifyUsers extends Command
{
    protected $signature = 'verify:users';
    protected $description = 'Verify dan reseed test users';

    public function handle()
    {
        $this->info('Checking test users...');

        $users = [
            [
                'name'     => 'Administrator',
                'username' => 'admin',
                'password' => 'password',
                'role'     => 'admin',
                'email'    => 'admin@absensi.local',
            ],
            [
                'name'     => 'Budi Santoso',
                'username' => 'guru_budi',
                'password' => 'password',
                'role'     => 'guru',
                'nip'      => '197001012000011001',
                'email'    => 'guru@absensi.local',
            ],
            [
                'name'     => 'Andi Pratama',
                'username' => 'siswa_andi',
                'password' => 'password',
                'role'     => 'siswa',
                'nis'      => '2024001',
                'kelas'    => 'X IPA 1',
                'email'    => 'siswa@absensi.local',
            ],
            [
                'name'     => 'Siti Rahayu',
                'username' => 'ortu_siti',
                'password' => 'password',
                'role'     => 'orangtua',
                'email'    => 'ortu@absensi.local',
            ],
        ];

        foreach ($users as $userData) {
            $password = $userData['password'];
            $userData['password'] = Hash::make($password);

            $user = User::updateOrCreate(
                ['username' => $userData['username']],
                $userData
            );

            $this->line("✓ {$userData['role']} user: {$user->username} ({$user->name})");
        }

        $this->info('Done!');

        // Show all users
        $this->info('Current users in database:');
        $allUsers = User::all(['id', 'name', 'username', 'role', 'email']);
        foreach ($allUsers as $user) {
            $this->line("  - {$user->username} ({$user->role}) - {$user->name}");
        }
    }
}
