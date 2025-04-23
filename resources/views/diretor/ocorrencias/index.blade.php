@extends('layouts.app')

@section('conteudo')
<div class="container mt-4">
    <h3 class="mb-4">Lista de Ocorrências</h3>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: '{{ session("success") }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif

    <a href="{{ route('ocorrencias.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle"></i> Nova Ocorrência
    </a>

    <table class="table table-bordered table-hover">
        <thead class="table-success">
            <tr>
                <th>Aluno</th>
                <th>Motivo</th>
                <th>Data</th>
                <th>Tipo</th>
                <th>Status</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ocorrencias as $ocorrencia)
                <tr>
                    <td>{{ $ocorrencia->aluno->nome ?? '-' }}</td>
                    <td>{{ $ocorrencia->motivo->nome ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($ocorrencia->data)->format('d/m/Y') }}</td>
                    <td>{{ $ocorrencia->tipo ?? '-' }}</td>
                    <td>{{ $ocorrencia->status ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('ocorrencias.edit', $ocorrencia->id) }}" class="btn btn-sm btn-primary me-1">
                            <i class="fas fa-pen"></i>
                        </a>
                        <button class="btn btn-sm btn-danger" onclick="confirmarExclusao({{ $ocorrencia->id }})">
                            <i class="fas fa-trash"></i>
                        </button>
                        <form id="form-excluir-{{ $ocorrencia->id }}" action="{{ route('ocorrencias.destroy', $ocorrencia->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Nenhuma ocorrência encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmarExclusao(id) {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Essa ação não poderá ser desfeita!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-excluir-' + id).submit();
            }
        });
    }
</script>
@endpush
