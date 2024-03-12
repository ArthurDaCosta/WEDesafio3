<?php

 if(isset($error)){
    var_dump($error);
 }
 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paghtml</title>
    <link rel="stylesheet" href="{{ asset('css/loja.css') }}">
</head>
<body>
    <main>
        <section id="cabeca">
            <img src="{{URL::asset('/img/pngegg.png')}}" alt="logo" id="logoacabeca">
            <div id="alinhadireita">
                <div id="barra-pesquisa">
                    <input type="text" placeholder="Pesquisar...">
                    <button type="submit" id="dscproduto">&#128269;</button>
                </div>
                <div id="caixaLogin">
                <?php
                if (session('loggedIn')) {
                    ?>
                    <p id="bemVindo">Bem vindo <?= session('loggedIn') ?> </p>
                    <form id="formulario" method="GET" action="{{ route('login.logout') }}">
                        <input type="submit" value="Logout" class="botao" />
                    </form>
                    <?php
                } else {
                    ?>
                    <form id="formulario" method="GET" action="{{ route('login.login') }}">
                        <input type="submit" value="Login" class="botao" />
                    </form>
                    <?php
                }
                ?>
                </div>
                <button id="botao-menu">Categorias</button>
                <nav id="menu-retratil">
                    <ul>
                        <li><a href="#">Item de menu 1</a></li>
                        <li><a href="#">Item de menu 2</a></li>
                        <li><a href="#">Item de menu 3</a></li>
                    </ul>
                </nav>
            </div>
        </section>
        <section id="primeira">
            <div class="caixa">
                <?php
                foreach ($data as $produto) {
                    ?>
                    <div class="produto" id="produto-<?=$produto['idproduto']?>">
                        <div class="imagem">
                            <img src="<?=asset($produto['imagem'])?>" alt="<?=$produto['dscproduto']?>">
                        </div>
                        <div class="informacoes">
                            <h3><?= $produto['dscproduto'] ?></h3>
                            <p>Preço: R$ <?= number_format($produto['preco'], 2) ?></p>
                            <form id="formulario" method="POST" action="{{ route('carrinho.store') }}">
                                @csrf
                                <input type="hidden" name="idproduto" value="<?= $produto['idproduto'] ?>" />
                                <input type="hidden" name="imagem" value="<?= $produto['imagem'] ?>"/> 
                                <input type="hidden" name="dscproduto" value="<?= $produto['dscproduto'] ?>"/> 
                                <input type="hidden" name="preco" value="<?= $produto['preco'] ?>"/> 
                                <input type="hidden" name="quantidade" value="1"/>
                                <input type="submit" value="Add ao Carrinho +" class="botao-add-carrinho" />
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div id="paginacao">
                <button>&lt;&lt;</button>
                <button>&lt;</button>
                <select>
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
                <button>&gt;</button>
                <button>&gt;&gt;</button>  
            </div>

        </section>

    </main>
        <script src="{{ asset('js/loja.js') }}"></script>
</body>
</html>