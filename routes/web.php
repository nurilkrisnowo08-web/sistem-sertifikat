<?php

use App\Http\Controllers\CertificateController;
use Illuminate\Support\Facades\Route;

Route::get('/certificate/{certificate_number}', [CertificateController::class, 'show'])->name('certificates.show');

Route::prefix('admin')->group(function () {
    Route::get('/certificates', [CertificateController::class, 'index'])->name('admin.certificates.index');
    Route::get('/certificates/create', [CertificateController::class, 'create'])->name('admin.certificates.create');
    Route::post('/certificates/store', [CertificateController::class, 'store'])->name('admin.certificates.store');
    
    // Jalur Baru untuk Edit dan Delete
    Route::get('/certificates/{id}/edit', [CertificateController::class, 'edit'])->name('admin.certificates.edit');
    Route::put('/certificates/{id}/update', [CertificateController::class, 'update'])->name('admin.certificates.update');
    Route::delete('/certificates/{id}/delete', [CertificateController::class, 'destroy'])->name('admin.certificates.destroy');
    Route::delete('/admin/certificates/{id}', [CertificateController::class, 'destroy'])->name('admin.certificates.destroy');
});

Route::get('/', function () {
    return redirect()->route('admin.certificates.index');
});