<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use App\Models\Curso;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    // Listar turmas
    public function index()
    {
        $turmas = Turma::with('curso')->get();
        return view('diretor.turmas.index', compact('turmas'));
    }

    // Formulário de cadastro
    public function create()
    {
        $cursos = Curso::all();
        return view('diretor.turmas.create', compact('cursos'));
    }

    // Salvar nova turma
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id'
        ]);
    
        Turma::create([
            'nome' => $request->nome,
            'curso_id' => $request->curso_id
        ]);
    
        return redirect()->route('turmas.index')->with('success', 'Turma cadastrada com sucesso!');
    }
    

    // Formulário de edição
    public function edit($id)
    {
        $turma = Turma::findOrFail($id);
        $cursos = Curso::all();
    
        return view('diretor.turmas.edit', compact('turma', 'cursos'));
    }
    

    // Atualizar turma
    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso_id' => 'required|exists:cursos,id',
        ]);
    
        $turma = Turma::findOrFail($id);
        $turma->update($request->only('nome', 'curso_id'));
    
        return redirect()->route('turmas.index')->with('success', 'Turma atualizada com sucesso!');
    }
   // AJAX - Retorna turmas por curso (para o select dinâmico)
public function getTurmasPorCurso($curso_id)
{
    $turmas = Turma::where('curso_id', $curso_id)->get();
    return response()->json($turmas);
}


    
    // Excluir turma
    public function destroy($id)
    {
        $turma = Turma::findOrFail($id);
        $turma->delete();

        return redirect()->route('turmas.index')->with('success', 'Turma excluída com sucesso!');
    }
}
