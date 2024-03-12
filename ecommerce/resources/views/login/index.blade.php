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

                    <form id= formulario method="POST" action="{{ route('login.login') }}">
                        @csrf
                        <div style="margin-bottom:.8vh;">
                            <input type="text" id="email" name="email" value="" placeholder="Insira seu E-Mail" required />
                        </div>
                        <div style="margin-bottom:1.5vh;" class="form-group">
                            <input type="password" id="cpf" name="cpf" value="" placeholder="Insira seu CPF" required />
                        </div>
                        
                        <input type="submit" value="LOGIN" class="botao" />
                        
                    
                    </form>
                    </div>
                </div>  
            </div>

                

            </div>
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