<!DOCTYPE html>
<html>
<head>
    <title>Form Prediksi</title>
</head>
<body>
    <h1>Form Data Pasien</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('prediksi.simpan') }}">
        @csrf
        <label>ID:</label><br>
        <input type="text" name="id" value="{{ $data['id'] }}" readonly><br>

        <label>Nama:</label><br>
        <input type="text" name="nama" value="{{ $data['nama'] }}"><br>

        <label>Jenis Kelamin:</label><br>
        <input type="text" name="jk" value="{{ $data['jk'] }}"><br><br>

        <button type="submit">Simpan ke Database</button>
    </form>
</body>
</html>
