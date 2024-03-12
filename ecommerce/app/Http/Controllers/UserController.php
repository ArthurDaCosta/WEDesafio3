<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;

class UserController extends Controller
{
    public function login()
    {
        if(session()->has('loggedIn')) {
            return redirect()->route('loja.index');
        }

        $client = new Client();

        $apiUrl = "https://ah.we.imply.com/desafio3/login";

        try {
            $response = $client->post($apiUrl, [
               'body' => json_encode([
                     'email' => $_POST['email'],
                     'cpf' => $_POST['cpf']
               ])
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['result']['idpessoa'])) {
                session(['loggedIn' => $data['result']['idpessoa']]);
                return redirect()->route('loja.index');
            }

            session('erro', 'Usuário ou senha inválidos');
            return view('login.index');
        } catch (\Exception $e) {
            return view('login.index', ['error' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        session()->forget('loggedIn');

        return redirect()->route('login.index');
    }

}
