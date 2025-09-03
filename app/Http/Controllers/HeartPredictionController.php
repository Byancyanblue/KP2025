<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PasienInput;
use App\Models\HasilPrediksi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class HeartPredictionController extends Controller
{

    public function index(Request $request)
    {
        $id_pasien = $request->query('id_pasien');
        $nama = $request->query('nama');
        $umur = $request->query('umur');
        $jk = $request->query('jk');

        // Cek apakah semua parameter kosong
        if (!$id_pasien && !$nama && !$umur && !$jk) {
            abort(403, 'Akses tidak diizinkan. Silakan mulai dari SIMKES KHANZA.');
        }


        $dataPasien = compact('id_pasien', 'nama', 'umur', 'jk');
        return view('predict', ['dataPasien' => $dataPasien]);
    }




public function predict(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'id_pasien' => 'required|string',
            'nama' => 'required|string',
            'umur' => 'required|string',
            'jk' => 'required|in:L,P',

            'blood_pressure' => 'required|numeric',
            'cholesterol_level' => 'required|numeric',
            'bmi' => 'required|numeric',
            'triglyceride_level' => 'required|numeric',
            'fasting_blood_sugar' => 'required|numeric',
            'crp_level' => 'required|numeric',
            'homocysteine_level' => 'required|numeric',

            'low_hdl' => 'required|in:Yes,No',
            'high_ldl' => 'required|in:Yes,No',
            'high_blood_pressure' => 'required|in:Yes,No',
            'smoking' => 'required|in:Yes,No',
            'family_heart_disease' => 'required|in:Yes,No',
            'diabetes' => 'required|in:Yes,No',

            'exercise_habits' => 'required|in:Low,Medium,High',
            'alcohol_consumption' => 'required|in:None,Low,Medium,High',
            'stress_level' => 'required|in:Low,Medium,High',
            'sleep_hours' => 'required|numeric|min:0|max:24',
            'sugar_consumption' => 'required|in:Low,Medium,High',
        ]);

        // Simpan ke tabel pasien_input
        $pasien = PasienInput::create([
            'id_pasien' => $validated['id_pasien'],
            'nama' => $validated['nama'],
            'umur' => $validated['umur'],
            'jk' => $validated['jk'],
            'blood_pressure' => $validated['blood_pressure'],
            'cholesterol_level' => $validated['cholesterol_level'],
            'bmi' => $validated['bmi'],
            'triglyceride_level' => $validated['triglyceride_level'],
            'fasting_blood_sugar' => $validated['fasting_blood_sugar'],
            'crp_level' => $validated['crp_level'],
            'homocysteine_level' => $validated['homocysteine_level'],
            'low_hdl' => $validated['low_hdl'],
            'high_ldl' => $validated['high_ldl'],
            'high_blood_pressure' => $validated['high_blood_pressure'],
            'smoking' => $validated['smoking'],
            'family_heart_disease' => $validated['family_heart_disease'],
            'diabetes' => $validated['diabetes'],
            'exercise_habits' => $validated['exercise_habits'],
            'alcohol_consumption' => $validated['alcohol_consumption'],
            'stress_level' => $validated['stress_level'],
            'sleep_hours' => $validated['sleep_hours'],
            'sugar_consumption' => $validated['sugar_consumption'],
            'status' => 'inputed'
        ]);
        session()->flash('success', 'Data pasien berhasil disimpan dan sedang diproses untuk prediksi.');


        // Siapkan payload untuk Flask
        $payload = [
            'id_pasien' => $validated['id_pasien'],
            'nama' => $validated['nama'],
            'umur' => $validated['umur'],
            'jk' => $validated['jk'],
            'blood_pressure' => $validated['blood_pressure'],
            'cholesterol_level' => $validated['cholesterol_level'],
            'exercise_habits' => $validated['exercise_habits'],
            'smoking' => $validated['smoking'],
            'family_heart_disease' => $validated['family_heart_disease'],
            'diabetes' => $validated['diabetes'],
            'bmi' => $validated['bmi'],
            'high_blood_pressure' => $validated['high_blood_pressure'],
            'low_hdl' => $validated['low_hdl'],
            'high_ldl' => $validated['high_ldl'],
            'alcohol_consumption' => $validated['alcohol_consumption'],
            'stress_level' => $validated['stress_level'],
            'sleep_hours' => $validated['sleep_hours'],
            'sugar_consumption' => $validated['sugar_consumption'],
            'triglyceride_level' => $validated['triglyceride_level'],
            'fasting_blood_sugar' => $validated['fasting_blood_sugar'],
            'crp_level' => $validated['crp_level'],
            'homocysteine_level' => $validated['homocysteine_level'],
        ];

        // Kirim ke Flask API
        $response = Http::post('http://127.0.0.1:5000/predict-heart', $payload);
        $decoded = $response->json();

        Log::info('Flask response:', $decoded);

        if (!isset($decoded['prediction'])) {
            Log::error('Flask response tidak memiliki key "prediction".', ['response' => $decoded]);
            return redirect()->back()->with('error', 'Gagal mengambil hasil prediksi dari Flask.');
        }

        $rawPrediction = $decoded['prediction'];

        // Parsing hasil prediksi
        $predictionParts = $this->parsePrediction($rawPrediction);

        // Simpan hasil prediksi ke tabel hasil_prediksi
        HasilPrediksi::create([
            'pasien_id' => $pasien->id,
            'risk_prediction' => $predictionParts['risk_prediction'] ?? null,
            'clinical_explanation' => $predictionParts['clinical_explanation'] ?? null,
            'risk_analysis' => $predictionParts['risk_analysis'] ?? null,
            'medical_suggestion' => $predictionParts['medical_suggestion'] ?? null,
            'disclaimer' => $predictionParts['disclaimer'] ?? null,
        ]);
        // Kirim data ke session
        session([
            'prediction_raw' => $rawPrediction,
            'prediction_parts' => $predictionParts,
            'nama' => $validated['nama'],
            'umur' => $validated['umur'],
            'jk' => $validated['jk'],
            'pasien_id' => $pasien->id,  // bisa digunakan untuk relasi ke tabel hasil_prediksi
        ]);

        return redirect()->route('predict.result');
    }


    public function result()
    {
        $rawText = session('prediction_raw', '');

        if (empty($rawText)) {
            return view('predict_result', [
                'predictionParts' => [
                    'risk_prediction' => '',
                    'clinical_explanation' => '',
                    'risk_analysis' => '',
                    'medical_suggestion' => '',
                    'disclaimer' => '',
                ],
                'rawPrediction' => '',
            ]);
        }

        $parsed = $this->parsePrediction($rawText);

        \Log::info('Parsed prediction parts:', ['parsed' => $parsed]);

        return view('predict_result', [
            'predictionParts' => $parsed,
            'rawPrediction' => $rawText,
        ]);
    }

   private function parsePrediction(string $text): array
    {
        $result = [
            'risk_prediction' => '',
            'clinical_explanation' => '',
            'risk_analysis' => '',
            'medical_suggestion' => '',
            'disclaimer' => '',
        ];

        $text = str_replace("\r\n", "\n", $text);

        preg_match_all(
            '/\d+\.\s\*\*(.+?):\*\*(.*?)(?=\n\d+\. \*\*|$)/s',
            $text,
            $matches,
            PREG_SET_ORDER
        );

        foreach ($matches as $match) {
            $title = trim(strtolower($match[1]));
            $content = trim($match[2]);

            switch ($title) {
                case 'prediksi risiko':
                    $result['risk_prediction'] = $content;
                    break;
                case 'penjelasan klinis':
                    $result['clinical_explanation'] = $content;
                    break;
                case 'analisis faktor risiko yang memungkinkan berbasis icd-10':
                    $result['risk_analysis'] = $content;
                    break;
                case 'saran medis untuk pasien':
                    $result['medical_suggestion'] = $content;
                    break;
                case 'disclaimer mengenai hasil prediksi':
                    $result['disclaimer'] = $content;
                    break;
            }
        }

        return $result;
    }
}
