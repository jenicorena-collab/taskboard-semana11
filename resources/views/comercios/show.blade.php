@extends('layouts.app')

@section('contenido')
<h1>Panel de Comercio: {{ $comercio->nombre_comercio }}</h1>

<a href="{{ route('transacciones.create') }}" class="btn btn-primary" style="margin-bottom: 15px;">+ Nueva Transacción</a>

<table>
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Monto</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($comercio->transacciones as $t)
        <tr>
            <td>{{ $t->cliente_nombre }}</td>
            <td>${{ number_format($t->monto, 2) }}</td>
            <td><strong>{{ $t->estado }}</strong></td>
            <td>
                <!-- Editar -->
                <a href="{{ route('transacciones.edit', $t) }}" class="btn btn-warning">Editar</a>

                <!-- Eliminar -->
                <form action="{{ route('transacciones.destroy', $t) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar esta transacción? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>

                <!-- Mover Estado -->
                @if ($t->estado === 'Iniciada')
                    <form action="{{ route('transacciones.mover', [$t, 'Completada']) }}" method="POST" style="display:inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Marcar Completada</button>
                    </form>

                    <form action="{{ route('transacciones.mover', [$t, 'Fallida']) }}" method="POST" style="display:inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-secondary">Marcar Fallida</button>
                    </form>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">No hay transacciones registradas para este comercio.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
