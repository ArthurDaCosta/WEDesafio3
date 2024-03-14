<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if(session()->has('loggedIn')) {
            return redirect()->route('loja.index');
        }

        if($request->isMethod('post')) {
            $client = new Client();

            $apiUrl = "https://ah.we.imply.com/desafio3/login";

            try {
                $response = $client->post($apiUrl, [
                    'body' => json_encode([
                            'email' => $request->post('email'),
                            'cpf' => $request->post('cpf')
                    ])
                ]);

                $data = json_decode($response->getBody(), true);

                if (isset($data['result']['idpessoa'])) {
                    session(['loggedIn' => $data['result']['idpessoa']]);
                    session(['nome' => $data['result']['nome']]);
                    return redirect()->route('loja.index');
                }

                session(['error' => 'Usuário ou senha inválidos']);
                return view('login.index');
            } catch (\Exception $e) {
                return view('error', ['error' => $e->getMessage()]);
            }
        }

        return view('login.index');
    }

    public function logout()
    {
        if(!session()->has('loggedIn')) {
            return redirect()->route('login.index');
        }

        session()->forget(['loggedIn', 'nome']);

        return redirect()->route('loja.index');
    }

}
