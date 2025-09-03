<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem Prediksi')</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Ini CSS kamu sebelumnya, aku rapihin dikit */
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 30px;
            background-color: #f7f9fb;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #2f855a;
        }
        .section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .section h2 {
            color: #2f855a;
            border-bottom: 2px solid #c6f6d5;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #c6f6d5;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #48bb78;
            color: white;
        }
        .back-link {
            display: inline-block;
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #48bb78;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        .back-link:hover {
            background-color: #38a169;
        }

        form {
        display: flex;
        flex-direction: column;
        gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group label {
            margin-bottom: 6px;
            font-weight: 600;
            color: #2d3748;
        }

        .form-group input, 
        .form-group select {
            padding: 10px;
            border: 1px solid #c6f6d5;
            border-radius: 6px;
            font-size: 16px;
            background-color: #f0fff4;
            transition: border-color 0.3s;
        }

        .form-group input:focus, 
        .form-group select:focus {
            border-color: #48bb78;
            outline: none;
            background-color: #ffffff;
        }

        button{
            background-color: #48bb78;
            color: white;
            padding: 12px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #38a169;
        }

        a.custom-link {
        color: #007bff; /* warna biru */
        text-decoration: none; /* hilangkan garis bawah default */
        font-weight: bold;
        transition: all 0.3s ease;
        }

        a.custom-link:hover {
        text-decoration: underline; /* garis bawah saat hover */
        color: #0056b3; /* warna lebih gelap saat hover */
        }

    </style>
</head>
<body>

    {{-- Area konten halaman --}}
    <div class="container">
        @yield('content')
    </div>

</body>
</html>
