<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prediksi; // pastikan sudah buat model Prediksi

class PrediksiController extends Controller
{
    public function prediksi(Request $request)
    {
        $data = [
            'id' => $request->query('id'),
            'nama' => $request->query('nama'),
            'jk' => $request->query('jk')
        ];

        return view('prediksi', compact('data'));
    }

    public function simpan(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'nama' => 'required',
            'jk' => 'required'
        ]);

        Prediksi::create([
            'id_pasien' => $request->id,
            'nama' => $request->nama,
            'jk' => $request->jk
        ]);

        return redirect('/prediksi')->with('success', 'Data berhasil disimpan!');
    }
}
