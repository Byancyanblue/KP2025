<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\HeartPredictionController;
use App\Http\Controllers\WebcamController;
use App\Http\Controllers\PdfController;


Route::get('/', function () {
    return view('sim');
});



Route::get('/prediksi', [PrediksiController::class, 'prediksi']);
Route::post('/prediksi/simpan', [PrediksiController::class, 'simpan'])->name('prediksi.simpan');


Route::get('/predict-heart', [HeartPredictionController::class, 'index']);
Route::post('/predict-heart', [HeartPredictionController::class, 'predict']);
Route::get('/predict-result', [HeartPredictionController::class, 'result'])->name('predict.result');
Route::get('/predict-result/webcam', [WebcamController::class, 'index'])->name('webcam.index');  
Route::post('/predict-result/webcam', [WebcamController::class, 'store'])->name('webcam.store');  
//Route::get('/cetak-pdf/{id_pasien}', [PdfController::class, 'cetak'])->name('pdf.cetak');
Route::get('/cetak-pdf-ajax/{id_pasien}', [PdfController::class, 'cetakAjax'])->name('pdf.cetakAjax');



