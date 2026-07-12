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
    Schema::create('klaster_kmeans', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ID dengan tabel logistik_tambangs
        $table->foreignId('logistik_tambang_id')->constrained('logistik_tambangs')->onDelete('cascade');
        $table->string('label_klaster'); // Contoh: Fast Moving, Medium Moving, Slow Moving
        $table->float('velocity_score');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klaster_kmeans');
    }
};
