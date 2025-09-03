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
        Schema::create('pasien_input', function (Blueprint $table) {
            $table->id();
            $table->string('id_pasien');
            $table->string('nama');
            $table->integer('umur'); //ini string woi
            $table->enum('jk', ['L', 'P']);

            $table->decimal('blood_pressure', 5, 2);
            $table->decimal('cholesterol_level', 5, 2);
            $table->decimal('bmi', 5, 2);
            $table->decimal('triglyceride_level', 5, 2);
            $table->decimal('fasting_blood_sugar', 5, 2);
            $table->decimal('crp_level', 5, 2);
            $table->decimal('homocysteine_level', 5, 2);

            $table->enum('low_hdl', ['Yes', 'No']);
            $table->enum('high_ldl', ['Yes', 'No']);
            $table->enum('high_blood_pressure', ['Yes', 'No']);
            $table->enum('smoking', ['Yes', 'No']);
            $table->enum('family_heart_disease', ['Yes', 'No']);
            $table->enum('diabetes', ['Yes', 'No']);

            $table->enum('exercise_habits', ['Low', 'Medium', 'High']);
            $table->enum('alcohol_consumption', ['None', 'Low', 'Medium', 'High']);
            $table->enum('stress_level', ['Low', 'Medium', 'High']);
            $table->decimal('sleep_hours', 4, 2);
            $table->enum('sugar_consumption', ['Low', 'Medium', 'High']);

            $table->enum('status', ['inputed', 'predicted', 'verified'])->default('inputed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_input');
    }
};
