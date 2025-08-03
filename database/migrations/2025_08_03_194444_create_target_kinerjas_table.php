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
        Schema::create('target_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('standar_mutu_id')->constrained('standar_mutus');
            $table->foreignId('program_studi_id')->constrained('program_studis');
            $table->string('nama_indikator');
            $table->decimal('nilai_target', 8, 2);
            $table->string('satuan'); // %, jumlah, rasio, dll
            $table->enum('semester', ['ganjil', 'genap', 'tahunan']);
            $table->year('tahun_akademik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('target_kinerjas');
    }
};
