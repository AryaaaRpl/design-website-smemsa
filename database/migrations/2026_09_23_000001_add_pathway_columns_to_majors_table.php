<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Kolom tambahan untuk panel "Alur Pendidikan" di halaman beranda.
     */
    public function up(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->renameColumn('image', 'logo');
        });

        Schema::table('majors', function (Blueprint $table) {
            $table->dropColumn('short_description');

            $table->string('student_photo')->nullable()->after('logo');
            $table->string('tefa_name')->nullable()->after('description');
            $table->string('certification_summary')->nullable()->after('tefa_name');
            $table->json('competencies')->nullable()->after('certification_summary');
            $table->json('practice_items')->nullable()->after('competencies');
            $table->string('practice_note')->nullable()->after('practice_items');
            $table->json('certification_items')->nullable()->after('practice_note');
            $table->string('certification_note')->nullable()->after('certification_items');
            $table->json('career_items')->nullable()->after('certification_note');
            $table->string('career_note')->nullable()->after('career_items');
        });
    }

    public function down(): void
    {
        Schema::table('majors', function (Blueprint $table) {
            $table->dropColumn([
                'student_photo',
                'tefa_name',
                'certification_summary',
                'competencies',
                'practice_items',
                'practice_note',
                'certification_items',
                'certification_note',
                'career_items',
                'career_note',
            ]);

            $table->string('short_description', 500)->nullable();
            $table->renameColumn('logo', 'image');
        });
    }
};
