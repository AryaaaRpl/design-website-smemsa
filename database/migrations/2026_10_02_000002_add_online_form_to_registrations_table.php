<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Isian fase pendaftaran online: Data Diri, Formulir (orang tua, wali, alamat) & Unggah Berkas.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Data diri (nama, tanggal lahir, NIK & HP sudah ada).
            $table->string('gender', 20)->nullable();
            $table->string('birth_place', 100)->nullable();
            $table->string('religion', 30)->nullable();
            $table->string('nisn', 10)->nullable();
            $table->string('kk_number', 16)->nullable();
            $table->string('shirt_size', 5)->nullable();

            // Formulir (nama SMP/MTs memakai kolom school_origin).
            foreach (['father', 'mother'] as $parent) {
                $table->string("{$parent}_name", 100)->nullable();
                $table->string("{$parent}_status", 30)->nullable();
                $table->string("{$parent}_job", 100)->nullable();
                $table->string("{$parent}_phone", 20)->nullable();
            }
            $table->string('guardian_name', 100)->nullable();
            $table->string('guardian_job', 100)->nullable();
            $table->string('guardian_phone', 20)->nullable();
            $table->string('guardian_relation', 30)->nullable();
            $table->string('residence_status', 30)->nullable();
            $table->text('address')->nullable();

            // Waktu pendaftar menekan "Kirim Pendaftaran"; setelah itu data dikunci.
            $table->timestamp('submitted_at')->nullable();
        });

        Schema::create('registration_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->string('type', 30);
            $table->string('path');
            $table->string('original_name');
            $table->timestamps();

            $table->unique(['registration_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registration_documents');

        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'gender', 'birth_place', 'religion', 'nisn', 'kk_number', 'shirt_size',
                'father_name', 'father_status', 'father_job', 'father_phone',
                'mother_name', 'mother_status', 'mother_job', 'mother_phone',
                'guardian_name', 'guardian_job', 'guardian_phone', 'guardian_relation',
                'residence_status', 'address', 'submitted_at',
            ]);
        });
    }
};
