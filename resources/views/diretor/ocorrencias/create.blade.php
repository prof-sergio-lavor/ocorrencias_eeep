@extends('layouts.app')

@section('conteudo')
<div class="container mt-4">
    <h3 class="mb-4">Registrar Ocorrência</h3>

    {{-- SweetAlert de sucesso --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    {{-- Exibir erros de validação --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ocorrencias.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="curso_id" class="form-label">Curso</label>
                <select name="curso_id" id="curso_id" class="form-select" required>
                    <option value="">Selecione o curso</option>
                    @foreach($cursos as $curso)
                        <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="turma_id" class="form-label">Turma</label>
                <select name="turma_id" id="turma_id" class="form-select" required>
                    <option value="">Selecione a turma</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="aluno_id" class="form-label">Aluno</label>
                <select name="aluno_id" id="aluno_id" class="form-select" required>
                    <option value="">Selecione o aluno</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="motivo_id" class="form-label">Motivo</label>
                <select name="motivo_id" id="motivo_id" class="form-select" required>
                    <option value="">Selecione o motivo</option>
                    @foreach($motivos as $motivo)
                        <option value="{{ $motivo->id }}" data-gravidade="{{ $motivo->gravidade }}">{{ $motivo->nome }}</option>
                    @endforeach
                    <option value="outro">Outro</option>
                </select>
            </div>

            <div class="col-md-4">
                <label for="tipo" class="form-label">Gravidade</label>
                <input type="text" name="tipo" id="tipo" class="form-control" readonly>
            </div>

            <div class="col-md-4">
                <label for="registro_tipo" class="form-label">Tipo de Registro</label>
                <select name="registro_tipo" id="registro_tipo" class="form-select" required>
                    <option value="ocorrencia">Ocorrência</option>
                    <option value="intervencao">Intervenção</option>
                </select>
            </div>
        </div>

        <div id="campo_outro_motivo" class="mb-3" style="display: none;">
            <label for="descricao_outro" class="form-label">Especifique o motivo</label>
            <input type="text" name="descricao_outro" class="form-control">
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="data" class="form-label">Data</label>
                <input type="date" name="data" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" name="hora" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="4" placeholder="Descreva a ocorrência..."></textarea>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('curso_id').addEventListener('change', function () {
    const cursoId = this.value;
    fetch(`/ajax/turmas-por-curso/${cursoId}`)
        .then(res => res.json())
        .then(turmas => {
            const turmaSelect = document.getElementById('turma_id');
            turmaSelect.innerHTML = '<option value="">Selecione a turma</option>';
            turmas.forEach(turma => {
                turmaSelect.innerHTML += `<option value="${turma.id}">${turma.nome}</option>`;
            });
        });
});

document.getElementById('turma_id').addEventListener('change', function () {
    const cursoId = document.getElementById('curso_id').value;
    const turmaId = this.value;
    fetch(`/ajax/alunos-por-turma?curso_id=${cursoId}&turma_id=${turmaId}`)
        .then(res => res.json())
        .then(alunos => {
            const alunoSelect = document.getElementById('aluno_id');
            alunoSelect.innerHTML = '<option value="">Selecione o aluno</option>';
            alunos.forEach(aluno => {
                alunoSelect.innerHTML += `<option value="${aluno.id}">${aluno.nome}</option>`;
            });
        });
});

document.getElementById('motivo_id').addEventListener('change', function () {
    const selected = this.options[this.selectedIndex];
    const gravidade = selected.getAttribute('data-gravidade');
    const tipoInput = document.getElementById('tipo');
    const registroTipo = document.getElementById('registro_tipo');

    tipoInput.value = gravidade || '';

    if (selected.value === 'outro') {
        document.getElementById('campo_outro_motivo').style.display = 'block';
    } else {
        document.getElementById('campo_outro_motivo').style.display = 'none';
    }

    if (gravidade === 'grave') {
        registroTipo.value = 'intervencao';
    } else {
        registroTipo.value = 'ocorrencia';
    }
});
</script>
@endpush
