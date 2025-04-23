@extends('layouts.app')

@section('conteudo')
<div class="container-fluid">
    <h3 class="fw-bold text-success mb-4">Cadastrar Novo Usuário</h3>

    <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
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
                <input type="text" name="telefone" id="telefone" class="form-control">
            </div>

            <div class="col-md-6">
                <label for="tipo" class="form-label">Tipo de usuário</label>
                <select name="tipo" id="tipo" class="form-select" required>
                    <option value="">-- Selecione --</option>
                    <option value="administrador">Administrador</option>
                    <option value="diretor">Diretor</option>
                    <option value="coordenador">Coordenador</option>
                    <option value="professor">Professor</option>
                    <option value="professor_diretor_turma">Professor Diretor de Turma</option>
                    <option value="aluno">Aluno</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" id="senha" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="foto" class="form-label">Foto (opcional)</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Erro no cadastro',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endpush
