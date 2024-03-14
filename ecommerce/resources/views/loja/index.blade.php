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
            <a href="{{ route('loja.index') }}" id="lojaLink"><img src="{{URL::asset('/img/pngegg.png')}}" alt="logo" id="logoacabeca"></a>
            <div id="alinhadireita">
                <div id="caixa-pesquisa">
                    <form id="formulario" method="GET" action="{{ route('loja.index') }}">
                    <input type="hidden" name="modalidade" value="<?= $_GET['modalidade'] ?? '' ?>" />
                    <input type="text" name="dscproduto" placeholder="Pesquisar...">
                    <button id="lupa"type="submit">&#128269;</button>
                    </form>
                </div>
                <div id="caixaLogin">
                    <?php
                    if (session('loggedIn')) {
                        ?>
                        <p id="bemVindo">Bem vindo <?= session('nome') ?> </p>
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

                <a href="{{ route('carrinho.index') }}" id="carrinhoLink">
                    <img id="imagemcarrinho"src="{{ URL::asset('/img/carrinho.png') }}" alt="carrinho" id="botaocarrinho">
                </a>


                <button id="botao-menu">Categorias</button>
                <form id="menu-retratil" method="GET" action="{{ route('loja.index') }}">
                    <ul>
                        <button type="submit" name='modalidade' value="">Todos</button>
                        <button type="submit" name='modalidade' value="1">Ingressos</button>
                        <button type="submit" name='modalidade' value="2">Consumíveis</button>
                        <button type="submit" name='modalidade' value="3">Estacionamento</button>
                        <button type="submit" name='modalidade' value="4">Complemento</button>                        
                    </ul>
                </form>
            </div>
        </section>
        <section id="primeira">
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
                } else {
                    ?>
                    <p id="mensagemNaoEncontrado">Nenhum produto<br> encontrado</p>
                    <?php
                }
                ?>
            </div>
            <?php if (!empty($data['resultado'])) { ?>
                <div id="paginacao">
                    <form id="form" method="GET" action="{{ route('loja.index') }}">
                        <input type="hidden" name="dscproduto" value="<?= $_GET['dscproduto'] ?? '' ?>" />
                        <input type="hidden" name="modalidade" value="<?= $_GET['modalidade'] ?? '' ?>" />
                        <button onclick="selectFirst()">&lt;&lt;</button>
                        <button onclick="selectPrevious()">&lt;</button>
                        <select name="pagina" id="pagina" onchange="submit()">
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
                        <button onclick="selectNext()">&gt;</button>
                        <button onclick="selectLast()">&gt;&gt;</button>  
                    </form>
                </div>
            <?php } ?>
        </section>

    </main>
        <script src="{{ asset('js/loja.js') }}"></script>
</body>
</html>