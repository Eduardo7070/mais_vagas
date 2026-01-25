<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vagas;
use App\Models\Companies;
use Illuminate\Support\Facades\Auth;

class VagasController extends Controller
{
    public function index()
    {
        $vagas = Vagas::with('company')
            ->where('area_vaga', 'Tecnologia')
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('users/Home', [
            'vagas' => $vagas,
        ]);
    }

    public function indexSobreVaga($vagas_id)
    {
        $vaga = Vagas::with('company')->findOrFail($vagas_id);

        return Inertia::render('users/SobreVaga', [
            'vaga' => $vaga,
        ]);
    }
}
