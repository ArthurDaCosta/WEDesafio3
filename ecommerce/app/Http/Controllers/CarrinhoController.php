<?php

namespace App\Http\Controllers;

use App\Models\Carrinho;
use Illuminate\Http\Request;
use App\Models\CarrinhoItem;

class CarrinhoController extends Controller
{
    public function index()
    {
        if(!session()->has('loggedIn')) 
            return redirect()->route('login.index');
        

        try {
            $carrinho = Carrinho::where('idpessoa', session('loggedIn'))->first();
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }

        if(!$carrinho) 
            return view('carrinho.index', ['carrinho' => null]);
        

        return view('carrinho.index', compact('carrinho'));
    }

    public function store(Request $request)
    {
        if(!session()->has('loggedIn')) 
            return redirect()->route('login.index');
        

        $request->validate([
            'idproduto' => 'required',
            'quantidade' => 'required|numeric|min:1',
            'preco' => 'required|numeric|min:0'
        ]); 

        $produto = New CarrinhoItem([
            'idproduto' => $request->idproduto,
            'imagem' => $request->imagem,
            'dscproduto' => $request->dscproduto,
            'quantidade' => $request->quantidade,
            'preco' => $request->preco
        ]);

        try {
            $carrinho = Carrinho::where('idpessoa', session('loggedIn'))->first();

            if(!$carrinho) {
                $carrinho = new Carrinho();
                $carrinho->idpessoa = session('loggedIn');
                $carrinho->items = [$produto];
                $carrinho->save();

                return redirect()->route('loja.index');
            }

            $produtos = $carrinho->items;

            if(array_search($produto->idproduto, array_column($produtos, 'idproduto')) !== false) {
                foreach($produtos as &$item) {
                    if($item['idproduto'] == $produto->idproduto) {
                        $item['quantidade'] += $produto->quantidade;
                    }
                }
            } else {
                $produtos[] = $produto;
            }
            
            $carrinho->items = $produtos;
            $carrinho->save();
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }

        return redirect()->route('loja.index');
    }

    public function update(Request $request)
    {
        if(!session()->has('loggedIn')) 
            return redirect()->route('login.index');
        

        $request->validate([
            'idproduto' => 'required',
            'quantidade' => 'required|numeric|min:1'
        ]);

        try {
            $carrinho = Carrinho::where('idpessoa', session('loggedIn'))->first();

            if(!$carrinho) {
                return redirect()->route('carrinho.index');
            }

            $produtos = $carrinho->items;
            
            foreach($produtos as &$item) {
                if($item['idproduto'] == $request->idproduto) {
                    $item['quantidade'] = $request->quantidade;
                }
            }
            
            $carrinho->items = $produtos;
            $carrinho->save();
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }
    
        return redirect()->route('carrinho.index');
    }

    public function delete(Request $request)
    {
        if(!session()->has('loggedIn')) 
            return redirect()->route('login.index');
        

        $request->validate([
            'idproduto' => 'required'
        ]);

        try {
            $carrinho = Carrinho::where('idpessoa', session('loggedIn'))->first(); 
 
            if(!$carrinho) {
                return redirect()->route('carrinho.index');
            }

            $produtos = $carrinho->items;
            $produtos = array_filter($produtos, function($item) use ($request) {
                return $item['idproduto'] != $request->idproduto;
            });

            $carrinho->items = $produtos;
            $carrinho->save();
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }

        return redirect()->route('carrinho.index');
    }

    public function clear()
    {
        if(!session()->has('loggedIn')) 
            return redirect()->route('login.index');
        

        try {
            if(Carrinho::where('idpessoa', session('loggedIn'))->exists()) {
                Carrinho::where('idpessoa', session('loggedIn'))->delete();
            }
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }

        return redirect()->route('carrinho.index');
    }
}
