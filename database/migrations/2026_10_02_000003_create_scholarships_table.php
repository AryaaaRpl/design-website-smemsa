<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Skema beasiswa di halaman SPMB (tabel Skema Beasiswa & Keringanan Biaya).
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tag')->nullable();
            $table->string('tag_color', 10)->default('blue');
            $table->text('description');
            $table->string('period');
            $table->string('amount');
            $table->string('tone', 10)->default('nominal');
            $table->boolean('is_published')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
