<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrinhoItem;
use Illuminate\Support\Facades\DB;

class CarrinhoController extends Controller
{
    public function index()
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        try {
            if(DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->exists()) {
                $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->first();
                $carrinho->items = json_decode($carrinho->items, true);
            } else {
                $carrinho = DB::table('carrinhoPessoa')->insert([
                    'idpessoa' => session('loggedIn') ?? "Undefined",
                    'items' => json_encode([])
                ]);
            }
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }

        return view('carrinho.index', compact('carrinho'));
    }

    public function store(Request $request)
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

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
            if(DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->exists()) {
                $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->first();
                $carrinho->items = json_decode($carrinho->items, true);

                if(array_search($produto->idproduto, array_column($carrinho->items, 'idproduto')) !== false) {
                    foreach($carrinho->items as &$item) {
                        if($item['idproduto'] == $produto->idproduto) {
                            $item['quantidade'] += $produto->quantidade;
                        }
                    }
                } else {
                    array_push($carrinho->items, $produto);
                }

                $carrinho->items = json_encode($carrinho->items);
                DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->update(['items' => $carrinho->items]);
            } else {
                DB::table('carrinhoPessoa')->insert([
                    'idpessoa' => session('loggedIn') ?? "Undefined",
                    'items' => json_encode([$produto])
                ]);
            }
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }

        return redirect()->route('loja.index');
    }

    public function update(Request $request)
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        $id = $request->idproduto;

        try {
            $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->first();
            $carrinho->items = json_decode($carrinho->items, true);
            foreach($carrinho->items as &$item) {
                if($item->idproduto == $id) {
                    var_dump($request->put('quantidade'));
                    $item->quantidade = $request->quantidade;
                }
            }
            $carrinho->items = json_encode($carrinho->items);
            $carrinho->save();
        } catch (\Exception $e) {
            //return view('error', ['error' => $e->getMessage()]);
        }
    
        //return redirect()->route('carrinho.index');
    }

    public function delete(Request $request)
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        $request->validate([
            'idproduto' => 'required'
        ]);

        $id = $request->idproduto;

        try {
            $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->first();
            $carrinho->items = json_decode($carrinho->items, true);
            $carrinho->items = array_filter($carrinho->items, function($item) use ($id) {
                return $item->idproduto != $id;
            });
            $carrinho->items = json_encode($carrinho->items);
            $carrinho->save();
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }

        return redirect()->route('carrinho.index');
    }

    public function clear()
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        try {
            if(DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->exists()) {
                DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->delete();
            }
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }

        return redirect()->route('carrinho.index');
    }
}
