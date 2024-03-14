<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paghtml</title>

    <link rel="stylesheet" href="{{ asset('css/carrinho.css') }}">
</head>
<body id="primeira">
    <header id="cabeca">
        <a href="{{ route('loja.index') }}" id="lojaLink"><img src="{{URL::asset('/img/pngegg.png')}}" alt="logo" id="logoacabeca"></a>            
        <div id="alinhadireita">
            <div id="caixaLogin">
                <p id="bemVindo">Bem vindo <?= session('nome') ?></p>
                <form id="formulario" method="GET" action="{{ route('login.logout') }}">
                    <button type="submit" class="botao">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <main>
        <section class='carrinho'>
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
                                <form id="formulario" method="POST" action="{{ route('carrinho.update') }}">
                                    @method('PUT')
                                    @csrf
                                    <input type="hidden" name="idproduto" value="<?= $produto['idproduto'] ?>">
                                    <input type="number" name="quantidade" id="quantidadeAtual" value="<?= $produto['quantidade'] ?>" onchange="this.form.submit()">
                                    <button type="submit" name="quantidade" value="<?= ($produto['quantidade'] - 1) ?>" class="maismenos" id="menos">-</button>
                                    <button type="submit" name="quantidade" value="<?= ($produto['quantidade'] + 1) ?>" class="maismenos" id="mais">+</button>
                                </form>
                            </div>
                        </div>
                        <div id="remover">
                            <form id="formulario" method="POST" action="{{ route('carrinho.delete') }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" name="idproduto" value="<?= $produto['idproduto'] ?>" class="removerProduto" id="remover">Remover do Carrinho</button>
                            </form>
                        </div>
                    </div>
                <?php } 
                } else { ?>
                    <div id="carrinhoVazio">
                        <p>Seu carrinho está vazio</p>
                    </div>
                <?php } ?>
            </div>
            <div class="caixaPagamento">
                <div id="listagem">
                    <?php 
                        $total = 0;
                        if (!empty($carrinho->items)) {
                            foreach ($carrinho->items as $produto){
                                echo '<p>'. $produto['dscproduto'] . '   x '. $produto['quantidade'] .'    Preço Unitário: R$ ' . number_format(($produto['preco'] * $produto['quantidade']), 2) . '</p>';
                                $total += $produto['preco'] * $produto['quantidade'];
                            }
                        }
                    ?>
                </div>
                <?php if (!empty($carrinho->items)) { ?>
                    <div id="total">
                        <?php
                            echo '<p><br> Total: R$ ' . number_format($total, 2) . '</p>';
                        ?>
                    </div>
                    <a class="botoesPagamento" id="botaoPagar">Pagar</a>
                    <a href="{{ route('carrinho.clear') }}" class="botoesPagamento" id="botaoLimparCarrinho">Limpar carrinho</a>
                    <?php 
                } ?>
                <a href="{{ route('loja.index') }}" class="botoesPagamento" id="botaoContinuarComprando">Continuar comprando</a>
            </div>
        </section>
    </main>
    <footer class='footer'>
        <img src="{{URL::asset('/img/logo-rodape.png')}}" alt="logo" id="logoafooter">
        <div class="politica">
            <a href="{{ route('loja.index') }}">Termos de Uso</a>
            <a href="{{ route('loja.index') }}">Política de Privacidade</a>
            <a href="{{ route('loja.index') }}">Política de Cookies</a>
        </div>
        <div class="separator" id='footerSeparator'>
        </div>
        <div class="rodape">
                <p>Copyright 2003 Imply Tecnologia Eletrônica Ltda, Imply Rental Locação de Equipamentos e Serviços LTDA, Imply Administradora de Recursos LTDA, Eleven360 Tecnologia de Informação LTDA. CNPJ 05.681.400/0001-23 | CNPJ 14.928.256/0001-78 | CNPJ 44.529.957/0001-03 | CNPJ 30.022.262/0001-18 Todos os direitos reservados. Todos os conteúdos deste Website são protegidos por direito autoral ou usados mediante autorização. Todas as especificações estão sujeitas a alterações sem aviso prévio. As Imagens e desenhos são meramente ilustrativas</p>
                <p>Desenvolvido por <a href="https://github.com/ArthurDaCosta" target="_blank">Arthur Brixius da Costa</a> e <a href="https://github.com/Igor-Flesch-Correa" target="_blank">Igor Flesch Corrêa</a></p>
        </div>
    </footer>
    <script src="{{ asset('js/carrinho.js') }}"></script>
</body>
</html>

