<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Vagas;
use App\Models\Companies;
use App\Models\CadastroVaga;
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

    public function cadastrarParaVaga(Request $request)
    {
        $request->validate([
            'companie_id' => 'required|exists:companies,companie_id',
            'vagas_id' => 'required|exists:vagas,vagas_id',
        ]);

        CadastroVaga::firstOrCreate([
            'companie_id' => $request->companie_id,
            'user_id'     => Auth::id(),
            'vagas_id'    => $request->vagas_id,
        ]);

        return redirect()
            ->route('user.home')
            ->with('success', 'Currículo enviado com sucesso!');
    }
}
