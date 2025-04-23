@extends('layouts.app')

@section('conteudo')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-success">Usuários do Sistema</h3>
        <a href="{{ route('usuarios.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Novo Usuário
        </a>
    </div>

    <!-- Filtro por tipo -->
    <form method="GET" action="{{ route('usuarios.index') }}" class="row g-3 mb-4">
    <div class="col-md-4">
        <select name="tipo" class="form-select">
            <option value="">-- Filtrar por tipo --</option>
            <option value="administrador" {{ request('tipo') == 'administrador' ? 'selected' : '' }}>Administrador</option>
            <option value="diretor" {{ request('tipo') == 'diretor' ? 'selected' : '' }}>Diretor</option>
            <option value="coordenador" {{ request('tipo') == 'coordenador' ? 'selected' : '' }}>Coordenador</option>
            <option value="professor" {{ request('tipo') == 'professor' ? 'selected' : '' }}>Professor</option>
            <option value="professor_diretor_turma" {{ request('tipo') == 'professor_diretor_turma' ? 'selected' : '' }}>Professor Diretor de Turma</option>
            <option value="aluno" {{ request('tipo') == 'aluno' ? 'selected' : '' }}>Aluno</option>
        </select>
    </div>

    <div class="col-md-4">
        <input type="text" name="busca" class="form-control" placeholder="Buscar por nome ou e-mail" value="{{ request('busca') }}">
    </div>

    <div class="col-md-2">
        <button class="btn btn-outline-success w-100" type="submit">
            <i class="bi bi-search"></i> Filtrar
        </button>
    </div>
</form>


    <!-- Tabela -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle shadow-sm bg-white">
            <thead class="table-success">
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Tipo</th>
                    <th>Telefone</th>
                    <th>Foto</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            @if($usuario->foto)
                                <img src="{{ asset('storage/' . $usuario->foto) }}" class="rounded-circle me-2" width="40" height="40">
                            @else
                                <img src="{{ asset('default-avatar.png') }}" class="rounded-circle me-2" width="40" height="40">
                            @endif
                            {{ $usuario->nome }}
                        </div>
                    </td>
                    <td>{{ $usuario->email }}</td>
                    <td class="text-capitalize">{{ str_replace('_', ' ', $usuario->tipo) }}</td>
                    <td>{{ $usuario->telefone }}</td>
                    <td>
                        @if($usuario->foto)
                            <img src="{{ asset('storage/' . $usuario->foto) }}" width="40" height="40" class="rounded-circle">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('usuarios.destroy', $usuario->id) }}" class="d-inline-block form-excluir">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Alerta de sucesso com SweetAlert2
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sucesso!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#198754',
            confirmButtonText: 'OK'
        });
    @endif

    // Confirmação de exclusão com SweetAlert2
    document.querySelectorAll('.form-excluir').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá desfazer isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endpush
