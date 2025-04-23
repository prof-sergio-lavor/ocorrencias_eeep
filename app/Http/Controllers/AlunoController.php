<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use Illuminate\Http\RedirectResponse;
use App\Models\Curso;
use App\Models\Turma;

class AlunoController extends Controller
{
    // Listar todos os alunos com filtros, busca e dados para gráfico
    public function index(Request $request)
    {
        $query = Aluno::with('curso', 'turma');

        if ($request->filled('curso_id')) {
            $query->where('curso_id', $request->curso_id);
        }

        if ($request->filled('turma_id')) {
            $query->where('turma_id', $request->turma_id);
        }

        if ($request->filled('busca')) {
            $query->where(function ($q) use ($request) {
                $q->where('nome', 'like', "%{$request->busca}%")
                  ->orWhere('email', 'like', "%{$request->busca}%");
            });
        }

        // ✅ ALTERADO: get() → paginate(10) para funcionar com links()
        $alunos = $query->paginate(10);
        $cursos = Curso::all();
        $turmas = Turma::all();

        $alunosPorCurso = Aluno::with('curso')
            ->selectRaw('curso_id, COUNT(*) as total')
            ->groupBy('curso_id')
            ->get();

        // ✅ Adicionado dados do gráfico para view
        $dadosGrafico = [
            'labels' => $alunosPorCurso->map(fn($item) => $item->curso->nome),
            'valores' => $alunosPorCurso->pluck('total')
        ];

        return view('diretor.alunos.index', compact('alunos', 'cursos', 'turmas', 'dadosGrafico'));
    }

    // ✅ NOVO: Dados do gráfico para o dashboard
    public function dadosGrafico()
    {
        $alunosPorCurso = Aluno::with('curso')
            ->selectRaw('curso_id, COUNT(*) as total')
            ->groupBy('curso_id')
            ->get();

        $labels = [];
        $valores = [];

        foreach ($alunosPorCurso as $item) {
            $labels[] = $item->curso->nome ?? 'Sem Curso';
            $valores[] = $item->total;
        }

        return response()->json([
            'labels' => $labels,
            'valores' => $valores
        ]);
    }

    // Exibir formulário de cadastro
    public function create()
    {
        $cursos = Curso::all();
        $turmas = Turma::all();
        return view('diretor.alunos.create', compact('cursos', 'turmas'));
    }

    // Salvar novo aluno
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email',
            'telefone' => 'nullable|string|max:20',
            'curso_id' => 'required|exists:cursos,id',
            'turma_id' => 'required|exists:turmas,id',
            'senha' => 'required|string|min:6',
        ], [
            'email.unique' => 'O campo e-mail já está em uso.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'nome.required' => 'O campo nome é obrigatório.',
            'senha.required' => 'O campo senha é obrigatório.',
            'senha.min' => 'A senha deve ter no mínimo 6 caracteres.'
        ]);

        Aluno::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'curso_id' => $request->curso_id,
            'turma_id' => $request->turma_id,
            'senha' => bcrypt($request->senha),
        ]);

        return redirect()
            ->route('alunos.index')
            ->with('success', 'Aluno cadastrado com sucesso!');
    }

    // Exibir formulário de edição
    public function edit($id)
    {
        $aluno = Aluno::findOrFail($id);
        $cursos = Curso::all();
        $turmas = Turma::all();

        return view('diretor.alunos.edit', compact('aluno', 'cursos', 'turmas'));
    }

    // Atualizar dados do aluno
    public function update(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:alunos,email,' . $aluno->id,
            'telefone' => 'nullable|string|max:20',
            'curso_id' => 'required|exists:cursos,id',
            'turma_id' => 'required|exists:turmas,id',
            'senha' => 'nullable|string|min:6',
        ]);

        $aluno->nome = $request->nome;
        $aluno->email = $request->email;
        $aluno->telefone = $request->telefone;
        $aluno->curso_id = $request->curso_id;
        $aluno->turma_id = $request->turma_id;

        if ($request->filled('senha')) {
            $aluno->senha = bcrypt($request->senha);
        }

        $aluno->save();

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    // Excluir aluno
    public function destroy($id)
    {
        $aluno = Aluno::findOrFail($id);
        $aluno->delete();

        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso!');
    }
}
