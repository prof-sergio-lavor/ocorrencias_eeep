@extends('layouts.app')

@section('conteudo')
<div class="container-fluid">
    <h3 class="fw-bold text-success mb-4">Cadastrar Novo Aluno</h3>

    <form action="{{ route('alunos.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome completo</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="tel" name="telefone" id="telefone" class="form-control" pattern="[0-9]{10,11}" 
                       oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Somente números" required>
            </div>

            <div class="col-md-6">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="curso_id" class="form-label">Curso</label>
                <select name="curso_id" id="curso_id" class="form-select" required>
                    <option value="">-- Selecione o Curso --</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="turma_id" class="form-label">Turma</label>
                <select name="turma_id" id="turma_id" class="form-select" required>
                    <option value="">-- Selecione a Turma --</option>
                </select>
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('alunos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Quando o curso for alterado, buscar as turmas
document.getElementById('curso_id').addEventListener('change', function () {
    const cursoId = this.value;
    const turmaSelect = document.getElementById('turma_id');

    turmaSelect.innerHTML = '<option value="">Carregando turmas...</option>';

    if (cursoId) {
        fetch(`/ajax/turmas-por-curso/${cursoId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na resposta do servidor');
                }
                return response.json();
            })
            .then(data => {
                turmaSelect.innerHTML = '<option value="">-- Selecione a Turma --</option>';
                data.forEach(turma => {
                    const option = document.createElement('option');
                    option.value = turma.id;
                    option.text = turma.nome;
                    turmaSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Erro ao buscar turmas:', error);
                turmaSelect.innerHTML = '<option value="">Erro ao carregar turmas</option>';
            });
    } else {
        turmaSelect.innerHTML = '<option value="">-- Selecione a Turma --</option>';
    }
});
</script>
@endpush
