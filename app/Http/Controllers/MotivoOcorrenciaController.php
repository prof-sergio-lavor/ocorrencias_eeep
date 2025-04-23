<?php

namespace App\Http\Controllers;

use App\Models\MotivoOcorrencia;
use Illuminate\Http\Request;

class MotivoOcorrenciaController extends Controller
{
    public function index()
    {
        $motivos = MotivoOcorrencia::all();
        return view('diretor.motivos.index', compact('motivos'));
    }

    public function create()
    {
        return view('diretor.motivos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'gravidade' => 'required|in:leve,media,grave',
        ]);

        MotivoOcorrencia::create($request->all());

        return redirect()->route('motivos.index')->with('success', 'Motivo cadastrado com sucesso!');
    }
}
