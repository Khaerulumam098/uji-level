<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Auth Routes (tidak butuh login)
|--------------------------------------------------------------------------
*/

// Halaman pemilihan role — selalu ditampilkan untuk tamu
Route::get('/', [AuthController::class, 'roleSelect'])->name('role.select');

// Halaman login universal (?role=admin|guru|siswa|orangtua)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

// Proses login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| SIMPLE TEST - remove after working
|--------------------------------------------------------------------------
*/
Route::get('/test-login', function () {
    return <<<'HTML'
<!DOCTYPE html>
<html>
<body>
<form method="POST" action="/login">
    @csrf
    <input type="hidden" name="username" value="siswa_andi">
    <input type="hidden" name="password" value="password">
    <input type="hidden" name="role" value="siswa">
    <button>Test Login as Siswa</button>
</form>
</body>
</html>
HTML;
});

Route::get('/test-auth', function () {
    return response()->json([
        'authenticated' => \Illuminate\Support\Facades\Auth::check(),
        'user' => \Illuminate\Support\Facades\Auth::user() ? [
            'id' => \Illuminate\Support\Facades\Auth::user()->id,
            'username' => \Illuminate\Support\Facades\Auth::user()->username,
            'role' => \Illuminate\Support\Facades\Auth::user()->role,
        ] : null,
        'session_id' => session()->getId(),
    ]);
});


/*
|--------------------------------------------------------------------------
| DEBUG: Manual Login Test
|--------------------------------------------------------------------------
*/
Route::get('/test-manual-login', function () {
    // Manual login
    $user = App\Models\User::find(3); // siswa_andi
    \Illuminate\Support\Facades\Auth::login($user, false);

    return response()->json([
        'message' => 'Logged in user ID 3 (siswa_andi)',
        'auth_check_now' => \Illuminate\Support\Facades\Auth::check(),
        'user_now' => \Illuminate\Support\Facades\Auth::user() ? \Illuminate\Support\Facades\Auth::user()->username : 'none',
        'session_id' => session()->getId(),
    ]);
});

Route::get('/test-redirect', function () {
    $user = App\Models\User::find(3); // siswa_andi
    \Illuminate\Support\Facades\Auth::login($user, false);

    // Log what's happening
    \Illuminate\Support\Facades\Log::info('TEST REDIRECT', [
        'user_id' => $user->id,
        'role' => $user->role,
        'auth_check' => \Illuminate\Support\Facades\Auth::check(),
        'session_id' => session()->getId(),
    ]);

    return redirect()->route('siswa.home');
});


/*
|--------------------------------------------------------------------------
| Protected Routes — Siswa
|--------------------------------------------------------------------------
*/
Route::prefix('siswa')->name('siswa.')->middleware(['session.auth', 'role:siswa'])->group(function () {
    Route::get('/home',    fn() => view('siswa.home'))->name('home');
    Route::get('/absen',   fn() => view('siswa.absen'))->name('absen');
    Route::get('/riwayat', fn() => view('siswa.riwayat'))->name('riwayat');
});


/*
|--------------------------------------------------------------------------
| Protected Routes — Guru
|--------------------------------------------------------------------------
*/
Route::prefix('guru')->name('guru.')->middleware(['session.auth', 'role:guru'])->group(function () {
    Route::get('/home',    fn() => view('guru.home'))->name('home');

    // Jadwal routes
    Route::get('/jadwal',  fn() => view('guru.jadwal'))->name('jadwal');
    Route::post('/jadwal', fn() => response()->json(['message' => 'Jadwal saved']))->name('jadwal.store');
    Route::put('/jadwal/{id}', fn() => response()->json(['message' => 'Jadwal updated']))->name('jadwal.update');
    Route::delete('/jadwal/{id}', fn() => response()->json(['message' => 'Jadwal deleted']))->name('jadwal.delete');

    // Absensi routes
    Route::get('/absensi', fn() => view('guru.absensi'))->name('absensi');
    Route::post('/absensi', fn() => response()->json(['message' => 'Absensi saved']))->name('absensi.store');
    Route::put('/absensi/{id}', fn() => response()->json(['message' => 'Absensi updated']))->name('absensi.update');

    // Rekap routes
    Route::get('/rekap',   fn() => view('guru.rekap'))->name('rekap');
    Route::put('/rekap/{id}', fn() => response()->json(['message' => 'Rekap updated']))->name('rekap.update');
});


/*
|--------------------------------------------------------------------------
| Protected Routes — Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['session.auth', 'role:admin'])->group(function () {
    Route::get('/', fn() => view('admin.home'))->name('home');
    Route::get('/data-siswa', fn() => view('admin.data-siswa'))->name('data-siswa');
    Route::get('/data-kelas', fn() => view('admin.data-kelas'))->name('data-kelas');
    Route::get('/data-guru', fn() => view('admin.data-guru'))->name('data-guru');
    Route::get('/data-jadwal', fn() => view('admin.data-jadwal'))->name('data-jadwal');
    Route::get('/manajemen-pengguna', fn() => view('admin.manajemen-pengguna'))->name('manajemen-pengguna');
});


/*
|--------------------------------------------------------------------------
| Protected Routes — Orang Tua
|--------------------------------------------------------------------------
*/
Route::prefix('orang-tua')->name('orang-tua.')->middleware(['session.auth', 'role:orangtua'])->group(function () {
    Route::get('/home', fn() => view('orang-tua.home'))->name('home');
    Route::get('/absensi-harian', fn() => view('orang-tua.absensi-harian'))->name('absensi-harian');
    Route::get('/absensi-bulanan', fn() => view('orang-tua.absensi-bulanan'))->name('absensi-bulanan');
});

/*
|--------------------------------------------------------------------------
| DEBUG Routes (TEMPORARY)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/debug.php';
