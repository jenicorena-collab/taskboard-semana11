@extends('layouts.app')

@section('contenido')
<h1>Editar Transacción</h1>

<form action="{{ route('transacciones.update', $transaccion) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="comercio_id" value="{{ $transaccion->comercio_id }}">

    <div class="form-group">
        <label>Cliente</label>
        <input type="text" name="cliente_nombre" value="{{ old('cliente_nombre', $transaccion->cliente_nombre) }}">
        @error('cliente_nombre') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Monto</label>
        <input type="number" step="0.01" name="monto" value="{{ old('monto', $transaccion->monto) }}">
        @error('monto') <span class="error">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Guardar cambios</button>
    <a href="{{ route('comercios.show', $transaccion->comercio_id) }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
