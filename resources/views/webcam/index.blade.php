@extends('layouts.app')

@section('title', 'Webcam Ambil Gambar & Verifikasi')

@section('content')

<h1>Webcam Ambil Gambar & Verifikasi</h1>

<video id="video" autoplay style="border:1px solid #000; width: 320px; height: 240px; display: block; margin: 20px auto;"></video>
<button id="capture">Ambil Gambar</button>  

<canvas id="canvas" style="display: none;"></canvas>  

<div id="captured-image-container" style="display: none;">
    <h2>Hasil Pengambilan Gambar</h2>
    <img id="captured-image" src="" alt="Captured Image" style="max-width:320px; border:1px solid #666; display: block; margin: 20px auto;">
    <button id="retake">Ulang Pengambilan Gambar</button>

    <form id="upload-form" style="margin-top: 20px;">
        @csrf
        <input type="hidden" name="image" id="image">

        <div class="form-group">
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" placeholder="Nama Verifikator" required>
        </div>

        <div class="form-group">
            <label for="catatan">Catatan Tambahan:</label>
            <textarea name="catatan" id="catatan" rows="4" class="form-control" placeholder="Catatan tambahan..."></textarea>
        </div>

        <button type="submit">Upload Gambar dan Simpan Verifikasi</button>
    </form>
</div>

<a id="btn-cetak-pdf" href="#" target="_blank" style="display: none;" class="btn btn-success mt-3">Cetak PDF</a>

<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureBtn = document.getElementById('capture');
    const retakeBtn = document.getElementById('retake');
    const capturedContainer = document.getElementById('captured-image-container');
    const capturedImage = document.getElementById('captured-image');
    const imageInput = document.getElementById('image');
    const uploadForm = document.getElementById('upload-form');
    const cetakBtn = document.getElementById('btn-cetak-pdf');

    function startWebcam() {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                video.srcObject = stream;
            })
            .catch(err => {
                alert('Tidak dapat mengakses webcam: ' + err);
            });
    }

    startWebcam();

    captureBtn.addEventListener('click', () => {
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        const dataUrl = canvas.toDataURL('image/png');
        capturedImage.src = dataUrl;
        imageInput.value = dataUrl;

        capturedContainer.style.display = 'block';
        video.style.display = 'none';
        captureBtn.style.display = 'none';
    });

    retakeBtn.addEventListener('click', () => {
        capturedContainer.style.display = 'none';
        video.style.display = 'block';
        captureBtn.style.display = 'inline-block';

        capturedImage.src = '';
        imageInput.value = '';
        uploadForm.reset();
        cetakBtn.style.display = 'none';

        if (!video.srcObject) {
            startWebcam();
        }
    });

    uploadForm.addEventListener('submit', function (e) {
        e.preventDefault();

        if (!imageInput.value) {
            alert('Silakan ambil gambar terlebih dahulu!');
            return;
        }

        const formData = new FormData(this);

        fetch("{{ route('webcam.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Gambar berhasil diupload dan verifikasi disimpan.',
                confirmButtonColor: '#3085d6'
            }).then(() => {
                cetakBtn.style.display = 'inline-block';
                cetakBtn.onclick = async function(e) {
                    e.preventDefault();

                    const res = await fetch(`/cetak-pdf-ajax/${data.id_pasien}`);
                    const result = await res.json();

                    const byteCharacters = atob(result.filedata);
                    const byteNumbers = new Array(byteCharacters.length);
                    for (let i = 0; i < byteCharacters.length; i++) {
                        byteNumbers[i] = byteCharacters.charCodeAt(i);
                    }
                    const byteArray = new Uint8Array(byteNumbers);
                    const blob = new Blob([byteArray], { type: 'application/pdf' });

                    const link = document.createElement('a');
                    link.href = URL.createObjectURL(blob);
                    link.download = result.filename;
                    link.click();
                };
            });
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Error upload gambar: ' + error,
                confirmButtonColor: '#d33'
            });
        });
    });
</script>

@endsection
