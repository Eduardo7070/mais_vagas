<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vagas;
use Illuminate\Support\Facades\Auth;

class VagasController extends Controller
{
    public function index()
    {
        $vagas = Vagas::with('companies')
            ->where('area_vaga', 'Tecnologia')
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('users/Home', [
            'vagas' => $vagas,
        ]);
    }
}
