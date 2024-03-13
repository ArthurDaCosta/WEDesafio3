<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paghtml</title>

    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
</head>
<body>
    <main>
        <section id="cabeca">
            <a href="{{ route('loja.index') }}" id="lojaLink"><img src="{{URL::asset('/img/pngegg.png')}}" alt="logo" id="logoacabeca"></a>            
            <div id="alinhadireita">
                <div id="caixaLogin">
                    <p id="bemVindo">Bem vindo <?= session('nome') ?></p>
                    <form id="formulario" method="GET" action="{{ route('login.logout') }}">
                        <button type="submit" id="logout">Logout</button>
                    </form>
                </div>
            </div>
        </section>
        <section id="primeira">
            <div class="caixa">

                <?php if (!empty($carrinho->items)) {
                    foreach ($carrinho->items as $produto) { ?>
                    <div class="produto" id="produto-' . $produto['id'] . '">
                        <div class="imagem">
                            <img src="<?= $produto['imagem'] ?>" alt="<?=$produto['dscproduto']?>">
                        </div>
                        <div class="informacoes">
                            <h3><?= $produto['dscproduto'] ?></h3>
                            <p>Preço: R$ <?= number_format($produto['preco'], 2) ?></p>
                            <div id="caixaquantidade">
                                <form id="formulario" method="PUT" action="{{ route('carrinho.update') }}">
                                    @csrf
                                    <input type="hidden" name="idproduto" value="<?= $produto['idproduto'] ?>">
                                    <button type="submit" value="<?= $produto['quantidade'] - 1 ?>" class="maismenos" id="menos">-</button>
                                    <input type="text" id="quantidadeAtual" value="<?= $produto['quantidade'] ?>">
                                    <button type="submit" value="<?= $produto['quantidade'] + 1 ?>"class="maismenos" id="mais">+</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } 
                } ?>
                
            </div>
            <div class="caixaPagamento">
                <div id="listagem">
                    <?php 
                        $total = 0;
                        if (!empty($carrinho->items)) {
                            foreach ($carrinho->items as $produto){
                                echo '<p>'. $produto['dscproduto'] . '   x '. $produto['quantidade'] .'    Preço: R$ ' . number_format(($produto['preco'] * $produto['quantidade']), 2) . '</p>';
                                $total += $produto['preco'] * $produto['quantidade'];
                            }
                        }
                    ?>
                </div>
                <div id="total">
                    <?php
                        echo '<p><br> Total: R$ ' . number_format($total, 2) . '</p>';
                    ?>
                </div>
                <a class="botoesPagamento" id="botaoPagar">Pagar</a>
                <a href="{{ route('loja.index') }}" class="botoesPagamento" id="botaoContinuarComprando">Continuar comprando</a>
                <a href="{{ route('carrinho.clear') }}" class="botoesPagamento" id="botaoLimparCarrinho">Limpar carrinho</a>
            </div>
        </section>
    </main>
        <script src="{{ asset('js/carrinho.js') }}"></script>
</body>
</html>