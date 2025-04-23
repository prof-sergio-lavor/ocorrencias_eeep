<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistema de Ocorrências</title>

    <!-- Importa o CSS do Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">

    <!-- Card centralizado com sombra -->
    <div class="card shadow p-4" style="width: 350px;">
        <h4 class="text-center mb-4">Login</h4>

        <!-- Se houver erros, exibe a primeira mensagem -->
        @if($errors->any())
            <div class="alert alert-danger text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Formulário de login -->
        <form method="POST" action="{{ route('login.enviar') }}">
            @csrf <!-- Proteção contra ataques CSRF -->

            <!-- Campo de e-mail -->
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <!-- Campo de senha -->
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" name="senha" class="form-control" required>
            </div>

            <!-- Botão de envio -->
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
    </div>

</body>
</html>
