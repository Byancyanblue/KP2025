<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Prediksi Penyakit</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 10px; }
        .section { margin-bottom: 20px; }
        .label { font-weight: bold; }
        hr { border: 1px solid #000; }
        .signature { margin-top: 40px; }
        footer {
            position: fixed;
            bottom: -50px;
            left: 0;
            right: 0;
            height: 50px;
            font-size: 10px;
            text-align: left;
            color: #555;
        }
         .page-number:after {
            content: "Halaman: " counter(page) " / " counter(pages);
        }
    </style>
</head>
<body>
    <!-- HEADER -->
<header>
    <table width="100%">
        <tr>
            <td width="10%">
                <img src="{{ $logoPath }}" width="70px">
            </td>
            <td align="center">
                <strong>RS SIMRS KHANZA</strong><br>
                Guwosari, Pajangan, Bantul<br>
                Hp: 08562675039, Email: khanzasoftmedia@gmail.com
            </td>
        </tr>
    </table>
    <hr>
</header>

{{-- FOOTER --}}
    <footer>
        <div class="dicetak">Dicetak: {{ now()->format('d-m-Y H:i') }}</div>
        <div class="page-number" style="text-align: right;"></div>
    </footer>

    {{-- SECTION 1: DATA PASIEN --}}
    <div class="section">
        <h3>A. Informasi Pasien</h3>
        {{-- SECTION 1: DATA UMUM PASIEN --}}
        <div class="section">
            <h4>1. Data Umum Pasien</h4>
            <p><span class="label">Nama:</span> {{ $pasien->nama }}</p>
            <p><span class="label">Usia:</span> {{ $pasien->umur }} tahun</p>
            <p><span class="label">Jenis Kelamin:</span> {{ $pasien->jk == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
        </div>

        {{-- SECTION 2: HASIL PEMERIKSAAN --}}
        <div class="section">
            <h4>2. Hasil Pemeriksaan</h4>
            <p><span class="label">Tekanan Darah:</span> {{ $pasien->blood_pressure }}</p>
            <p><span class="label">Kolesterol:</span> {{ $pasien->cholesterol_level }}</p>
            <p><span class="label">BMI:</span> {{ $pasien->bmi }}</p>
            <p><span class="label">Trigliserida:</span> {{ $pasien->triglyceride_level }}</p>
            <p><span class="label">Gula Darah Puasa:</span> {{ $pasien->fasting_blood_sugar }}</p>
            <p><span class="label">CRP (C-Reactive Protein):</span> {{ $pasien->crp_level }}</p>
            <p><span class="label">Homocysteine:</span> {{ $pasien->homocysteine_level }}</p>
        </div>

        {{-- SECTION 3: ANAMNESIS (Gaya Hidup & Riwayat) --}}
        <div class="section">
            <h4>3. Anamnesis</h4>
            <p><span class="label">HDL Rendah:</span> {{ $pasien->low_hdl }}</p>
            <p><span class="label">LDL Tinggi:</span> {{ $pasien->high_ldl }}</p>
            <p><span class="label">Tekanan Darah Tinggi:</span> {{ $pasien->high_blood_pressure }}</p>
            <p><span class="label">Merokok:</span> {{ $pasien->smoking }}</p>
            <p><span class="label">Riwayat Penyakit Jantung Keluarga:</span> {{ $pasien->family_heart_disease }}</p>
            <p><span class="label">Diabetes:</span> {{ $pasien->diabetes }}</p>
            <p><span class="label">Kebiasaan Olahraga:</span> {{ $pasien->exercise_habits }}</p>
            <p><span class="label">Konsumsi Alkohol:</span> {{ $pasien->alcohol_consumption }}</p>
            <p><span class="label">Tingkat Stres:</span> {{ $pasien->stress_level }}</p>
            <p><span class="label">Jam Tidur:</span> {{ $pasien->sleep_hours }} jam/hari</p>
            <p><span class="label">Konsumsi Gula:</span> {{ $pasien->sugar_consumption }}</p>
        </div>

    </div>

    {{-- SECTION 2: HASIL PREDIKSI --}}
    <div class="section">
        <h3>B. Hasil Prediksi</h3>
        <p><span class="label">Kategori Risiko:</span> {{ $hasil->risk_prediction }}</p>
        <p><span class="label">Penjelasan Klinis:</span> {!! nl2br(e($hasil->clinical_explanation)) !!}</p>
        <p><span class="label">Analisis Risiko:</span> {!! nl2br(e($hasil->risk_analysis)) !!}</p>
        <p><span class="label">Saran Medis:</span> {!! nl2br(e($hasil->medical_suggestion)) !!}</p>
        <p><span class="label">Disclaimer:</span> {!! nl2br(e($hasil->disclaimer)) !!}</p>
    </div>

    {{-- SECTION 3: VERIFIKASI --}}
    @if ($verifikasi)
    <div class="section">
        <h3>C. Verifikasi</h3>
        <p><span class="label">Nama Verifikator:</span> {{ $verifikasi->nama }}</p>
        <p><span class="label">Catatan:</span> {{ $verifikasi->catatan }}</p>
        @if ($verifikasi->gambar_path)
            <p><span class="label">Gambar:</span></p>
            <img src="{{ public_path('storage/' . $verifikasi->gambar_path) }}" alt="Verifikasi" width="200">
        @endif
    </div>
    @endif

</body>
</html>
