<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('name');
            // Dipakai bersama nomor pendaftaran saat cek status, agar data tidak bisa dilihat orang lain.
            $table->date('birth_date');
            $table->string('school_origin')->nullable();
            $table->string('phone', 20)->nullable();
            $table->foreignId('major_id')->nullable()->constrained()->nullOnDelete();
            $table->string('pathway')->nullable();
            $table->string('status')->default('menunggu');
            // Catatan panitia yang ikut tampil di halaman cek status.
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
