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
        Schema::create('laporan_berkalas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perguruan_tinggi_id')->constrained('perguruan_tinggis');
            $table->string('judul_laporan');
            $table->enum('jenis_laporan', ['bulanan', 'semesteran', 'tahunan', 'khusus']);
            $table->enum('periode', ['ganjil', 'genap', 'tahunan']);
            $table->year('tahun_akademik');
            $table->json('data_laporan'); // Ringkasan data dalam JSON
            $table->string('file_laporan')->nullable(); // Path file PDF
            $table->enum('status', ['draft', 'review', 'final']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_berkalas');
    }
};
