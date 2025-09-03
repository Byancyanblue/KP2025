<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiHasilPrediksi extends Model
{
    use HasFactory;

    protected $table = 'verifikasi_hasil_prediksi';

    protected $fillable = [
        'hasil_prediksi_id',
        'nama',
        'catatan',
        'gambar_path',
    ];

    public function hasilPrediksi()
    {
        return $this->belongsTo(HasilPrediksi::class, 'hasil_prediksi_id');
    }
}
