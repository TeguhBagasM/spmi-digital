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
        Schema::create('program_studis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perguruan_tinggi_id')->constrained('perguruan_tinggis');
            $table->string('nama');
            $table->string('kode')->unique();
            $table->enum('jenjang', ['diploma', 'sarjana', 'magister', 'doktor']);
            $table->string('kaprodi');
            $table->string('status_akreditasi')->nullable();
            $table->date('tanggal_akreditasi')->nullable();
            $table->integer('jumlah_mahasiswa')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_studis');
    }
};
