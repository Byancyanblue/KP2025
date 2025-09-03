@extends('layouts.app')

@section('content')
<div class="container my-4">  

    <h2 class="text-center mb-4 text-success">  
        <i class="bi bi-heart-pulse me-2"></i>Hasil Prediksi Risiko Penyakit Jantung  
    </h2>  
    {{--<pre>{{ $rawPrediction }}</pre>

    <pre>{{ print_r($predictionParts, true) }}</pre>--}}

    {{-- Prediksi Risiko --}}  
    @if(!empty($predictionParts['risk_prediction']))  
        <div class="card mb-3 shadow-sm border-success rounded">  
            <div class="card-header bg-success text-white d-flex align-items-center">  
                <i class="bi bi-exclamation-triangle me-2"></i>  
                <h5 class="mb-0">1. Prediksi Risiko</h5>  
            </div>  
            <div class="card-body">  
                {!! cleanMarkdown($predictionParts['risk_prediction']) !!}  
            </div>  
        </div>  
    @endif  

    {{-- Penjelasan Klinis --}}  
    @if(!empty($predictionParts['clinical_explanation']))  
        <div class="card mb-3 shadow-sm border-info rounded">  
            <div class="card-header bg-info text-white d-flex align-items-center">  
                <i class="bi bi-file-medical me-2"></i>  
                <h5 class="mb-0">2. Penjelasan Klinis</h5>  
            </div>  
            <div class="card-body">  
                {!! cleanMarkdown($predictionParts['clinical_explanation']) !!}  
            </div>  
        </div>  
    @endif  

    {{-- Analisis Faktor Risiko --}}  
    @if(!empty($predictionParts['risk_analysis']))  
        <div class="card mb-3 shadow-sm border-warning rounded">  
            <div class="card-header bg-warning text-dark d-flex align-items-center">  
                <i class="bi bi-funnel-fill me-2"></i>  
                <h5 class="mb-0">3. Analisis Faktor Risiko</h5>  
            </div>  
            <div class="card-body">  
                {!! cleanMarkdown($predictionParts['risk_analysis']) !!}  
            </div>  
        </div>  
    @endif  

    {{-- Saran Medis --}}  
    @if(!empty($predictionParts['medical_suggestion']))  
        <div class="card mb-3 shadow-sm border-success rounded">  
            <div class="card-header bg-success text-white d-flex align-items-center">  
                <i class="bi bi-lightbulb-fill me-2"></i>  
                <h5 class="mb-0">4. Saran Medis</h5>  
            </div>  
            <div class="card-body">  
                {!! cleanMarkdown($predictionParts['medical_suggestion']) !!}  
            </div>  
        </div>  
    @endif  

    {{-- Disclaimer --}}  
    @if(!empty($predictionParts['disclaimer']))  
        <div class="alert alert-secondary rounded shadow-sm mt-4">  
            <h5 class="mb-3">Disclaimer Mengenai Hasil Prediksi</h5>  
            {!! cleanMarkdown($predictionParts['disclaimer']) !!}  
        </div>  
    @endif  

    {{-- Button Verifikasi --}}  
    <div class="text-center mt-4">  
        <button id="verifyBtn" class="btn btn-primary btn-lg">  
            🔍 Verifikasi Prediksi  
        </button>  
    </div>  
</div> 
@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    });
</script>
@endif
<script>
  document.getElementById('verifyBtn').addEventListener('click', function() {
    Swal.fire({
        title: 'Yakin ingin melakukan verifikasi?',
        text: "Proses ini akan membuka kamera untuk verifikasi.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yakin',
        cancelButtonText: 'Batal',
        confirmButtonColor: '#007bff'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('webcam.index') }}";
        }
    });
  });
</script>

@endsection

