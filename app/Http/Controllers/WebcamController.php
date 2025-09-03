<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\VerifikasiHasilPrediksi;
use App\Models\HasilPrediksi;

class WebcamController extends Controller
{
    public function index()
    {
        return view('webcam.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|string',
            'nama' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        // Ambil hasil prediksi terbaru
        $hasilPrediksi = HasilPrediksi::latest()->first();

        if (!$hasilPrediksi) {
            return response()->json(['message' => 'Hasil prediksi belum tersedia'], 422);
        }

        $imageData = $request->input('image');

        // Ekstrak base64
        if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
            $imageData = substr($imageData, strpos($imageData, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, dll

            if (!in_array($type, ['jpg', 'jpeg', 'png', 'gif'])) {
                return response()->json(['message' => 'Format gambar tidak didukung'], 422);
            }
        } else {
            return response()->json(['message' => 'Data gambar tidak valid'], 422);
        }

        $imageData = base64_decode($imageData);

        if ($imageData === false) {
            return response()->json(['message' => 'Gagal decode gambar'], 422);
        }

        $fileName = 'verifikasi_gambar/' . uniqid() . '.' . $type;
        Storage::disk('public')->put($fileName, $imageData);

        // Simpan ke tabel verifikasi hasil prediksi
        VerifikasiHasilPrediksi::create([
            'hasil_prediksi_id' => $hasilPrediksi->id, // otomatis
            'nama' => $request->input('nama', 'Anonim'),
            'catatan' => $request->input('catatan'),
            'gambar_path' => $fileName,
        ]);

        return response()->json([
            'message' => 'Gambar berhasil disimpan', 
            'id_pasien' => $hasilPrediksi->pasien_id,]); // ini penting!
    }
}
