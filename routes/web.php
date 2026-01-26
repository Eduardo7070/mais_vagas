<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VagasController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [VagasController::class, 'index'])->name('home');
        Route::get('/sobreVaga/{vagas_id}', [VagasController::class, 'indexSobreVaga'])->name('sobreVaga');
        Route::post('/cadastrarVaga', [VagasController::class, 'cadastrarParaVaga']);
    });
});

require __DIR__.'/settings.php';
