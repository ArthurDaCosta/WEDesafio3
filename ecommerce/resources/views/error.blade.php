<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paghtml</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body id="primeira">
    <main>
        <div id="caixaErro">
            <div id="caixavidro">
                <p>Erro: <?= $error ?></p>
            </div>
        </div>    
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
