<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paghtml</title>
    <link rel="stylesheet" href="{{ asset('css/loja.css') }}">
</head>
<body id="primeira">
    <header id="cabeca">
        <a href="{{ route('loja.index') }}" id="lojaLink">
            <img src="{{URL::asset('/img/pngegg.png')}}" alt="logo" id="logoacabeca">
        </a>
        <button id="botao-menu">Categorias</button>
        <form id="menu-retratil" method="GET" action="{{ route('loja.index') }}">
            <ul>
                <button type="submit" class="botao" id='retratil'>Todos</button>
                <button type="submit" name='modalidade' value="1" class="botao" id='retratil'>Ingressos</button>
                <button type="submit" name='modalidade' value="2" class="botao" id='retratil'>Consumíveis</button>
                <button type="submit" name='modalidade' value="3" class="botao" id='retratil'>Estacionamento</button>
                <button type="submit" name='modalidade' value="4" class="botao" id='retratil'>Complemento</button>                        
            </ul>
        </form>
        <div id="caixa-pesquisa">
            <form id='pesquisa' method="GET" action="{{ route('loja.index') }}">
                <?php 
                if (!empty($_GET['modalidade'])) 
                    echo "<input type='hidden' name='modalidade' value='".$_GET['modalidade']."' />";
                ?>
                <input type="text" id="texto-pesquisa" name="dscproduto" placeholder="Pesquisar...">
                <button id="lupa" type="submit">&#128269;</button>
            </form>
        </div>
        <div id="caixaLogin">
            <?php
            if (session('loggedIn')) {
                ?>
                <p id="bemVindo">Bem vindo <?= session('nome') ?>! </p>
                <a href="{{ route('login.logout') }}" class="botao">Logout</a>
                <?php
            } else {
                ?>
                <a href="{{ route('login.login') }}" id="botao-login">Login</a>
                <?php
            }
            ?>
        </div>
        <a href="{{ route('carrinho.index') }}" id="carrinhoLink">
            <img id="imagemcarrinho"src="{{ URL::asset('/img/carrinho.png') }}" alt="carrinho" id="botaocarrinho">
        </a>
    </header>
    <main>
        <div class="caixa">
            <?php
            if (!empty($data['resultado'])) {
                foreach ($data['resultado'] ?? [] as $produto) {
                    ?>
                    <div class="produto" id="produto-<?=$produto['idproduto']?>">
                        <div class="imagem">
                            <img src="{{ asset($produto['imagem']) }}" alt="{{ $produto['dscproduto'] }}" onerror="this.onerror=null; this.src='{{ asset('/img/pngegg.png') }}';">
                        </div>
                        <div class="informacoes">
                            <h3><?= $produto['dscproduto'] ?></h3>
                            <p>Preço: R$ <?= number_format($produto['preco'], 2) ?></p>
                        </div>
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
                    <?php
                }
            } else {
                ?>
                <div class="erro">
                    <p id="mensagemNaoEncontrado">Nenhum produto encontrado</p>
                </div>
                <?php
            }
            ?>
        </div>
        <?php if (!empty($data['resultado'])) { ?>
            <div id="paginacao">
                <form id="form" method="GET" action="{{ route('loja.index') }}">
                    <?php 
                    if (!empty($_GET['dscproduto'] ?? null)) 
                        echo "<input type='hidden' name='dscproduto' value='".$_GET['dscproduto']."' />";
                    
                    if (!empty($_GET['modalidade'] ?? null))
                        echo "<input type='hidden' name='modalidade' value='".$_GET['modalidade']."' />";
                    ?>
                    <button class="botao-pagina" onclick="selectFirst()">&lt;&lt;</button>
                    <button class="botao-pagina" onclick="selectPrevious()">&lt;</button>
                    <select name="pagina" class="botao-pagina" id='pagina' onchange="submit()">
                        <?php
                        for ($i = 1; $i <= $data['totalPaginas']; $i++) {
                            if (($_GET['pagina'] ?? 1) > $data['totalPaginas']) {
                                ?>
                                <option value="<?= $i ?>" <?= $i == $data['totalPaginas'] ? 'selected' : '' ?>><?= $i ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?= $i ?>" <?= $i == ($_GET['pagina'] ?? 1)  ? 'selected' : '' ?>><?= $i ?></option>
                                <?php
                            }
                        } ?>               
                    </select>
                    <button class="botao-pagina" onclick="selectNext()">&gt;</button>
                    <button class="botao-pagina" onclick="selectLast()">&gt;&gt;</button>  
                </form>
            </div>
        <?php } ?>
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
    <script src="{{ asset('js/loja.js') }}"></script>
</body>
</html>