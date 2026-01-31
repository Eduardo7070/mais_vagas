<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curriculo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CurriculoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'cargo_desejado' => 'required|string|max:255',
            'resumo_profissional' => 'required|string',

            'experiencias' => 'nullable|array',
            'experiencias.*.cargo' => 'required|string|max:255',
            'experiencias.*.empresa' => 'required|string|max:255',
            'experiencias.*.periodo' => 'required|string|max:255',
            'experiencias.*.descricao' => 'nullable|string',

            'formacoes' => 'nullable|array',
            'formacoes.*.curso' => 'required|string|max:255',
            'formacoes.*.instituicao' => 'required|string|max:255',
            'formacoes.*.periodo' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {

            $curriculo = Curriculo::create([
                'user_id' => Auth::id(),
                'cargo_desejado' => $validated['cargo_desejado'],
                'resumo_profissional' => $validated['resumo_profissional'],
            ]);

            if (!empty($validated['experiencias'])) {

                foreach ($validated['experiencias'] as $exp) {

                    $curriculo->experiencias()->create($exp);
                }
            }

            if (!empty($validated['formacoes'])) {

                foreach ($validated['formacoes'] as $form) {

                    $curriculo->formacoes()->create($form);
                }
            }

            DB::commit();

            return redirect()
            ->route('user.home')
            ->with('success', 'Currículo criado com sucesso!');

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'error' => 'Erro ao salvar currículo',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

