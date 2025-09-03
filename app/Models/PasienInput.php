<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasienInput extends Model
{
    protected $table = 'pasien_input';

    protected $fillable = [
        'id_pasien', 
        'nama', 
        'umur', 
        'jk',
        'blood_pressure', 
        'cholesterol_level', 
        'bmi',
        'triglyceride_level', 
        'fasting_blood_sugar', 
        'crp_level', 
        'homocysteine_level',
        'low_hdl', 'high_ldl', 
        'high_blood_pressure',
        'smoking', 
        'family_heart_disease', 
        'diabetes',
        'exercise_habits', 
        'alcohol_consumption', 
        'stress_level',
        'sleep_hours', 
        'sugar_consumption', 
        'status',
    ];

    public function hasilPrediksi()
    {
        return $this->hasOne(HasilPrediksi::class, 'pasien_id');
    }

}
