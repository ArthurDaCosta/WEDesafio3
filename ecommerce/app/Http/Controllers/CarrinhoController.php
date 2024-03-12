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
            $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('id'))->first();
        } catch (\Exception $e) {
            return view('loja.index', ['error' => $e->getMessage()]);
        }

        $carrinho->items = json_decode($carrinho->items, true);
        return view('carrinho.index', compact('carrinho'));
    }

    public function store(Request $request)
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        $produto = New CarrinhoItem([
            'idproduto' => $request->idproduto,
            'quantidade' => $request->quantidade
        ]);
        
        try {
            if(DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->exists()) {
                $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->first();
                $carrinho->items = json_decode($carrinho->items, true);
                
                if(array_search($produto->idproduto, array_column($carrinho->items, 'idproduto')) !== false) {
                    foreach($carrinho->items as $item) {
                        if($item->idproduto == $produto->idproduto) {
                            $item->quantidade += $produto->quantidade;
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
                    'items' => json_encode($produto)
                ]);
            }
        } catch (\Exception $e) {
            return view('loja.index', ['error' => $e->getMessage()]);
        }

        return redirect()->route('loja.index');
    }

    public function update(Request $request)
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        $request->validate([
            'quantidade' => 'required|numeric|min:1'
        ]);

        $id = $_POST['idproduto'];

        try {
            $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->first();
        } catch (\Exception $e) {
            return view('loja.index', ['error' => $e->getMessage()]);
        }

        $carrinho->items = json_decode($carrinho->items, true);
        foreach($carrinho->items as $item) {
            if($item->idproduto == $id) {
                $item->quantidade = $request->quantidade;
            }
        }
        $carrinho->items = json_encode($carrinho->items);
        $carrinho->save();
    
        return redirect()->route('carrinho.index');
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
        $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('loggedIn'))->first();
        $carrinho->items = json_decode($carrinho->items, true);
        $carrinho->items = array_filter($carrinho->items, function($item) use ($id) {
            return $item->idproduto != $id;
        });
        $carrinho->items = json_encode($carrinho->items);
        $carrinho->save();

        return redirect()->route('carrinho.index');
    }

    public function clear()
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        DB::table('carrinhoPessoa')->where('idpessoa', session('id'))->first()->delete();

        return redirect()->route('carrinho.index');
    }
}
