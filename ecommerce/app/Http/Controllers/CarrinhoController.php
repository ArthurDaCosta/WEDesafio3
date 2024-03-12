<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarrinhoItem;
use App\Models\CarrinhoPessoa;
use Illuminate\Support\Facades\DB;

class CarrinhoController extends Controller
{
    public function index()
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('id'))->first();
        $carrinho->items = json_decode($carrinho->items);
        return view('carrinho.index', compact('carrinho'));
    }

    public function store(Request $request)
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        $produto = New CarrinhoItem([
            'idproduto' => $_POST['idproduto'],
            'quantidade' => $_POST['quantidade']
        ]);    

       if(DB::table('carrinhoPessoa')->where('idpessoa', session('id'))->exists()) {
            $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('id'))->first();
            $carrinho->items = json_decode($carrinho->items);
            array_push($carrinho->items, $produto);
            $carrinho->items = json_encode($carrinho->items);
            $carrinho->save();
        } else {
            $carrinho = DB::table('carrinhoPessoa')->insert([
                'idpessoa' => session('id'),
                'items' => json_encode($produto)
            ]);
        }

        return redirect()->route('loja.index');
    }

    public function update(Request $request)
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        $id = $_POST['idproduto'];
        $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('id'))->first();
        $carrinho->items = json_decode($carrinho->items);
        foreach($carrinho->items as $item) {
            if($item->idproduto == $id) {
                $item->quantidade = $_POST['quantidade'];
            }
        }
        $carrinho->items = json_encode($carrinho->items);
        $carrinho->save();
    
        return redirect()->route('carrinho.index');
    }

    public function delete()
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        $id = $_POST['idproduto'];
        $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('id'))->first();
        $carrinho->items = json_decode($carrinho->items);
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

        $carrinho = DB::table('carrinhoPessoa')->where('idpessoa', session('id'))->first();
        $carrinho->items = json_encode([]);
        $carrinho->save();

        return redirect()->route('carrinho.index');
    }
}
