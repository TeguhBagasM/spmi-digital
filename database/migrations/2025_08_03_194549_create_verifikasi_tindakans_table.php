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
        Schema::create('verifikasi_tindakans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tindakan_perbaikan_id')->constrained('tindakan_perbaikans');
            $table->foreignId('verifikator_id')->constrained('penggunas');
            $table->enum('hasil_verifikasi', ['diterima', 'ditolak', 'perlu_perbaikan']);
            $table->text('catatan_verifikasi');
            $table->date('tanggal_verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_tindakans');
    }
};
