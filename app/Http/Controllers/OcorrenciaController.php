<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ocorrencia;
use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Turma;
use App\Models\MotivoOcorrencia;

class OcorrenciaController extends Controller
{
    // 🔍 Listar todas as ocorrências
    public function index()
    {
        $ocorrencias = Ocorrencia::with('aluno', 'motivo')->get();
        return view('diretor.ocorrencias.index', compact('ocorrencias'));
    }

    // 📝 Formulário de criação de ocorrência
    public function create()
    {
        $cursos = Curso::all();
        $turmas = Turma::all();
        $motivos = MotivoOcorrencia::all();

        return view('diretor.ocorrencias.create', compact('cursos', 'turmas', 'motivos'));
    }

    // 💾 Salvar nova ocorrência
    public function store(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'motivo_id' => 'required|exists:motivos_ocorrencias,id',
            'descricao' => 'nullable|string',
            'data' => 'required|date',
            'hora' => 'required',
            'registro_tipo' => 'required|in:ocorrencia,intervencao',
        ]);

        $motivo = MotivoOcorrencia::find($request->motivo_id);
        $tipoGravidade = $motivo ? $motivo->gravidade : null;

        Ocorrencia::create([
            'aluno_id' => $request->aluno_id,
            'motivo_id' => $request->motivo_id,
            'descricao' => $request->descricao,
            'data' => $request->data,
            'hora' => $request->hora,
            'tipo' => $tipoGravidade,
            'registro_tipo' => $request->registro_tipo,
            'status' => 'pendente'
        ]);

        return redirect()->route('ocorrencias.index')->with('success', 'Ocorrência registrada com sucesso!');
    }

    // 🖊️ Formulário de edição de ocorrência
    public function edit($id)
    {
        $ocorrencia = Ocorrencia::findOrFail($id);
        $motivos = MotivoOcorrencia::all();
        $cursos = Curso::all();
        $turmas = Turma::all();
    
        // Carrega os alunos apenas da turma do aluno da ocorrência
        $alunos = Aluno::where('turma_id', $ocorrencia->aluno->turma_id)
                       ->where('curso_id', $ocorrencia->aluno->curso_id)
                       ->get();
    
        return view('diretor.ocorrencias.edit', compact('ocorrencia', 'motivos', 'cursos', 'turmas', 'alunos'));
    }
     

    // 🔄 Atualizar ocorrência
    public function update(Request $request, $id)
{
    $ocorrencia = Ocorrencia::findOrFail($id);

    $request->validate([
        'aluno_id' => 'required|exists:alunos,id',
        'motivo_id' => 'required|exists:motivos_ocorrencias,id',
        'descricao' => 'nullable|string',
        'data' => 'required|date',
        'hora' => 'required',
        'tipo' => 'required|string',
        'registro_tipo' => 'required|in:Ocorrência,Intervenção',
        'status' => 'nullable|string',
    ]);

    $ocorrencia->update($request->all());

    return redirect()->route('ocorrencias.index')->with('success', 'Ocorrência atualizada com sucesso!');
}


    // 🗑️ Excluir ocorrência
    public function destroy($id)
    {
        $ocorrencia = Ocorrencia::findOrFail($id);
        $ocorrencia->delete();

        return redirect()->route('ocorrencias.index')->with('success', 'Ocorrência excluída com sucesso!');
    }

    // 🔄 AJAX: Buscar alunos por curso e turma
    public function getAlunosPorCursoETurma(Request $request)
    {
        $cursoId = $request->input('curso_id');
        $turmaId = $request->input('turma_id');

        $alunos = Aluno::where('curso_id', $cursoId)
                        ->where('turma_id', $turmaId)
                        ->select('id', 'nome')
                        ->orderBy('nome')
                        ->get();

        return response()->json($alunos);
    }

    // 🔄 AJAX: Obter gravidade do motivo
    public function getTipoMotivo($id)
    {
        $motivo = MotivoOcorrencia::find($id);

        if (!$motivo) {
            return response()->json(['erro' => 'Motivo não encontrado'], 404);
        }

        return response()->json(['tipo' => $motivo->gravidade]);
    }
}
