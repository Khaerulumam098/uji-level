<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'guru', 'siswa', 'orangtua']);

            // Relasi opsional: siswa / guru punya data tambahan
            $table->string('nis')->nullable()->unique()->comment('Nomor Induk Siswa');
            $table->string('nip')->nullable()->unique()->comment('Nomor Induk Pegawai (guru)');
            $table->string('kelas')->nullable()->comment('Kelas siswa, mis. X IPA 1');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
