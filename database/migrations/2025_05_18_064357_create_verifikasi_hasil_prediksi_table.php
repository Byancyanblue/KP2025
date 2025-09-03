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
        Schema::create('verifikasi_hasil_prediksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hasil_prediksi_id'); // relasi ke hasil_prediksi
            $table->string('nama'); // Nama verifikator atau pasien
            $table->text('catatan')->nullable(); // Catatan tambahan
            $table->string('gambar_path')->nullable(); // Path file gambar di storage/public
            $table->timestamps();

            $table->foreign('hasil_prediksi_id')->references('id')->on('hasil_prediksi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_hasil_prediksi');
    }
};
