<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    // Exibe a lista de usuários
    public function index(Request $request): View
    {
        $tipo = $request->input('tipo');
        $busca = $request->input('busca');
    
        $query = Usuario::query();
    
        if ($tipo) {
            $query->where('tipo', $tipo);
        }
    
        if ($busca) {
            $query->where(function ($q) use ($busca) {
                $q->where('nome', 'like', "%$busca%")
                  ->orWhere('email', 'like', "%$busca%");
            });
        }
    
        $usuarios = $query->get();
    
        return view('usuarios.index', compact('usuarios', 'tipo', 'busca'));
    }
    
    

    // Exibe o formulário de cadastro
    public function create(): View
    {
        return view('usuarios.create');
    }

    // Salva o novo usuário
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'senha' => 'required|string|min:6',
            'telefone' => 'nullable|string|max:20',
            'tipo' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        }

        Usuario::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'senha' => bcrypt($request->senha),
            'telefone' => $request->telefone,
            'tipo' => $request->tipo,
            'foto' => $fotoPath
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    // Exibe o formulário de edição
    public function edit($id): View
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    // Atualiza os dados do usuário
    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'senha' => 'nullable|string|min:6',
            'telefone' => 'nullable|string|max:20',
            'tipo' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($usuario->foto && Storage::disk('public')->exists($usuario->foto)) {
                Storage::disk('public')->delete($usuario->foto);
            }
            $usuario->foto = $request->file('foto')->store('fotos', 'public');
        }

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->telefone = $request->telefone;
        $usuario->tipo = $request->tipo;

        if ($request->filled('senha')) {
            $usuario->senha = bcrypt($request->senha);
        }

        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    // Exclui um usuário
    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->foto && Storage::disk('public')->exists($usuario->foto)) {
            Storage::disk('public')->delete($usuario->foto);
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
