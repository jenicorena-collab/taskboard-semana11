<?php

namespace App\Http\Controllers;

use App\Models\Transaccion;
use App\Models\Comercio;
use App\Http\Requests\StoreTransaccionRequest;

class TransaccionController extends Controller
{
    public function create()
    {
        $comercios = Comercio::orderBy('nombre_comercio')->get();
        return view('transacciones.create', compact('comercios'));
    }

    public function store(StoreTransaccionRequest $request)
    {
        Transaccion::create($request->validated());
        return redirect()->route('comercios.show', $request->comercio_id)
                         ->with('mensaje', 'Transacción creada correctamente.');
    }

    public function edit(Transaccion $transaccion)
    {
        $comercios = Comercio::orderBy('nombre_comercio')->get();
        return view('transacciones.edit', compact('transaccion', 'comercios'));
    }

    public function update(StoreTransaccionRequest $request, Transaccion $transaccion)
    {
        $transaccion->update($request->validated());

        return redirect()->route('comercios.show', $transaccion->comercio_id)
                         ->with('mensaje', 'Transacción actualizada correctamente.');
    }

    public function destroy(Transaccion $transaccion)
    {
        $comercioId = $transaccion->comercio_id;
        $transaccion->delete();

        return redirect()->route('comercios.show', $comercioId)
                         ->with('mensaje', 'Transacción eliminada.');
    }

    public function moverEstado(Transaccion $transaccion, string $estado)
    {
        $transiciones = [
            'Iniciada' => ['Completada', 'Fallida'],
            'Completada' => [],
            'Fallida' => ['Iniciada'],
        ];

        if (!in_array($estado, $transiciones[$transaccion->estado] ?? [])) {
            abort(400, "No se puede mover de {$transaccion->estado} a {$estado}.");
        }

        $transaccion->update(['estado' => $estado]);

        return redirect()->route('comercios.show', $transaccion->comercio_id)
                         ->with('mensaje', "Transacción movida a {$estado}.");
    }
}
