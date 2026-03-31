<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SessionManage extends Command
{
    protected $signature = 'session:manage {--clean} {--stats}';

    protected $description = 'Manage database sessions - cleanup or show statistics';

    public function handle(): void
    {
        if ($this->option('clean')) {
            $this->cleanStaleSessions();
        } elseif ($this->option('stats')) {
            $this->showSessionStats();
        } else {
            $this->showSessionStats();
        }
    }

    private function cleanStaleSessions(): void
    {
        $this->info('🧹 Cleaning stale sessions...');

        $sessionLifetime = config('session.lifetime', 120);
        $expiresAt = now()->subMinutes($sessionLifetime);

        $deleted = DB::table('sessions')
            ->where('last_activity', '<', $expiresAt->timestamp)
            ->delete();

        $this->info("✓ Deleted {$deleted} stale session(s)");
        $this->info("Session lifetime: {$sessionLifetime} minutes");
    }

    private function showSessionStats(): void
    {
        $this->info('📊 Session Database Statistics:');
        $this->line('');

        // Total sessions
        $total = DB::table('sessions')->count();
        $this->line("Total sessions in database: {$total}");

        // Active sessions (last 24 hours)
        $active = DB::table('sessions')
            ->where('last_activity', '>', now()->subDay()->timestamp)
            ->count();
        $this->line("Active sessions (last 24h): {$active}");

        // Stale sessions
        $sessionLifetime = config('session.lifetime', 120);
        $expiresAt = now()->subMinutes($sessionLifetime);
        $stale = DB::table('sessions')
            ->where('last_activity', '<', $expiresAt->timestamp)
            ->count();
        $this->line("Stale sessions (to be cleaned): {$stale}");

        $this->line('');

        // Show last activities
        $this->info('📋 Last 5 sessions:');
        $sessions = DB::table('sessions')
            ->orderBy('last_activity', 'desc')
            ->limit(5)
            ->get(['id', 'user_id', 'ip_address', 'last_activity']);

        foreach ($sessions as $session) {
            $lastActivity = Carbon::createFromTimestamp($session->last_activity)
                ->format('Y-m-d H:i:s');
            $userId = $session->user_id ?? 'guest';
            $this->line("  • User: {$userId} | IP: {$session->ip_address} | Last: {$lastActivity}");
        }
    }
}
