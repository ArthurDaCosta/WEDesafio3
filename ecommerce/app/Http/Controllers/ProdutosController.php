<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProdutosController extends Controller
{
    public function index()
    {
        $client = new Client();

        $apiUrl = "https://ah.we.imply.com/desafio3/produtos";

        try {
            $response = $client->get($apiUrl, [
               'body' => json_encode([
                     'dscproduto' => $_POST['dscproduto'] ?? '',
                     'modalidade' => $_POST['modalidade'] ?? '',
                     'pagina' => $_POST['pagina'] ?? 1
               ]),
            ]);

            $data = json_decode($response->getBody(), true);

            return view('loja.index', compact('data'));
        } catch (\Exception $e) {
            return view('login.index', ['error' => $e->getMessage()]);
        }
    }   
}
