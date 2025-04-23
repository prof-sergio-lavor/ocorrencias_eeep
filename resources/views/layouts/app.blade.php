<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Awesome para ícones dos botões -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .bg-verde-eeep {
            background-color: #1FA065;
        }

        .topbar {
            background: linear-gradient(90deg, #1FA065, #48C5C1);
            height: 60px;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
        }

        .sidebar {
            width: 250px;
            height: calc(100vh - 60px);
            background-color: #1FA065;
            color: #fff;
        }

        .sidebar .nav-link {
            color: #fff;
            padding: 10px;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background-color: #27AE60;
            color: #fff;
        }

        .logo-escola {
            width: 100%;
            max-width: 120px;
            margin: 20px auto;
            display: block;
        }

        .dropdown-menu {
            border-radius: 6px;
        }

        .dropdown-item:hover {
            background-color: #CFF3E8;
        }
    </style>
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <span class="fs-5 fw-bold">EEEP Leopoldina Gonçalves Quezado</span>
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
            {{ session('usuario_nome') ?? 'Usuário' }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Sair</a></li>
        </ul>
    </div>
</div>

<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar p-3">
        <img src="{{ asset('logo.jpg') }}" alt="Logo EEEP" class="logo-escola">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('painel', ['tipo' => session('usuario_tipo')]) }}" class="nav-link">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('usuarios.index') }}" class="nav-link">👥 Usuários</a>
            </li>

            @if(in_array(session('usuario_tipo'), ['diretor', 'coordenador']))
                <li class="nav-item">
                    <a href="{{ route('ocorrencias.index') }}" class="nav-link">
                        <i class="bi bi-journal-text"></i> Ocorrências
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('motivos.index') }}" class="nav-link">
                        <i class="bi bi-exclamation-circle"></i> Motivos
                    </a>
                </li>
            @endif

            @if(in_array(session('usuario_tipo'), ['administrador', 'diretor']))
                <li class="nav-item">
                    <a href="{{ route('cursos.index') }}" class="nav-link">📚 Cursos</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('turmas.index') }}" class="nav-link">🏫 Turmas</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('alunos.index') }}" class="nav-link">🎓 Alunos</a>
                </li>
            @endif
        </ul>
    </nav>

    <!-- Conteúdo -->
    <main class="p-4 w-100">
        @yield('conteudo')
    </main>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')
</body>
</html>
