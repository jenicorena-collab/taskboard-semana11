<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComercioController;
use App\Http\Controllers\TransaccionController;

Route::get('/', function () {
    return redirect()->route('comercios.show', 1);
});

Route::get('/comercios/{comercio}', [ComercioController::class, 'show'])->name('comercios.show');

Route::get('/transacciones/crear', [TransaccionController::class, 'create'])->name('transacciones.create');
Route::post('/transacciones', [TransaccionController::class, 'store'])->name('transacciones.store');

Route::get('/transacciones/{transaccion}/editar', [TransaccionController::class, 'edit'])->name('transacciones.edit');
Route::put('/transacciones/{transaccion}', [TransaccionController::class, 'update'])->name('transacciones.update');
Route::delete('/transacciones/{transaccion}', [TransaccionController::class, 'destroy'])->name('transacciones.destroy');

Route::patch('/transacciones/{transaccion}/mover/{estado}', [TransaccionController::class, 'moverEstado'])->name('transacciones.mover');