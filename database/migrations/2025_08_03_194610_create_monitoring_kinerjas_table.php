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
        Schema::create('monitoring_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_studi_id')->constrained('program_studi');
            $table->foreignId('target_kinerja_id')->constrained('target_kinerja');
            $table->decimal('nilai_aktual', 8, 2);
            $table->date('tanggal_pengukuran');
            $table->enum('semester', ['ganjil', 'genap']);
            $table->year('tahun_akademik');
            $table->text('analisis')->nullable();
            $table->enum('status_pencapaian', ['tercapai', 'tidak_tercapai', 'melampaui']);
            $table->text('rencana_tindak_lanjut')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitoring_kinerjas');
    }
};
