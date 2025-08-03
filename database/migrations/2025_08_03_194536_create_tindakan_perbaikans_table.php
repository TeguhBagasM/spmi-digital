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
        Schema::create('tindakan_perbaikans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('temuan_audit_id')->constrained('temuan_audits');
            $table->text('rencana_tindakan');
            $table->text('analisis_akar_masalah');
            $table->foreignId('penanggung_jawab_id')->constrained('penggunas');
            $table->date('tanggal_target');
            $table->date('tanggal_selesai_aktual')->nullable();
            $table->text('bukti_penyelesaian')->nullable();
            $table->text('catatan')->nullable();
            $table->enum('status', ['direncanakan', 'proses', 'selesai', 'diverifikasi', 'ditolak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tindakan_perbaikans');
    }
};
