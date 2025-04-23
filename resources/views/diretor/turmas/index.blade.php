@extends('layouts.app')

@section('conteudo')
<div class="container-fluid">
    <h3 class="fw-bold text-success mb-4">Lista de Turmas</h3>

    <a href="{{ route('turmas.create') }}" class="btn btn-success mb-3">+ Nova Turma</a>

    <table class="table table-bordered align-middle shadow-sm bg-white">
        <thead class="table-success">
            <tr>
                <th>Nome</th>
                <th>Curso</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($turmas as $turma)
            <tr>
                <td>{{ $turma->nome }}</td>
                <td>{{ $turma->curso->nome }}</td>
                <td class="text-center">
                    <a href="{{ route('turmas.edit', $turma->id) }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <form action="{{ route('turmas.destroy', $turma->id) }}" method="POST" class="d-inline-block form-excluir">
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
@endsection

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Alerta de sucesso -->
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Sucesso!',
        text: "{{ session('success') }}",
        confirmButtonColor: '#198754',
        confirmButtonText: 'OK'
    });
</script>
@endif

<!-- Confirmação de exclusão -->
<script>
    document.querySelectorAll('.form-excluir').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá desfazer essa ação!",
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
