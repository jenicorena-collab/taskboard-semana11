@extends('layouts.app')

@section('contenido')
<h1>Nueva Transacción</h1>

<form action="{{ route('transacciones.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Comercio</label>
        <select name="comercio_id">
            @foreach($comercios as $comercio)
                <option value="{{ $comercio->id }}" {{ old('comercio_id') == $comercio->id ? 'selected' : '' }}>
                    {{ $comercio->nombre_comercio }}
                </option>
            @endforeach
        </select>
        @error('comercio_id') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Cliente</label>
        <input type="text" name="cliente_nombre" value="{{ old('cliente_nombre') }}">
        @error('cliente_nombre') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Monto</label>
        <input type="number" step="0.01" name="monto" value="{{ old('monto') }}">
        @error('monto') <span class="error">{{ $message }}</span> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Guardar Transacción</button>
</form>
@endsection
