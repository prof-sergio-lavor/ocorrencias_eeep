@extends('layouts.app')

@section('conteudo')
<div class="container-fluid">
    <h3 class="fw-bold text-success mb-4">Editar Aluno</h3>

    <form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $aluno->nome }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">E-mail</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $aluno->email }}" required>
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" name="telefone" id="telefone" class="form-control" value="{{ $aluno->telefone }}">
        </div>

        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso</label>
            <select name="curso_id" id="curso_id" class="form-select" required>
                <option value="">-- Selecione o curso --</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" @if($aluno->curso_id == $curso->id) selected @endif>{{ $curso->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="turma_id" class="form-label">Turma</label>
            <select name="turma_id" id="turma_id" class="form-select" required>
                <option value="">-- Selecione a turma --</option>
                @foreach($turmas as $turma)
                    <option value="{{ $turma->id }}" @if($aluno->turma_id == $turma->id) selected @endif>{{ $turma->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha (deixe em branco para manter a atual)</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('alunos.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-success">Atualizar</button>
        </div>
    </form>
</div>
@endsection
