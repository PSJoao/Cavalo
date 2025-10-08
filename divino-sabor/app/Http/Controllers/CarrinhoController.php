<?php

namespace App\Http\Controllers;

use App\Models\Prato;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function adicionar(Request $request, Prato $prato)
    {
        $carrinho = $request->session()->get('carrinho', []);

        if (isset($carrinho[$prato->id])) {
            $carrinho[$prato->id]['quantidade']++;
        } else {
            $carrinho[$prato->id] = [
                "nome" => $prato->nome,
                "quantidade" => 1,
                "preco" => $prato->preco,
                "imagem" => $prato->imagem
            ];
        }

        $request->session()->put('carrinho', $carrinho);
        return redirect()->back()->with('success', 'Prato adicionado ao carrinho!');
    }

    public function mostrar(Request $request)
    {
        $carrinho = $request->session()->get('carrinho', []);
        return view('carrinho.mostrar', compact('carrinho'));
    }

    public function finalizar(Request $request)
    {
        $request->session()->forget('carrinho');
        return redirect()->route('pratos.index')->with('success', 'Compra finalizada com sucesso! Seu pedido está sendo preparado.');
    }
}