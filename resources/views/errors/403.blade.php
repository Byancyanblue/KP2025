<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak - 403</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="relative bg-gray-100 flex items-center justify-center min-h-screen text-center px-4 overflow-hidden">

    <!-- Main content -->
    <div class="relative z-10 max-w-xl bg-white bg-opacity-80 backdrop-blur-md p-8 rounded-2xl shadow-xl">
        <h1 class="text-6xl font-extrabold text-red-600">403</h1>
        <h2 class="text-2xl font-semibold text-gray-800 mt-4">Akses Ditolak</h2>
        <p class="mt-4 text-gray-700 leading-relaxed">
            Anda tidak diizinkan mengakses halaman ini secara langsung.<br>
            Penggunaan sistem prediksi jantung hanya diperuntukkan melalui <strong>SIMKES KHANZA</strong>.
        </p>
        <a href="{{ url('/') }}" class="mt-6 inline-block px-6 py-2 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 transition duration-300">
            Kembali ke Beranda
        </a>
    </div>

</body>
</html>
