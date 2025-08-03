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
        Schema::create('tim_auditors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rencana_audit_id')->constrained('rencana_audits');
            $table->foreignId('auditor_id')->constrained('penggunas');
            $table->enum('peran_audit', ['ketua', 'anggota', 'observer']);
            $table->json('area_audit'); // Area yang menjadi tanggung jawab
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tim_auditors');
    }
};
