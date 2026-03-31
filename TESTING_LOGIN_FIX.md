# Login Redirect Fix - Testing Guide

## Status: Implementation Complete ✅

All code changes have been implemented to fix the login redirect issue with database sessions. Follow these steps to test:

## Quick Test Steps

### 1. Clear Cache
```bash
php artisan config:clear && php artisan cache:clear && php artisan route:clear
```

### 2. Start Server
```bash
php artisan serve --port=8000
```

### 3. Test Login Flow

**Via Browser:**
1. Go to `http://localhost:8000/`
2. Click "Siswa" (Student) card
3. Enter credentials:
   - Username: `siswa_andi`
   - Password: `password`
4. Click Login
5. **Expected Result:** Should redirect to `/siswa/home` ✓

**Via Debug Endpoint (Postman/cURL):**
```bash
curl -X POST http://localhost:8000/debug/test-login-detailed \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "username=siswa_andi&password=password&role=siswa"
```

This endpoint will:
- Perform each step of the login process
- Check if session is created in database
- Return JSON showing exactly where it succeeds/fails
- Show if Auth::check() returns true

### 4. Verify Session in Database

After successful login, check sessions table:

```bash
php artisan tinker
» DB::table('sessions')->where('user_id', 3)->latest('last_activity')->first();
```

Should show:
- `id`: session ID
- `user_id`: 3 (siswa_andi's ID)
- `payload`: contains session data (encrypted)
- `last_activity`: recent timestamp

Or use command:
```bash
php artisan session:manage --stats
```

Should show 1 active session with user_id=3

### 5. Test Protected Route Access

If login succeeds:
```bash
curl -b "XSRF-TOKEN=cookie; laravel-session=sessionID" http://localhost:8000/siswa/home
```

Should return the siswa home page (not redirect to role-select)

## What Was Fixed

### Changes Made to `app/Http/Controllers/AuthController.php`:

1. **Session Initialization**: `$request->session()->start()` before Auth::login()
2. **Explicit Session Save**: `$request->session()->save()` after Auth::login() to flush to database
3. **Comprehensive Logging**: Each step logged for debugging

### Key Configuration:
- `.env`: `SESSION_DRIVER=database`, `APP_URL=http://localhost:8000`
- `config/session.php`: Database driver configured
- `routes/web.php`: Routes protected with `['auth', 'role:siswa']` middleware
- Database: Sessions table created with proper schema

## Debug Endpoints Available

All debug endpoints are at `/debug/*`:

- `GET /debug/auth-status` - Check current authentication status
- `GET /debug/session-stats` - View session database statistics
- `GET /debug/users` - List all users in database
- `GET /debug/test-user` - Get specific test user details
- `POST /debug/test-login` - Simulate login (returns basic result)
- `POST /debug/test-login-detailed` - Detailed login flow breakdown

## If Still Not Working

### Check Logs:
```bash
tail -100 storage/logs/laravel.log
```

Look for:
- "Login attempt started" - form was submitted
- "User berhasil login" - authentication succeeded
- Any error messages about sessions or database

### Common Issues:

1. **Session table doesn't exist**: Run migrations
   ```bash
   php artisan migrate
   ```

2. **Wrong database**: Check `.env` DATABASE_URL

3. **Driver still set to 'file'**: Confirm `.env` has `SESSION_DRIVER=database`

4. **Port 8000 in use**: Use different port with `php artisan serve --port=8001`

## Test Credentials

All users have password: `password`

| Username      | Role    | ID  |
|--------------|---------|-----|
| siswa_andi    | Siswa   | 3   |
| guru_budi     | Guru    | 2   |
| admin         | Admin   | 1   |
| ortu_siti     | Orangtua| 4   |

## Expected Behavior After Fix

1. ✓ Login form submits successfully
2. ✓ Session created in database within `sessions` table
3. ✓ Redirect to `/siswa/home` (not back to role-select)
4. ✓ Can access protected siswa pages (home, absen, riwayat)
5. ✓ Logout clears session and redirects to role-select

## Files Modified

1. `app/Http/Controllers/AuthController.php` - Login method updated
2. `routes/debug.php` - Added detailed login test endpoint
3. `app/Http/Middleware/DebugSessionMiddleware.php` - Created for debugging
4. `bootstrap/app.php` - Registered debug middleware

## Next Steps If Successful

After confirming login works:
- [ ] Test all four roles (Admin, Guru, Siswa, Orangtua)
- [ ] Test logout functionality
- [ ] Test session expiration (120 minutes)
- [ ] Test browser back button after login
- [ ] Remove debug routes from production
- [ ] Monitor `storage/logs/laravel.log` for issues
