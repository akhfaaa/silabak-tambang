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
        Schema::create('transaksi_logistiks', function (Blueprint $table) {
        $table->id();
        // Relasi ke tabel logistik utama
        $table->foreignId('logistik_tambang_id')->constrained('logistik_tambangs')->onDelete('cascade');
        
        // Penanda apakah ini barang Masuk (Inbound) atau Keluar (Outbound)
        $table->string('jenis_transaksi'); 
        
        $table->integer('kuantitas');
        $table->date('tanggal_transaksi');
        $table->string('keterangan')->nullable(); // Keterangan opsional (misal: "Dipakai untuk Unit HD785-01")
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_logistiks');
    }
};
