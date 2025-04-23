@extends('layouts.app')

@section('conteudo')
<div class="container mt-4">
    <h4>Motivos de Ocorrência</h4>

    <a href="{{ route('motivos.create') }}" class="btn btn-primary mb-3">Novo Motivo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Motivo</th>
                <th>Gravidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach($motivos as $motivo)
            <tr>
                <td>{{ $motivo->nome }}</td>
                <td>{{ ucfirst($motivo->gravidade) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
