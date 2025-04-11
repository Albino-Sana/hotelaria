<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelConfigController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\TipoQuartoController;
use App\Http\Controllers\QuartoController;
use App\Http\Controllers\ReservaController;

Route::get('/', function () {
    return view('auth.login');
});

// Rota para o dashboard (após login)
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotas para usuários
Route::middleware(['auth'])->group(function () {
    Route::get('usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('usuarios/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::get('usuarios/{usuario}', [UserController::class, 'show'])->name('usuarios.show');
    Route::get('usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');
});

// Rotas para funcionários
Route::middleware(['auth'])->group(function () {
    Route::resource('funcionarios', FuncionarioController::class);
});

// Rotas para cargos
Route::middleware(['auth'])->group(function () {
    Route::resource('cargos', CargoController::class);
});

// Rotas para tipos de quartos
Route::middleware(['auth'])->group(function () {
    Route::resource('tipos-quartos', TipoQuartoController::class);
});

// Rotas para quartos
Route::middleware(['auth'])->group(function () {
    Route::resource('quartos', QuartoController::class);
});

Route::resource('reservas', ReservaController::class)->middleware('auth');

// Para cancelar a reserva
Route::delete('/reservas/{id}', [ReservaController::class, 'destroy'])->name('reservas.destroy');

// Para finalizar a reserva
Route::post('/reservas/{id}/finalizar', [ReservaController::class, 'finalizar'])->name('reservas.finalizar');

// Para realizar o check-in (alterar status para "Ocupado")
Route::post('/reservas/{id}/checkin', [ReservaController::class, 'checkin'])->name('reservas.checkin');


// Rota para configurações do hotel
Route::get('/header/configuracoes', [HotelConfigController::class, 'index'])->name('hotel.config');

require __DIR__.'/auth.php';
