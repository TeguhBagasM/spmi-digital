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
        Schema::create('standar_mutus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perguruan_tinggi_id')->constrained('perguruan_tinggis');
            $table->string('kode_standar');
            $table->string('nama_standar');
            $table->text('deskripsi');
            $table->enum('kategori', ['pendidikan', 'penelitian', 'pengabdian', 'tata_kelola']);
            $table->json('indikator_kinerja'); // Array indikator dalam JSON
            $table->enum('status', ['draft', 'aktif', 'revisi', 'non_aktif']);
            $table->date('tanggal_berlaku');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standar_mutus');
    }
};
