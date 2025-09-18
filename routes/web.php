<?php

use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChronologicalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/form', [PDFController::class, 'form'])->name('form');
    Route::post('/generate-pdf', [PDFController::class, 'generatePDF'])->name('generate.pdf');
});

Route::middleware('auth')->group(function () {
    Route::post('/chronology/{uuid}/upload', [ChronologicalController::class, 'upload'])->name('chronology.upload');
    Route::get('/chronology/{uuid}/edit', [ChronologicalController::class, 'edit'])->name('chronology.edit');
    Route::put('/chronology/{uuid}', [ChronologicalController::class, 'update'])->name('chronology.update');
    Route::get('/chronology', [ChronologicalController::class, 'index'])->name('chronology.index');
    Route::get('/chronology/create', [ChronologicalController::class, 'create'])->name('chronology.create');
    Route::post('/chronology/store', [ChronologicalController::class, 'store'])->name('chronology.store');
    Route::get('/chronlogy/{chronology}/preview', [ChronologicalController::class, 'preview'])->name('chronology.preview');
    Route::get('/chronology/{chronology:uuid}/download', [ChronologicalController::class, 'download'])->name('chronology.download');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::get('/', function() {
    return view('about');
})->name('about');

require __DIR__ . '/auth.php';
