# Session Database Setup - Dokumentasi

## 📊 Overview
Aplikasi Absensi Sekolah menggunakan **Database Session Driver** untuk menyimpan session user dengan matang dan reliable.

## 🏗️ Setup yang Sudah Dilakukan

### 1. **Environment Variables** (`.env`)
```ini
SESSION_DRIVER=database           # Menggunakan database untuk session
SESSION_LIFETIME=120               # Session expire setelah 120 menit (2 jam)
SESSION_EXPIRE_ON_CLOSE=false      # Session tidak expire saat browser ditutup
SESSION_ENCRYPT=false              # Session data tidak dienkripsi (optional)
SESSION_TABLE=sessions             # Nama table untuk session storage
```

### 2. **Database Table** (`sessions`)
- **Migration**: `0001_01_01_000003_create_sessions_table` ✓ Sudah Run
- **Columns**:
  - `id` (string, primary key)
  - `user_id` (nullable, for user logging)
  - `ip_address` (nullable, for security)
  - `user_agent` (nullable, for device tracking)
  - `payload` (longText, session data)
  - `last_activity` (timestamp, untuk cleanup)

### 3. **Session Cleanup Scheduler** (`app/Console/Kernel.php`)
- Prune stale sessions setiap jam (hourly)
- Otomatis menghapus session yang expire
- Production-ready dengan logging

### 4. **Session Management Command**
```bash
# Lihat statistik session
php artisan session:manage --stats

# Cleanup manual (optional)
php artisan session:manage --clean
```

## ✅ Verification

### Status Database Connection
```bash
php artisan tinker
> DB::table('sessions')->count()
# Output: jumlah active sessions
```

### Test Login dengan Database Session
1. Clear existing sessions: `php artisan session:manage --clean`
2. Login sebagai siswa
3. Check session: `php artisan session:manage --stats`
4. Session harus tercatat di database dengan user_id, ip_address, etc.

## 🔍 Monitoring Session Database

### Command yang Tersedia
```bash
# View session stats
php artisan session:manage --stats

# Manual cleanup
php artisan session:manage --clean

# View session table directly
php artisan tinker
> DB::table('sessions')->get(['id', 'user_id', 'ip_address', 'last_activity'])
```

### Log Session Activity
- Location: `storage/logs/laravel.log`
- Contains: user login, session creation, activity tracking
- Used for debugging authentication issues

## 🚀 Production Checklist

- ✅ Sessions table created & migrated
- ✅ Database connection configured
- ✅ Session cleanup scheduler setup
- ✅ Session middleware registered
- ✅ Activity logging configured
- ✅ Commands untuk monitoring ready

### Additional Setup untuk Production
```bash
# Setup scheduler di cron
# Add to server crontab:
* * * * * cd /path/to/app && php artisan schedule:run >> /dev/null 2>&1

# Or use Laravel Horizon for queue management:
composer require laravel/horizon
php artisan horizon:install
```

## 📝 Configuration Files Modified

1. **`.env`** - Session driver settings
2. **`config/session.php`** - Session configuration (default, already good)
3. **`app/Console/Kernel.php`** - Scheduler for cleanup
4. **`app/Console/Commands/SessionManage.php`** - Management command
5. **`app/Http/Middleware/LogSessionActivity.php`** - Activity logging

## 🔒 Security Considerations

- ✅ Session lifetime: 120 menit (dapat disesuaikan)
- ✅ Database stored (tidak di file, lebih aman)
- ✅ Auto cleanup untuk stale sessions
- ✅ IP tracking untuk session validation (optional)
- ⚠️ Untuk production HTTPS: set SESSION_SECURE_COOKIES=true

## ❌ Troubleshooting

### Issue: Session tidak tersimpan
```bash
# Check database connection
php artisan tinker
> DB::connection()->getPdo()

# Check migrations
php artisan migrate:status

# Verify config
php artisan config:show session
```

### Issue: Sessions tidak ter-cleanup
```bash
# Check scheduler running
ps aux | grep schedule:run

# Manual cleanup
php artisan session:manage --clean

# Check logs
tail -f storage/logs/laravel.log | grep -i session
```

### Issue: Session permission denied
```bash
# Check database user permissions
# User harus punya SELECT, INSERT, UPDATE, DELETE di sessions table

# In MySQL:
GRANT SELECT, INSERT, UPDATE, DELETE ON absensi_sekolah.sessions TO 'root'@'localhost';
FLUSH PRIVILEGES;
```

## 📚 Resources

- [Laravel Session Documentation](https://laravel.com/docs/11.x/session)
- [Laravel Task Scheduling](https://laravel.com/docs/11.x/scheduling)
- [Database Sessions](https://laravel.com/docs/11.x/session#database-sessions)

---

**Last Updated**: 2026-03-26
**Status**: ✅ Production Ready
