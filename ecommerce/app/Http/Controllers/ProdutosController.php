<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProdutosController extends Controller
{
    public function index(Request $request)
    {
        $client = new Client();

        $apiUrl = "https://ah.we.imply.com/desafio3/produtos";

        try {
            $response = $client->post($apiUrl, [
               'body' => json_encode([
                     'dscproduto' => $request->dscproduto ?? '',
                     'modalidade' => $request->modalidade ?? '',
                     'pagina' => $request->pagina ?? 1,
               ]),
            ]);

            $data = json_decode($response->getBody(), true);
            $data = $data['result'];

            return view('loja.index', compact('data'));
        } catch (\Exception $e) {
            return view('error', ['error' => $e->getMessage()]);
        }
    }   
}
