@extends('layouts.app')

@section('conteudo')
<div class="container">
    <h3 class="mb-4 text-success">Cadastrar Nova Turma</h3>

    <form action="{{ route('turmas.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Turma</label>
        <input type="text" class="form-control" id="nome" name="nome" required>
    </div>

    <div class="mb-3">
        <label for="curso_id" class="form-label">Curso</label>
        <select class="form-select" id="curso_id" name="curso_id" required>
            <option value="">-- Selecione o curso --</option>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}">{{ $curso->nome }}</option>
            @endforeach
        </select>
    </div>

    <a href="{{ route('turmas.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-success">Salvar</button>
</form>

</div>
@endsection
