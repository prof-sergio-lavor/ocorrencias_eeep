@extends('layouts.app')

@section('conteudo')
<div class="container">
    <h4 class="mb-4">Cadastrar Novo Curso</h4>

    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Curso</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
