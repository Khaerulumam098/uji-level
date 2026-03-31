<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Create test user
        $this->user = User::create([
            'name' => 'Andi Siswa',
            'username' => 'siswa_andi',
            'email' => 'siswa@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'Siswa',
            'nis' => '001',
            'kelas' => 'VII-A',
        ]);
    }

    public function test_login_redirects_to_siswa_home()
    {
        $response = $this->post('/login', [
            'username' => 'siswa_andi',
            'password' => 'password',
            'role' => 'Siswa',
        ]);

        $response->assertRedirect(route('siswa.home'));
        $this->assertAuthenticated();
        $this->assertEquals($this->user->id, auth()->user()->id);
    }

    public function test_login_creates_session_in_database()
    {
        $this->post('/login', [
            'username' => 'siswa_andi',
            'password' => 'password',
            'role' => 'Siswa',
        ]);

        // Check if session exists in database
        $sessionCount = \Illuminate\Support\Facades\DB::table('sessions')
            ->where('user_id', $this->user->id)
            ->count();

        $this->assertGreaterThan(0, $sessionCount, 'Session should be created in database');
    }

    public function test_can_access_protected_route_after_login()
    {
        $this->post('/login', [
            'username' => 'siswa_andi',
            'password' => 'password',
            'role' => 'Siswa',
        ]);

        // Try to access protected route
        $response = $this->get(route('siswa.home'));
        $response->assertSuccessful();
    }
}
