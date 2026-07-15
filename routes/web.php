<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DiseaseController;
use App\Http\Controllers\Admin\SymptomController;
use App\Http\Controllers\Admin\KnowledgeBaseController;
use App\Http\Controllers\Admin\DiagnosisReportController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\Admin\TreatmentController;
use App\Http\Controllers\Admin\FeedbackController;

// ── Public / User routes (Bizland template) ───────────────────────────────────
Route::get('/', [DiagnosisController::class, 'index'])->name('home');
Route::get('/about', [DiagnosisController::class, 'about'])->name('about');
Route::get('/articles', [DiagnosisController::class, 'articles'])->name('articles.index');
Route::get('/articles/{article}', [DiagnosisController::class, 'article'])->name('articles.show');
Route::get('/hospitals', [DiagnosisController::class, 'hospitals'])->name('hospitals.index');
Route::get('/hospitals/{hospital}', [DiagnosisController::class, 'hospital'])->name('hospitals.show');
Route::get('/diseases', [DiagnosisController::class, 'diseases'])->name('diseases');
Route::get('/contact', [DiagnosisController::class, 'contact'])->name('contact');

Route::prefix('konsultasi')->name('diagnosis.')->group(function () {
    Route::get('/', [DiagnosisController::class, 'create'])->name('create');
    Route::post('/', [DiagnosisController::class, 'store'])->name('store');
    Route::get('/hasil/{diagnosis}', [DiagnosisController::class, 'result'])->name('result');
    Route::post('/hasil/{diagnosis}/feedback', [DiagnosisController::class, 'storeFeedback'])->name('feedback.store');
    Route::get('/cetak/{diagnosis}', [DiagnosisController::class, 'print'])->name('print');
});

// ── Auth routes ───────────────────────────────────────────────────────────────
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ── Admin routes (Tabler template) ────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('diseases', DiseaseController::class)->except(['show']);
    Route::resource('symptoms', SymptomController::class)->except(['show']);

    Route::get('knowledge', [KnowledgeBaseController::class, 'index'])->name('knowledge.index');
    Route::post('knowledge', [KnowledgeBaseController::class, 'update'])->name('knowledge.update');

    Route::get('diagnoses', [DiagnosisReportController::class, 'index'])->name('diagnoses.index');
    Route::get('diagnoses/{diagnosis}', [DiagnosisReportController::class, 'show'])->name('diagnoses.show');
    Route::delete('diagnoses/{diagnosis}', [DiagnosisReportController::class, 'destroy'])->name('diagnoses.destroy');

    // 5 Rute Baru untuk Memenuhi Syarat UAS
    Route::resource('articles', ArticleController::class)->except(['show']);
    Route::resource('hospitals', HospitalController::class)->except(['show']);
    Route::resource('feedbacks', FeedbackController::class)->except(['show']);
    Route::get('patients', [PatientController::class, 'index'])->name('patients.index');
    Route::get('patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
});
