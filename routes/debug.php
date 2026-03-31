<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

// DEBUG ONLY - HAPUS SETELAH SELESAI

// Test login dengan detailed debug
Route::post('/debug/test-login', function () {
    $username = request()->input('username', 'siswa_andi');
    $password = request()->input('password', 'password');
    $role = request()->input('role', 'Siswa');

    Log::info('Debug: Test login started', [
        'username' => $username,
        'role' => $role,
    ]);

    // Find user
    $user = User::where('username', $username)->first();
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Check password
    if (!\Illuminate\Support\Facades\Hash::check($password, $user->password)) {
        return response()->json(['error' => 'Wrong password'], 401);
    }

    // Check role
    if ($user->role !== $role) {
        return response()->json(['error' => 'Role mismatch'], 403);
    }

    // Get session before login
    $sessionBefore = request()->getSession()->getId();
    Log::info('Debug: Session before login', ['session_id' => substr($sessionBefore, 0, 20) . '...']);

    // Login
    Auth::login($user, request()->boolean('remember'));

    // Regenerate session
    request()->session()->regenerate();

    // Flush to database
    request()->session()->save();

    // Get session after login
    $sessionAfter = request()->getSession()->getId();
    Log::info('Debug: Session after login', ['session_id' => substr($sessionAfter, 0, 20) . '...']);

    // Check database immediately
    $dbSession = DB::table('sessions')
        ->where('id', $sessionAfter)
        ->first(['id', 'user_id', 'last_activity']);

    Log::info('Debug: Session in database', [
        'found' => $dbSession ? true : false,
        'user_id' => $dbSession?->user_id,
    ]);

    // Check if authenticated
    $authCheck = Auth::check();
    Log::info('Debug: Auth check after login', ['authenticated' => $authCheck]);

    return response()->json([
        'status' => 'success',
        'user_id' => $user->id,
        'username' => $user->username,
        'role' => $user->role,
        'session_before' => substr($sessionBefore, 0, 20) . '...',
        'session_after' => substr($sessionAfter, 0, 20) . '...',
        'session_in_db' => $dbSession ? true : false,
        'db_user_id' => $dbSession?->user_id,
        'authenticated_check' => $authCheck,
        'redirect_to' => route($user->role . '.home'),
    ]);
});

Route::get('/debug/test-login-form', function () {
    return view('test-login');
});

Route::get('/debug/users', function () {
    $users = User::all(['id', 'name', 'username', 'role', 'email']);
    return response()->json([
        'total' => $users->count(),
        'users' => $users
    ]);
});

Route::get('/debug/test-user', function () {
    $user = User::where('username', 'siswa_andi')->first();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'username' => $user->username,
        'role' => $user->role,
        'email' => $user->email,
        'nis' => $user->nis,
        'kelas' => $user->kelas,
    ]);
});

Route::get('/debug/auth-status', function () {
    return response()->json([
        'authenticated' => Auth::check(),
        'user' => Auth::user() ? [
            'id' => Auth::user()->id,
            'name' => Auth::user()->name,
            'username' => Auth::user()->username,
            'role' => Auth::user()->role,
        ] : null,
        'session_id' => Session::getId(),
        'session_driver' => config('session.driver'),
        'guard' => Auth::getDefaultDriver(),
    ]);
});

Route::get('/debug/session-stats', function () {
    $total = DB::table('sessions')->count();
    $active = DB::table('sessions')
        ->where('last_activity', '>', now()->subDay()->timestamp)
        ->count();

    $sessions = DB::table('sessions')
        ->orderBy('last_activity', 'desc')
        ->limit(10)
        ->get(['id', 'user_id', 'ip_address', 'last_activity']);

    return response()->json([
        'total_sessions' => $total,
        'active_sessions' => $active,
        'session_driver' => config('session.driver'),
        'session_lifetime' => config('session.lifetime'),
        'recent_sessions' => $sessions->map(function ($s) {
            return [
                'id' => substr($s->id, 0, 20) . '...',
                'user_id' => $s->user_id,
                'ip_address' => $s->ip_address,
                'last_activity' => \Carbon\Carbon::createFromTimestamp($s->last_activity)->format('Y-m-d H:i:s'),
            ];
        })->values(),
    ]);
});

// Comprehensive login flow test
Route::post('/debug/test-login-detailed', function () {
    $username = request()->input('username', 'siswa_andi');
    $password = request()->input('password', 'password');
    $role = request()->input('role', 'Siswa');

    $steps = [
        'step_1_find_user' => [],
        'step_2_password_check' => [],
        'step_3_role_check' => [],
        'step_4_before_auth_login' => [],
        'step_5_after_auth_login' => [],
        'step_6_after_session_save' => [],
        'step_7_database_check' => [],
    ];

    // STEP 1: Find user
    $user = User::where('username', $username)->first();
    $steps['step_1_find_user'] = [
        'user_found' => $user ? true : false,
        'user_id' => $user?->id,
        'user_role' => $user?->role,
    ];

    if (!$user) {
        return response()->json([
            'success' => false,
            'error' => 'User not found',
            'steps' => $steps,
        ]);
    }

    // STEP 2: Check password
    $passwordCorrect = \Illuminate\Support\Facades\Hash::check($password, $user->password);
    $steps['step_2_password_check'] = [
        'password_match' => $passwordCorrect,
    ];

    if (!$passwordCorrect) {
        return response()->json([
            'success' => false,
            'error' => 'Password incorrect',
            'steps' => $steps,
        ]);
    }

    // STEP 3: Check role
    $roleMatch = $user->role === $role;
    $steps['step_3_role_check'] = [
        'role_match' => $roleMatch,
        'expected_role' => $role,
        'user_role' => $user->role,
    ];

    if (!$roleMatch) {
        return response()->json([
            'success' => false,
            'error' => 'Role mismatch',
            'steps' => $steps,
        ]);
    }

    // STEP 4: Before Auth::login()
    $steps['step_4_before_auth_login'] = [
        'auth_check' => Auth::check(),
        'session_id' => request()->getSession()->getId(),
        'session_in_db' => DB::table('sessions')->where('id', request()->getSession()->getId())->exists(),
    ];

    // STEP 5: Call Auth::login()
    Auth::login($user, false);
    $steps['step_5_after_auth_login'] = [
        'auth_check' => Auth::check(),
        'auth_id' => Auth::check() ? Auth::user()->id : null,
        'session_id' => request()->getSession()->getId(),
    ];

    // STEP 6: Save session to database
    request()->session()->save();
    $steps['step_6_after_session_save'] = [
        'auth_check' => Auth::check(),
        'session_id' => request()->getSession()->getId(),
    ];

    // STEP 7: Verify in database
    $dbSession = DB::table('sessions')
        ->where('id', request()->getSession()->getId())
        ->first(['id', 'user_id', 'last_activity', 'payload']);

    $steps['step_7_database_check'] = [
        'session_found' => $dbSession ? true : false,
        'db_user_id' => $dbSession?->user_id,
        'payload_size' => $dbSession ? strlen($dbSession->payload) : 0,
        'payload_contains_auth' => $dbSession ? (strpos($dbSession->payload, 'auth') !== false ? true : false) : false,
    ];

    return response()->json([
        'success' => true,
        'message' => 'Login test completed successfully - ready to redirect',
        'redirect_to' => route($user->role . '.home'),
        'user' => [
            'id' => $user->id,
            'username' => $user->username,
            'role' => $user->role,
        ],
        'steps' => $steps,
    ]);
});
