@extends('layouts.app')

@section('conteudo')
    <div class="container">
        <h2 class="mb-4 text-success">Painel do Diretor</h2>

        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-journal-bookmark-fill fs-1 text-success"></i>
                        <h5 class="card-title mt-3">Gerenciar Cursos</h5>
                        <a href="{{ route('cursos.index') }}" class="btn btn-outline-success mt-2">Acessar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="bi bi-people-fill fs-1 text-success"></i>
                        <h5 class="card-title mt-3">Gerenciar Turmas</h5>
                        <a href="{{ route('turmas.index') }}" class="btn btn-outline-success mt-2">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
