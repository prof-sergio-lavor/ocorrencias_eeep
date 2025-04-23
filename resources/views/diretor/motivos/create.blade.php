@extends('layouts.app')

@section('conteudo')
<div class="container mt-4">
    <h4>Cadastrar Motivo de Ocorrência</h4>

    <form action="{{ route('motivos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Motivo</label>
            <input type="text" class="form-control" name="nome" required>
        </div>

        <div class="mb-3">
            <label for="gravidade" class="form-label">Gravidade</label>
            <select class="form-select" name="gravidade" required>
                <option value="">Selecione</option>
                <option value="leve">Leve</option>
                <option value="media">Média</option>
                <option value="grave">Grave</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection
