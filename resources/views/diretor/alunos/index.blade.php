@extends('layouts.app')

@section('conteudo')
<div class="container-fluid">
    <h3 class="fw-bold text-success mb-4">Lista de Alunos</h3>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('alunos.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Novo Aluno
        </a>

        <div class="d-flex gap-2">
            <form method="GET" action="{{ route('alunos.index') }}" class="d-flex gap-2">
                <select name="curso_id" class="form-select">
                    <option value="">-- Curso --</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>{{ $curso->nome }}</option>
                    @endforeach
                </select>

                <select name="turma_id" class="form-select">
                    <option value="">-- Turma --</option>
                    @foreach($turmas as $turma)
                        <option value="{{ $turma->id }}" {{ request('turma_id') == $turma->id ? 'selected' : '' }}>{{ $turma->nome }}</option>
                    @endforeach
                </select>

                <input type="text" name="busca" value="{{ request('busca') }}" placeholder="Buscar por nome/email" class="form-control">
                <button type="submit" class="btn btn-primary">🔍</button>
            </form>

            <div>
                {{-- ✅ Botões de exportação --}}
                <a href="{{ route('alunos.export.pdf') }}" class="btn btn-outline-danger" title="Exportar PDF">
                    <i class="bi bi-file-earmark-pdf"></i>
                </a>
                <a href="{{ route('alunos.export.excel') }}" class="btn btn-outline-success" title="Exportar Excel">
                    <i class="bi bi-file-earmark-excel"></i>
                </a>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-hover align-middle bg-white shadow">
        <thead class="table-success">
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Turma</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alunos as $aluno)
                <tr>
                    <td>
                        @if($aluno->foto)
                            <img src="{{ asset('storage/' . $aluno->foto) }}" alt="Foto" width="30" class="rounded-circle me-2">
                        @else
                            <i class="bi bi-person-circle fs-5 me-2"></i>
                        @endif
                        {{ $aluno->nome }}
                    </td>
                    <td>{{ $aluno->email }}</td>
                    <td>{{ $aluno->telefone }}</td>
                    <td>{{ $aluno->curso->nome ?? '-' }}</td>
                    <td>{{ $aluno->turma->nome ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-sm btn-primary" title="Editar"><i class="bi bi-pencil"></i></a>
                        <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Excluir"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $alunos->links() }}
    </div>

    <div class="mt-5">
        <h5 class="text-center">Distribuição de Alunos por Curso</h5>
        <canvas id="graficoAlunosCurso" height="100"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoAlunosCurso');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($dadosGrafico['labels']) !!},
            datasets: [{
                label: 'Nº de Alunos',
                data: {!! json_encode($dadosGrafico['valores']) !!},
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush
