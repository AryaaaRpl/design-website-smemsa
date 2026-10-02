<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Akun pendaftar SPMB online (terpisah dari akun admin di tabel users).
 * Satu akun punya satu data pendaftaran (registrations.applicant_id).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::table('registrations', function (Blueprint $table) {
            $table->foreignId('applicant_id')->nullable()->unique()->after('id')->constrained()->nullOnDelete();
            $table->string('nik', 16)->nullable()->unique()->after('birth_date');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('applicant_id');
            $table->dropUnique(['nik']);
            $table->dropColumn('nik');
        });

        Schema::dropIfExists('applicants');
    }
};
