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
        Schema::create('temuan_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rencana_audit_id')->constrained('rencana_audits');
            $table->foreignId('program_studi_id')->nullable()->constrained('program_studis');
            $table->foreignId('auditor_id')->constrained('penggunas');
            $table->string('kode_temuan');
            $table->text('deskripsi_temuan');
            $table->enum('kategori', ['mayor', 'minor', 'observasi', 'kekuatan']);
            $table->text('bukti_audit');
            $table->text('rekomendasi');
            $table->enum('status', ['terbuka', 'proses', 'tertutup', 'ditolak']);
            $table->date('target_penyelesaian');
            $table->date('tanggal_audit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temuan_audits');
    }
};
