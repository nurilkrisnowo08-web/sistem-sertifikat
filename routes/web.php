<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\AuthController;

// =========================================================================
// 1. JALUR UMUM & OTENTIKASI (Bisa diakses bebas tanpa login)
// =========================================================================

// Link utama web langsung dialihkan ke gerbang login admin
Route::get('/', function () {
    return redirect()->route('login');
});

// Jalur proses login & logout sistem kustom
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute rahasia pembuat akun admin pertama di database hosting
Route::get('/buat-akun-admin-arqi', function() {
    \App\Models\User::updateOrCreate(
        ['email' => 'admin@arqifarm.com'],
        [
            'name' => 'Admin Arqi',
            'password' => bcrypt('arqifarm3321')
        ]
    );
    return 'Akun admin berhasil dibuat! Email: admin@arqifarm.com | Password:arqifarm3321';
});

// Jalur umum pembacaan scan barcode (akses publik tanpa tombol admin)
Route::get('/certificate/{certificate_number}', [CertificateController::class, 'show'])->name('certificates.show');
Route::get('/verify/{ring_number}', [CertificateController::class, 'showPublic'])->name('certificates.public');

// Fitur pembersih cache sekaligus sinkronisasi Storage Link otomatis di public_html Hostinger
Route::get('/clear-config', function() {
    \Artisan::call('config:clear');
    \Artisan::call('config:cache');
    
    $target = storage_path('app/public');
    $shortcut = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    
    if (!file_exists($shortcut)) {
        symlink($target, $shortcut);
    }
    
    return "Konfigurasi bersih, cache diperbarui, dan Storage Link berhasil disinkronisasi!";
});


// =========================================================================
// 2. JALUR ADMIN (Akses Aman - Wajib Login Terlebih Dahulu)
// =========================================================================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Fitur Management Sertifikat Utama
    Route::get('/certificates', [CertificateController::class, 'index'])->name('admin.certificates.index');
    Route::get('/certificates/create', [CertificateController::class, 'create'])->name('admin.certificates.create');
    Route::post('/certificates/store', [CertificateController::class, 'store'])->name('admin.certificates.store');
    
    // Jalur Manipulasi Data (Edit, Update, dan Hapus)
    Route::get('/certificates/{id}/edit', [CertificateController::class, 'edit'])->name('admin.certificates.edit');
    Route::put('/certificates/{id}/update', [CertificateController::class, 'update'])->name('admin.certificates.update');
    Route::delete('/certificates/{id}/delete', [CertificateController::class, 'destroy'])->name('admin.certificates.destroy');
    Route::delete('/certificates/{id}', [CertificateController::class, 'destroy']); // Alternatif pemicu hapus data
    
});