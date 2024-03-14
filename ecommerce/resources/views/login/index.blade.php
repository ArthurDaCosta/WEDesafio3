<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paghtml</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <main>
        <section id="primeira">
            <div class="caixa">
                <div id="esquerdaPrimeira">
                    <img src="{{URL::asset('/img/pngegg.png')}}" alt="logo" id="logoatras">
                    <div id="caixavidro">
                        <div id="textoa">
                            Faça login com seu<br> <span style="color:#1839de; font-weight: 600; ">E-Mail</span> e <span style="color:#1839de; font-weight: 600; ">CPF</span>
                        </div>

                        <?php if(!empty(session('error'))){ ?>
                            <div class="error" role="alert">
                                <?= session('error') ?>
                            </div>
                            <?php session()->forget('error');
                        } ?>

                        <form id= formulario method="POST" action="{{ route('login.login') }}">
                            @csrf
                            <div style="margin-bottom:.8vh;">
                                <input type="text" id="email" name="email" value="" placeholder="Insira seu E-Mail" required />
                            </div>
                            <div style="margin-bottom:1.5vh;" class="form-group">
                                <input type="password" id="cpf" name="cpf" value="" placeholder="Insira seu CPF" required />
                            </div>
                            <input type="submit" value="LOGIN" class="botao" />
                            <div class='esqueceuSenha'>
                                <a href="{{ route('loja.index') }}">Esqueceu a senha?</a>
                            </div>
                            <div class="separator">
                            </div>
                            <div class="cadastrese">
                                <nobr>Não tem uma conta?</nobr>
                                <a href="{{ route('loja.index') }}">Cadastre-se!</a>
                            </div>
                        </form>
                        
                    </div>
                </div>  
            </div>
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
        </section>
    </main>

    <script>
        const primeira = document.getElementById('primeira');
        primeira.addEventListener("mousemove", (e) =>{
            console.log(e);
            primeira.style.backgroundPositionX = (-e.screenX)/2 + "px";
            primeira.style.backgroundPositionY = (-e.screenY)/2 + "px";
        });
    </script>
</body>
</html>