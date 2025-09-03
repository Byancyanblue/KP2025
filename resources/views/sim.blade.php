<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Prediksi Jantung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background: linear-gradient(to bottom right, #e6f7ff, #d3e0ea);
        color: #2d3748;
        overflow-x: hidden;
    }

    .welcome-container {
        position: relative;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
        padding: 40px 20px;
        text-align: center;
    }

    .welcome-container::before {
        content: "";
        background: url('storage/khanza/logo.jpg') no-repeat center center;
        background-size: 500px;
        opacity: 0.07;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    header, main, footer {
        z-index: 1;
    }

    header h1 {
        font-size: 2.5rem;
        color: #2f855a;
        margin-bottom: 0.5rem;
    }

    header h2 {
        font-size: 3rem;
        font-weight: 800;
        color: #234e52;
    }

    main .featured {
        display: flex;
        align-items: center;
        gap: 15px;
        background-color: white;
        border-radius: 12px;
        padding: 15px 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-top: 30px;
        transition: transform 0.3s ease;
    }

    main .featured:hover {
        transform: translateY(-5px);
    }

    main .featured img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    main .featured p {
        font-size: 1.25rem;
        font-weight: 600;
        color: #2d3748;
    }

    footer {
        margin-top: 40px;
    }

    footer .powered {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1rem;
        color: #4a5568;
    }

    footer .powered img {
        width: 30px;
        height: 30px;
    }

    @media (max-width: 600px) {
        header h1 { font-size: 1.8rem; }
        header h2 { font-size: 2.3rem; }
        main .featured { flex-direction: column; text-align: center; }
    }
</style>

</head>
<body>

    <div class="welcome-container">
    <header>
        <h1>Selamat Datang di</h1>
        <h2>Sistem Prediksi Jantung Berbasis Gemini</h2>
    </header>

    <main>
        <div class="featured">
            <img src="storage/khanza/logo.jpg" alt="Logo SIMKES KHANZA">
            <p>featured by SIMKES KHANZA</p>
        </div>
    </main>

    <footer>
        <div class="powered">
            <p>powered by Gemini</p>
            <img src="storage/khanza/gemini.png" alt="Logo Gemini">
        </div>
    </footer>
</div>

</body>
</html>
