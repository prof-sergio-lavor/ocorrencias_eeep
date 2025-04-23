@extends('layouts.app')

@section('conteudo')
<div class="container-fluid">
    <h3 class="fw-bold text-success mb-4">Editar Turma</h3>

    <form action="{{ route('turmas.update', $turma->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Turma</label>
            <input type="text" name="nome" id="nome" class="form-control" value="{{ $turma->nome }}" required>
        </div>

        <div class="mb-3">
            <label for="curso_id" class="form-label">Curso</label>
            <select name="curso_id" id="curso_id" class="form-select" required>
                <option value="">-- Selecione o curso --</option>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ $turma->curso_id == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-end">
            <a href="{{ route('turmas.index') }}" class="btn btn-secondary me-2">Cancelar</a>
            <button type="submit" class="btn btn-success">Salvar</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#198754',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endpush
