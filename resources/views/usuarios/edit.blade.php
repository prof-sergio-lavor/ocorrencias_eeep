@extends('layouts.app')

@section('conteudo')
<div class="container-fluid">
    <h3 class="fw-bold text-primary mb-4">Editar Usuário</h3>

    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="nome" class="form-label">Nome completo</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $usuario->nome) }}" required>
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="telefone" class="form-label">Telefone</label>
                <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone', $usuario->telefone) }}">
            </div>

            <div class="col-md-6">
                <label for="tipo" class="form-label">Tipo de usuário</label>
                <select name="tipo" id="tipo" class="form-select" required>
                    <option value="">-- Selecione --</option>
                    @foreach(['administrador', 'diretor', 'coordenador', 'professor', 'professor_diretor_turma', 'aluno'] as $tipo)
                        <option value="{{ $tipo }}" {{ $usuario->tipo === $tipo ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('_', ' ', $tipo)) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="senha" class="form-label">Nova Senha (opcional)</label>
                <input type="password" name="senha" id="senha" class="form-control" placeholder="Deixe em branco para manter a atual">
            </div>

            <div class="col-md-6">
                <label for="foto" class="form-label">Nova Foto (opcional)</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                @if($usuario->foto)
                    <small class="text-muted">Foto atual:</small><br>
                    <img src="{{ asset('storage/' . $usuario->foto) }}" width="70" class="mt-2 rounded">
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('usuarios.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-primary">Atualizar</button>
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
            title: 'Erro ao atualizar',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#d33',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endpush
