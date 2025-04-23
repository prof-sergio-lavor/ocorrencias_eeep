@extends('layouts.app')

@section('conteudo')
<div class="container mt-4">
    <h3 class="mb-4">Editar Ocorrência</h3>

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: '{{ session("success") }}',
                confirmButtonColor: '#3085d6'
            });
        </script>
    @endif

    {{-- Exibir erros de validação --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ocorrencias.update', $ocorrencia->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="aluno_id" class="form-label">Aluno</label>
                <select name="aluno_id" class="form-select" required>
    @foreach ($alunos as $aluno)
        <option value="{{ $aluno->id }}" {{ $ocorrencia->aluno_id == $aluno->id ? 'selected' : '' }}>
            {{ $aluno->nome }}
        </option>
    @endforeach
</select>

            </div>

            <div class="col-md-4">
                <label for="motivo_id" class="form-label">Motivo</label>
                <select name="motivo_id" id="motivo_id" class="form-select" required>
                    <option value="">Selecione o motivo</option>
                    @foreach ($motivos as $motivo)
                        <option value="{{ $motivo->id }}"
                            data-gravidade="{{ $motivo->gravidade }}"
                            {{ $motivo->id == $ocorrencia->motivo_id ? 'selected' : '' }}>
                            {{ $motivo->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="data" class="form-label">Data</label>
                <input type="date" name="data" id="data" class="form-control" value="{{ $ocorrencia->data }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" name="hora" id="hora" class="form-control" value="{{ $ocorrencia->hora }}" required>
            </div>

            <div class="col-md-4">
                <label for="tipo" class="form-label">Gravidade</label>
                <input type="text" name="tipo" id="tipo" class="form-control" value="{{ $ocorrencia->tipo }}" readonly>
            </div>

            <div class="col-md-4">
                <label for="registro_tipo" class="form-label">Tipo de Registro</label>
                <select name="registro_tipo" id="registro_tipo" class="form-select" required>
                    <option value="Ocorrência" {{ $ocorrencia->registro_tipo == 'Ocorrência' ? 'selected' : '' }}>Ocorrência</option>
                    <option value="Intervenção" {{ $ocorrencia->registro_tipo == 'Intervenção' ? 'selected' : '' }}>Intervenção</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" id="status" class="form-control" value="{{ $ocorrencia->status }}" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="4">{{ $ocorrencia->descricao }}</textarea>
        </div>

        <a href="{{ route('ocorrencias.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Cancelar
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-circle"></i> Atualizar
        </button>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('motivo_id').addEventListener('change', function () {
        const gravidade = this.options[this.selectedIndex].getAttribute('data-gravidade');
        document.getElementById('tipo').value = gravidade || '';

        if (gravidade === 'grave') {
            document.getElementById('registro_tipo').value = 'Intervenção';
        } else {
            document.getElementById('registro_tipo').value = 'Ocorrência';
        }
    });
</script>
@endpush
