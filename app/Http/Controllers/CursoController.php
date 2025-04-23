<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CursoController extends Controller
{
    // Lista todos os cursos
    public function index(): View
    {
        $cursos = Curso::all();
        return view('diretor.cursos.index', compact('cursos'));
    }

    // Formulário de criação de curso
    public function create(): View
    {
        return view('diretor.cursos.create');
    }

    // Salvar novo curso
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:cursos,nome'
        ]);

        Curso::create([
            'nome' => $request->nome
        ]);

        return redirect()->route('cursos.index')->with('success', 'Curso cadastrado com sucesso!');
    }

    // Formulário de edição
    public function edit($id): View
    {
        $curso = Curso::findOrFail($id);
        return view('diretor.cursos.edit', compact('curso'));
    }

    // Atualizar curso
    public function update(Request $request, $id): RedirectResponse
    {
        $curso = Curso::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255|unique:cursos,nome,' . $curso->id
        ]);

        $curso->update([
            'nome' => $request->nome
        ]);

        return redirect()->route('cursos.index')->with('success', 'Curso atualizado com sucesso!');
    }

    // Excluir curso
    public function destroy($id): RedirectResponse
    {
        $curso = Curso::findOrFail($id);
        $curso->delete();

        return redirect()->route('cursos.index')->with('success', 'Curso excluído com sucesso!');
    }
}
