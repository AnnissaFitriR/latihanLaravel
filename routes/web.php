<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\DosenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\EkycController;
use App\Http\Controllers\Admin\EkycAdminController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    // Ruangan
    Route::get('/ruangan', [RuanganController::class, 'index'])->name('ruangan.index');
    Route::post('/ruangan', [RuanganController::class, 'store'])->name('ruangan.store');
    Route::get('/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('ruangan.edit');
    Route::put('/ruangan/{id}', [RuanganController::class, 'update'])->name('ruangan.update');
    Route::delete('/ruangan/{id}', [RuanganController::class, 'destroy'])->name('ruangan.destroy');

    // Matkul
    Route::get('/mataKuliah', [MataKuliahController::class, 'index'])->name('mataKuliah.index');
    Route::post('/mataKuliah', [MataKuliahController::class, 'store'])->name('mataKuliah.store');
    Route::get('/mataKuliah/{id}/edit', [MataKuliahController::class, 'edit'])->name('mataKuliah.edit');
    Route::put('/mataKuliah/{id}', [MataKuliahController::class, 'update'])->name('mataKuliah.update');
    Route::delete('/mataKuliah/{id}', [MataKuliahController::class, 'destroy'])->name('mataKuliah.destroy');

    // Dosen
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');

    Route::resource('ruangan', RuanganController::class);
    Route::resource('mataKuliah', MataKuliahController::class);
    Route::resource('dosen', DosenController::class);

    // Admin Route
    Route::prefix('admin')->group(function () {
    Route::get('/ekyc', [EkycAdminController::class, 'index'])->name('admin.ekyc.index');
    Route::get('/ekyc/{id}', [EkycAdminController::class, 'show'])->name('admin.ekyc.show');
    Route::post('/ekyc/{id}/verify', [EkycAdminController::class, 'verify'])->name('admin.ekyc.verify');
    });

    // Student Register
    Route::get('/register-mahasiswa', [StudentRegisterController::class, 'showRegistrationForm'])
    ->name('register.mahasiswa');

    Route::post('/register-mahasiswa', [StudentRegisterController::class, 'register']);

    // Ekyc Controller
    // Step 1
    Route::middleware(['auth'])->prefix('ekyc')->group(function () {
        Route::get('step1', [EkycController::class, 'step1'])->name('ekyc.step1');
        Route::post('step1', [EkycController::class, 'storeStep1'])->name('ekyc.storeStep1');

    // Step 2
    Route::get('/ekyc/step2', [EkycController::class, 'step2'])->name('ekyc.step2');
    Route::post('/ekyc/step2', [EkycController::class, 'storeStep2'])->name('ekyc.storeStep2');

    // Step 3
    Route::get('/ekyc/step3', [EkycController::class, 'showStep3'])->name('ekyc.step3');
    Route::post('/ekyc/step3', [EkycController::class, 'storeStep3'])->name('ekyc.storeStep3');

    // Step 4
    Route::get('/ekyc/step4', [EkycController::class, 'showStep4'])->name('ekyc.step4');
    Route::post('/ekyc/step4', [EkycController::class, 'storeStep4'])->name('ekyc.storeStep4');

    // Step 5
    Route::get('/ekyc/step5', [EkycController::class, 'step5'])->name('ekyc.step5');
    });
});
require __DIR__.'/auth.php';