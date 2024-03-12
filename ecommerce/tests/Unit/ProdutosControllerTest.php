<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
//use App\Http\Controllers\ProdutosController;
use Illuminate\Http\Request;

class ProdutosControllerTest extends TestCase
{
    public function test()
    {
        $teste = new ProdutosController();
        $request = new Request();
        $request->dscinterna = 'meia';
        $teste = $teste->index($request);

        var_dump($teste);
    }
}
