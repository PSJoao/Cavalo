<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PratoController extends Controller
{
    public function index()
    {
        $pratos = Prato::orderBy('nome')->get();
        return view('pratos.index', ['pratos' => $pratos]);
    }

    public function create()
    {
        return view('pratos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            $caminhoImagem = $request->file('imagem')->store('imagens_pratos', 'public');
            $dados['imagem'] = $caminhoImagem;
        }

        Prato::create($dados);

        return redirect()->route('pratos.index')->with('success', 'Prato cadastrado com sucesso!');
    }

    public function show(Prato $prato)
    {
        return view('pratos.show', ['prato' => $prato]);
    }

    public function edit(Prato $prato)
    {
        return view('pratos.edit', ['prato' => $prato]);
    }

    public function update(Request $request, Prato $prato)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $dados = $request->all();

        if ($request->hasFile('imagem')) {
            // Deleta a imagem antiga se existir
            if ($prato->imagem && Storage::disk('public')->exists($prato->imagem)) {
                Storage::disk('public')->delete($prato->imagem);
            }
            $caminhoImagem = $request->file('imagem')->store('imagens_pratos', 'public');
            $dados['imagem'] = $caminhoImagem;
        }

        $prato->update($dados);

        return redirect()->route('pratos.index')->with('success', 'Prato atualizado com sucesso!');
    }

    public function destroy(Prato $prato)
    {
        // Deleta a imagem do prato se ela existir
        if ($prato->imagem && Storage::disk('public')->exists($prato->imagem)) {
            Storage::disk('public')->delete($prato->imagem);
        }

        $prato->delete();

        return redirect()->route('pratos.index')->with('success', 'Prato excluído com sucesso!');
    }
}