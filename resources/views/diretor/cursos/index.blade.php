@extends('layouts.app')

@section('conteudo')
<div class="container-fluid">
    <h3 class="fw-bold text-success mb-4">Cursos Cadastrados</h3>

    <div class="mb-3 text-end">
        <a href="{{ route('cursos.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Novo Curso
        </a>
    </div>

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

    <div class="table-responsive">
        <table class="table table-bordered align-middle bg-white shadow-sm">
            <thead class="table-success">
                <tr>
                    <th>Nome do Curso</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cursos as $curso)
                <tr>
                    <td>{{ $curso->nome }}</td>
                    <td class="text-center">
                        <a href="{{ route('cursos.edit', $curso->id) }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('cursos.destroy', $curso->id) }}" method="POST" class="d-inline-block form-excluir">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="text-center text-muted">Nenhum curso cadastrado.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.form-excluir').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Tem certeza?',
                text: "O curso será removido permanentemente!",
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
