<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('akun_rental', function (Blueprint $table) {
            $table->string('email')->unique()->nullable()->after('nama');
            $table->string('password')->nullable()->after('email');
            $table->enum('role', ['owner', 'pelanggan'])->default('pelanggan')->after('alamat');
        });
    }

    public function down(): void
    {
        Schema::table('akun_rental', function (Blueprint $table) {
            $table->dropColumn(['email', 'password', 'role']);
        });
    }
};