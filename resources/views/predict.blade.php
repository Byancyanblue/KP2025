@extends('layouts.app')

@section('title', 'Medical Input Form')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif



<div class="container">
  <h1>Formulir Input Data Pasien</h1>

  <form id="myForm" action="predict-heart" method="POST">
    @csrf

    <!-- General Information -->
    <div class="section">
      <h2>Informasi Umum</h2>

      <div class="form-group mb-4">
        <label>Nomor Rekam Medis</label>
        <input type="text" name="id_pasien" class="form-control" value="{{ $dataPasien['id_pasien'] ?? '' }}" readonly placeholder="000001">
      </div>
      
      <div class="form-group mb-4">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{ $dataPasien['nama'] ?? '' }}" readonly placeholder= "Contoh: Putra">
      </div>

      <div class="form-group mb-4">
        <label>Usia</label>
        <input type="text" name="umur" class="form-control" value="{{ $dataPasien['umur'] ?? '' }}" readonly placeholder="Contoh: 31 Thn">
      </div>

      <div class="form-group mb-4">
        <label>Jenis Kelamin</label>
        <select name="jk" class="form-control" required>
          <option value="">--Pilih--</option>
          <option value="L" {{ (isset($dataPasien['jk']) && $dataPasien['jk'] == 'L') ? 'selected' : '' }}>Laki-laki</option>
          <option value="P" {{ (isset($dataPasien['jk']) && $dataPasien['jk'] == 'P') ? 'selected' : '' }}>Perempuan</option>
        </select>
      </div>


      <div class="form-group mb-4">
        <label>Kebiasaan Olahraga</label>
        <select name="exercise_habits" required>
          <option value="">--Pilih--</option>
          <option value="Low">Jarang</option>
          <option value="Medium">Cukup</option>
          <option value="High">Sering</option>
        </select>
        <small class="form-text text-muted">Seberapa sering Anda berolahraga dalam seminggu?</small>
      </div>

      <div class="form-group mb-4">
        <label>Konsumsi Alkohol</label>
        <select name="alcohol_consumption" required>
          <option value="">--Pilih--</option>
          <option value="None">Tidak Pernah</option>
          <option value="Low">Rendah</option>
          <option value="Medium">Sedang</option>
          <option value="High">Tinggi</option>
        </select>
        <small class="form-text text-muted">Frekuensi konsumsi alkohol (jika ada).</small>
      </div>

      <div class="form-group mb-4">
        <label>Jam Tidur per Hari</label>
        <input type="number" name="sleep_hours" step="0.1" required placeholder="Contoh: 7.5">
        <small class="form-text text-muted">Masukkan rata-rata jam tidur Anda setiap malam.</small>
      </div>

      <div class="form-group mb-4">
        <label>Tingkat Stress</label>
        <select name="stress_level" required>
          <option value="">--Pilih--</option>
          <option value="Low">Rendah</option>
          <option value="Medium">Sedang</option>
          <option value="High">Tinggi</option>
        </select>
         <small class="form-text text-muted">Seberapa sering Anda merasa stres dalam keseharian?</small>
      </div>

      <div class="form-group mb-4">
        <label>Konsumsi Gula</label>
        <select name="sugar_consumption" required>
          <option value="">--Pilih--</option>
          <option value="Low">Rendah</option>
          <option value="Medium">Sedang</option>
          <option value="High">Tinggi</option>
        </select>
        <small class="form-text text-muted">Frekuensi konsumsi makanan/minuman manis.</small>
      </div>
    </div>

    <!-- Hasil Pemeriksaan -->
    <div class="section">
      <h2>Hasil Pemeriksaan</h2>

      <div class="form-group mb-4">
        <label>Tekanan Darah (Sistolik)</label>
        <input type="number" name="blood_pressure" required placeholder="Contoh : 120">
        <small class="form-text text-muted">Masukkan nilai tekanan darah sistolik (mmHg).</small>
      </div>

      <div class="form-group mb-4">
        <label>Kadar Kolesterol Total</label>
        <input type="number" name="cholesterol_level" required placeholder="Contoh : 200">
        <small class="form-text text-muted">Masukkan kadar kolesterol total (mg/dL).</small>
      </div>

      <div class="form-group mb-4">
        <label>Indeks Massa Tubuh (BMI)</label>
        <input type="number" name="bmi" step="0.1" required placeholder="Contoh: 22.5">
        <small class="form-text text-muted">Masukkan nilai BMI (berdasarkan tinggi dan berat badan).</small>
      </div>

      <div class="form-group mb-4">
        <label>Kadar Trigliserida</label>
        <input type="number" name="triglyceride_level" required placeholder="Contoh: 150">
        <small class="form-text text-muted">Masukkan kadar trigliserida (mg/dL).</small>
      </div>

      <div class="form-group mb-4">
        <label>Gula Darah Puasa</label>
        <input type="number" name="fasting_blood_sugar" required placeholder="Contoh: 90">
        <small class="form-text text-muted">Masukkan kadar gula darah saat puasa (mg/dL).</small>
      </div>

      <div class="form-group mb-4">
        <label>Kadar CRP (C-Reactive Protein)</label>
        <input type="number" name="crp_level" step="0.01" required placeholder="Contoh: 0.50">
        <small class="form-text text-muted">Masukkan nilai CRP (mg/dL), indikator inflamasi tubuh.</small>
      </div>

      <div class="form-group mb-4">
        <label>Kadar Homosistein</label>
        <input type="number" name="homocysteine_level" step="0.01" required placeholder="Contoh: 10.50">
        <small class="form-text text-muted">Masukkan kadar homosistein dalam darah (µmol/L).</small>
      </div>

      <div class="form-group mb-4">
        <label>HDL Rendah (Kolesterol Baik)</label>
        <div class="radio-group">
          <label><input type="radio" name="low_hdl" value="Yes" required> Ya</label>
          <label><input type="radio" name="low_hdl" value="No" required> Tidak</label>
        </div>
        <small class="form-text text-muted">Pilih "Ya" jika kadar HDL lebih rendah dari normal.</small>
      </div>

      <div class="form-group mb-4">
        <label>LDL Tinggi (Kolesterol Jahat)</label>
        <div class="radio-group">
          <label><input type="radio" name="high_ldl" value="Yes" required> Ya</label>
          <label><input type="radio" name="high_ldl" value="No" required> Tidak</label>
        </div>
        <small class="form-text text-muted">Pilih "Ya" jika kadar LDL lebih tinggi dari normal.</small>
      </div>

      <div class="form-group mb-4">
        <label>Tekanan Darah Tinggi</label>
        <div class="radio-group">
          <label><input type="radio" name="high_blood_pressure" value="Yes" required> Ya</label>
          <label><input type="radio" name="high_blood_pressure" value="No" required> Tidak</label>
        </div>
        <small class="form-text text-muted">Pilih "Ya" jika pasien memiliki riwayat hipertensi.</small>
      </div>

    </div>

    <!-- Anamnesis -->
    <div class="section">
      <h2>Anamnesis</h2>

      <div class="form-group mb-4">
        <label>Merokok</label>
        <div class="radio-group">
          <label><input type="radio" name="smoking" value="Yes" required> Ya</label>
          <label><input type="radio" name="smoking" value="No" required> Tidak</label>
        </div>
        <small class="form-text text-muted">Pilih "Ya" jika pasien memiliki kebiasaan merokok, baik aktif maupun pasif.</small>
      </div>

      <div class="form-group mb-4">
        <label>Riwayat Penyakit Jantung dalam Keluarga</label>
        <div class="radio-group">
          <label><input type="radio" name="family_heart_disease" value="Yes" required> Ya</label>
          <label><input type="radio" name="family_heart_disease" value="No" required> Tidak</label>
        </div>
        <small class="form-text text-muted">Pilih "Ya" jika ada anggota keluarga yang pernah mengalami penyakit jantung.</small>
      </div>

      <div class="form-group mb-4">
        <label>Diabetes</label>
        <div class="radio-group">
          <label><input type="radio" name="diabetes" value="Yes" required> Ya</label>
          <label><input type="radio" name="diabetes" value="No" required> Tidak</label>
        </div>
        <small class="form-text text-muted">Pilih "Ya" jika pasien pernah atau sedang menderita diabetes.</small>
      </div>

    </div>

    <button type="submit">Prediksi Pasien</button>

  </form>
</div>
<script>
  document.getElementById('myForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Hindari submit otomatis

    Swal.fire({
      title: 'Yakin ingin kirim?',
      text: "Pastikan data sudah benar.",
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, kirim!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        // Tampilkan loading sebelum submit
        Swal.fire({
          title: 'Memproses...',
          text: 'Mohon tunggu sebentar',
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: () => {
            Swal.showLoading();
          }
        });

        // Submit form setelah popup loading muncul
        setTimeout(() => {
          e.target.submit();
        }, 300); // beri delay sedikit agar loading terlihat
      }
    });
  });
</script>



@endsection
