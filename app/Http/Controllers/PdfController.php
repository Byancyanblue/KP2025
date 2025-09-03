<?php

namespace App\Http\Controllers;

use App\Models\PasienInput;
use App\Models\HasilPrediksi;
use App\Models\VerifikasiHasilPrediksi;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
   public function cetakAjax($id_pasien)
    {
        $pasien = PasienInput::where('id', $id_pasien)->firstOrFail();
        $hasil = HasilPrediksi::where('pasien_id', $id_pasien)->firstOrFail();
        $verifikasi = VerifikasiHasilPrediksi::where('hasil_prediksi_id', $hasil->id)->first();

        $logoPath = public_path('storage/khanza/logo.jpg');

        $pdf = Pdf::loadView('laporan-pdf', compact('pasien', 'hasil', 'verifikasi', 'logoPath'))
                ->setPaper('A4', 'portrait');

        #$canvas = $pdf->getDomPDF()->get_canvas();
        #$canvas->page_text(40, 810, 'Dicetak: ' . now()->format('d-m-Y H:i'), null, 8);
        #$canvas->page_text(40, 825, 'Halaman: {PAGE_NUM} / {PAGE_COUNT}', null, 8);

        $output = base64_encode($pdf->output());

        return response()->json([
            'filename' => Str::slug($pasien->nama) . '-' . now()->format('Ymd_His') . '.pdf',
            'filedata' => $output,
        ]);
    }

}
