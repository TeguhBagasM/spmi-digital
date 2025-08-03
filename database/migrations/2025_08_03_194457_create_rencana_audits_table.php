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
        Schema::create('rencana_audits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perguruan_tinggi_id')->constrained('perguruan_tinggis');
            $table->string('nama_rencana');
            $table->year('tahun_akademik');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('jenis_audit', ['internal', 'eksternal', 'surveillance']);
            $table->json('ruang_lingkup'); // Program studi yang diaudit
            $table->text('tujuan_audit');
            $table->enum('status', ['perencanaan', 'berlangsung', 'selesai', 'dibatalkan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_audits');
    }
};
