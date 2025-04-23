@extends('layouts.app')

@section('conteudo')
    <h2>Bem-vindo, {{ session('usuario_nome') }}!</h2>
    <p>Você está logado como <strong>{{ session('usuario_tipo') }}</strong>.</p>
@endsection
