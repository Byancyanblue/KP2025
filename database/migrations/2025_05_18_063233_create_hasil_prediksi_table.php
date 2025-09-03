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
        Schema::create('hasil_prediksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pasien_id'); // relasi ke pasien_input
            $table->text('risk_prediction')->nullable();
            $table->text('clinical_explanation')->nullable();
            $table->text('risk_analysis')->nullable();
            $table->text('medical_suggestion')->nullable();
            $table->text('disclaimer')->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('pasien_id')->references('id')->on('pasien_input')->onDelete('cascade');
                
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_prediksi');
    }
};
