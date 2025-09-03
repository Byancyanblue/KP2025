<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPrediksi extends Model
{
    use HasFactory;

    protected $table = 'hasil_prediksi';
    protected $primaryKey = 'id_hasil';

    protected $fillable = [
        'pasien_id',
        'risk_prediction',
        'clinical_explanation',
        'risk_analysis',
        'medical_suggestion',
        'disclaimer',
    ];

    public function pasien()
    {
        return $this->belongsTo(PasienInput::class, 'pasien_id');
    }
}
