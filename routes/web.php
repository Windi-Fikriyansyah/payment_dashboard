<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

    // Projects
    Route::get('/proyek', [\App\Http\Controllers\ProjectController::class, 'index'])->name('proyek.index');
    Route::post('/proyek', [\App\Http\Controllers\ProjectController::class, 'store'])->name('proyek.store');
    Route::get('/proyek/data', [\App\Http\Controllers\ProjectController::class, 'data'])->name('proyek.data');
    Route::get('/proyek/{id}', [\App\Http\Controllers\ProjectController::class, 'show'])->name('proyek.show');
    Route::post('/proyek/{id}', [\App\Http\Controllers\ProjectController::class, 'update'])->name('proyek.update');
    Route::delete('/proyek/{id}', [\App\Http\Controllers\ProjectController::class, 'destroy'])->name('proyek.destroy');
    
    // Project Payment Methods
    Route::get('/proyek/{id}/pembayaran', [\App\Http\Controllers\ProjectController::class, 'paymentMethods'])->name('proyek.pembayaran');
    Route::post('/proyek/{id}/pembayaran/toggle', [\App\Http\Controllers\ProjectController::class, 'togglePaymentMethod'])->name('proyek.pembayaran.toggle');
    
    // Transaksi
    Route::get('/transaksi', [\App\Http\Controllers\TransactionController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/data', [\App\Http\Controllers\TransactionController::class, 'data'])->name('transaksi.data');
    Route::get('/transaksi/{id}', [\App\Http\Controllers\TransactionController::class, 'show'])->name('transaksi.show');

    // Transaksi API
    Route::get('/transaksi-api', [\App\Http\Controllers\TransactionControllerApi::class, 'index'])->name('transaksi_api.index');
    Route::get('/transaksi-api/data', [\App\Http\Controllers\TransactionControllerApi::class, 'data'])->name('transaksi_api.data');
    Route::get('/transaksi-api/{id}', [\App\Http\Controllers\TransactionControllerApi::class, 'show'])->name('transaksi_api.show');

    // Rekening Bank
    Route::get('/rekening-bank', [\App\Http\Controllers\RekeningBankController::class, 'index'])->name('rekening.index');
    Route::get('/rekening-bank/data', [\App\Http\Controllers\RekeningBankController::class, 'data'])->name('rekening.data');
    Route::post('/rekening-bank', [\App\Http\Controllers\RekeningBankController::class, 'store'])->name('rekening.store');
    Route::delete('/rekening-bank/{id}', [\App\Http\Controllers\RekeningBankController::class, 'destroy'])->name('rekening.destroy');
});

require __DIR__.'/auth.php';
