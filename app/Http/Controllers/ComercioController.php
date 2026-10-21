<?php

namespace App\Http\Controllers;

use App\Models\Comercio;

class ComercioController extends Controller
{
    public function show(Comercio $comercio)
    {
        $comercio->load('transacciones');
        return view('comercios.show', compact('comercio'));
    }
}
