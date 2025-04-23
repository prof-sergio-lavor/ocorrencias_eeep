<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\OcorrenciaController;
use App\Http\Controllers\MotivoOcorrenciaController;

// 🔐 LOGIN
Route::get('/login', [LoginController::class, 'showLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.enviar');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// 🧑 Painel conforme o tipo de usuário
Route::get('/painel/{tipo}', function ($tipo): View|string {
    if ($tipo === 'administrador') {
        return view('admin.dashboard');
    }
    if ($tipo === 'diretor') {
        return view('diretor.dashboard');
    }
    return "Painel para tipo $tipo ainda não criado.";
})->name('painel');

// 👤 CRUD de Usuários
Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');

// 📚 CRUD de Cursos
Route::get('/cursos', [CursoController::class, 'index'])->name('cursos.index');
Route::get('/cursos/create', [CursoController::class, 'create'])->name('cursos.create');
Route::post('/cursos', [CursoController::class, 'store'])->name('cursos.store');
Route::get('/cursos/{id}/edit', [CursoController::class, 'edit'])->name('cursos.edit');
Route::put('/cursos/{id}', [CursoController::class, 'update'])->name('cursos.update');
Route::delete('/cursos/{id}', [CursoController::class, 'destroy'])->name('cursos.destroy');

// 🏫 CRUD de Turmas
Route::get('/turmas', [TurmaController::class, 'index'])->name('turmas.index');
Route::get('/turmas/create', [TurmaController::class, 'create'])->name('turmas.create');
Route::post('/turmas', [TurmaController::class, 'store'])->name('turmas.store');
Route::get('/turmas/{id}/edit', [TurmaController::class, 'edit'])->name('turmas.edit');
Route::put('/turmas/{id}', [TurmaController::class, 'update'])->name('turmas.update');
Route::delete('/turmas/{id}', [TurmaController::class, 'destroy'])->name('turmas.destroy');

// 🎓 CRUD de Alunos
Route::get('/alunos', [AlunoController::class, 'index'])->name('alunos.index');
Route::get('/alunos/create', [AlunoController::class, 'create'])->name('alunos.create');
Route::post('/alunos', [AlunoController::class, 'store'])->name('alunos.store');
Route::get('/alunos/{id}/edit', [AlunoController::class, 'edit'])->name('alunos.edit');
Route::put('/alunos/{id}', [AlunoController::class, 'update'])->name('alunos.update');
Route::delete('/alunos/{id}', [AlunoController::class, 'destroy'])->name('alunos.destroy');

// Exportar PDF e Excel
Route::get('/alunos/export/pdf', [AlunoController::class, 'exportarPdf'])->name('alunos.export.pdf');
Route::get('/alunos/export/excel', [AlunoController::class, 'exportarExcel'])->name('alunos.export.excel');

// 📝 CRUD de Ocorrências
Route::get('/ocorrencias', [OcorrenciaController::class, 'index'])->name('ocorrencias.index');
Route::get('/ocorrencias/create', [OcorrenciaController::class, 'create'])->name('ocorrencias.create');
Route::post('/ocorrencias', [OcorrenciaController::class, 'store'])->name('ocorrencias.store');
Route::get('/ocorrencias/{id}/edit', [OcorrenciaController::class, 'edit'])->name('ocorrencias.edit');
Route::put('/ocorrencias/{id}', [OcorrenciaController::class, 'update'])->name('ocorrencias.update');
Route::delete('/ocorrencias/{id}', [OcorrenciaController::class, 'destroy'])->name('ocorrencias.destroy');

// 📌 CRUD de Motivos de Ocorrência
Route::get('/motivos', [MotivoOcorrenciaController::class, 'index'])->name('motivos.index');
Route::get('/motivos/create', [MotivoOcorrenciaController::class, 'create'])->name('motivos.create');
Route::post('/motivos', [MotivoOcorrenciaController::class, 'store'])->name('motivos.store');
Route::get('/motivos/{id}/edit', [MotivoOcorrenciaController::class, 'edit'])->name('motivos.edit');
Route::put('/motivos/{id}', [MotivoOcorrenciaController::class, 'update'])->name('motivos.update');
Route::delete('/motivos/{id}', [MotivoOcorrenciaController::class, 'destroy'])->name('motivos.destroy');

// 🔄 AJAX: Buscar turmas e alunos
Route::get('/ajax/turmas-por-curso/{curso_id}', [TurmaController::class, 'getTurmasPorCurso'])->name('ajax.turmas.por.curso');
Route::get('/ajax/alunos-por-turma', [OcorrenciaController::class, 'getAlunosPorCursoETurma'])->name('ajax.alunos.por.turma');
