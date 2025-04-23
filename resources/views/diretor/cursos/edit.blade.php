@extends('layouts.app')

@section('conteudo')
<div class="container">
    <h4 class="mb-4">Editar Curso</h4>

    <form action="{{ route('cursos.update', $curso->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Curso</label>
            <input type="text" name="nome" id="nome" value="{{ $curso->nome }}" class="form-control" required>
        </div>

        <a href="{{ route('cursos.index') }}" class="btn btn-secondary">Cancelar</a>
        <button type="submit" class="btn btn-primary">Atualizar</button>
    </form>
</div>
@endsection
