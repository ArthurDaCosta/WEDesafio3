
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
            <img src="{{ asset('images/logovelho.png') }}" alt="logo" id="logoacabeca">

            <div id="alinhadireita">

                <div id="caixaLogin">
                <?php
                // botão login que muda para o nome e logof
                $sessão['idusuario'] = 1221;//para testar
                $sessão['nome'] = 'Igor';//teste

                if ($sessão['idusuario']) {// se logado true
                    echo '<p id="bemVindo">Bem vindo ' . $sessão['nome'] . '</p>';
                    echo '<button id="logout">Logout</button>';//unset sessão e recarrega se não recarregar sozinho
                } else {
                    echo '<button id="login">Login</button>';//manda pagina login
                }

                ?>
                </div>

                

            </div>
        </section>

        <section id="primeira">
            <div class="caixa">
                <?php  
                
                $carrinho = array(
                    array("id" => 111111, "nome" => "Produto 1", "preco" => 10.99, "imagem" => "link.imagem1.jpg"),
                    array("id" => 222222, "nome" => "Produto 2", "preco" => 20.99, "imagem" => "images/logovelho.png"),
                    array("id" => 333333, "nome" => "Produto 3", "preco" => 30.99, "imagem" => "imagem3.jpg")
                );     

                foreach ($carrinho as $produto) {
                    echo '<div class="produto" id="produto-' . $produto['id'] . '">';
                        echo '<div class="imagem">';
                            echo '<img src="' . asset($produto['imagem']) . '" alt="' . $produto['nome'] . '">';
                        echo '</div>';
                        echo '<div class="informacoes">';
                            echo '<h3>' . $produto['nome'] . '</h3>';
                            echo '<p>Preço: R$ ' . number_format($produto['preco'], 2) . '</p>';
                            
                            echo '<div id="caixaquantidade">';
                            echo '<button class="maismenos">-</button>';
                            echo '<input type="text" id="quantidadeAtual" value="1">';
                            echo '<button class="maismenos">+</button>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
                ?>
                
            </div>
            <div class="caixaPagamento">
                <div id="listagem">
                    <?php 
                        $total = 0;
                        foreach ($carrinho as $produto){
                            echo '<p>'. $produto['nome'] . '    Preço: R$ ' . number_format($produto['preco'], 2) . '</p>';
                            $total += $produto['preco'];
                        }
                    ?>
                </div>
                <div id="total">
                    <?php
                        echo '<p><br> Total: R$ ' . number_format($total, 2) . '</p>';
                    ?>
                </div>
                <button class="botoesPagamento" id="botaoPagar">Pagar</button>
                <button class="botoesPagamento" id="botaoContinuarComprando">Continuar comprando</button>
                <button class="botoesPagamento" id="botaoLimparCarrinho">Limpar carrinho</button>
            </div>
           
        </section>

    </main>
    
        <script src="{{ asset('js/carrinho.js') }}"></script>
    
</body>
</html>