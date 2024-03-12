<?php

 if(isset($data)){
    var_dump($data);
 }
 
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
    <style>
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: roboto;
    
}
/*---------------------------------------------------------------------------------------------*/
.bloco{

}
#primeira{
     display: flex;
    background: black;
    height: 100vh;
    align-items: center;
    justify-content: center;
    background-image: url('https://s3.1app.com.br/master/project_5945/5eEsy3Ca9FXh06oK7e7qvnzT71DkOdL1.jpg');
    background-size: contain;
}
.caixa{
    display: flex;
    /*border:1px solid rgb(81, 255, 0); */
    height: 100%;
    width: 170vh;
    
}
#esquerdaPrimeira {
    display: flex;
    /*border: 1px solid red; */
    margin: 0 auto; 
    min-height: 100vh;
    min-width: 50%;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}
#caixavidro{
    display: flex;
    flex-direction: column;
    font-size: 4.7vh;
    min-width: 80%;
    width: 80%;
    height: 45%;
    border-radius: 30px;
    align-items: center;
    justify-content:space-around;
    padding: 2vh 1vw 3vh;
    

    backdrop-filter: saturate(100%) blur(30px);
}

        @media screen and (orientation: portrait)/*----------------------------------------------ajustes mobile-------------------------------------*/
        {
        #primeira{ /*height:200vh;*/height: 150vh;}

        .caixa{flex-direction: column;}

        #caixavidro{width: 96%;}

        #direitaPrimeira{min-height: 50vh;}
        
        .botao{}


        }

/*------------------------------------------------------*/
#logoatras{
    /*border: 1px solid red; */
    width: 30%;
    max-height: 15%;
    margin-bottom: 30px;
}
#textoa{
    color: #fff;
    font-size: 70%;
    font-weight: 500;
    text-align: center;
}
#formulario{
    
    display: flex;
    flex-direction: column;
    width: 85%;
    
}
#cpf, #email{
    display:block;
    padding:.8vh;
    width: 100%;
    font-size:2.5vh;
    font-weight:400;
    line-height:1;
    color:#0000007a;
    background-color:#fff;
    border:1px solid #ced4da;
    border-radius:.15rem;
}

.botao{
    color: white;
    font-size: 3vh;
    padding: 1.6vh;
    border:1px solid #1c9fff;
    border-radius: .6vh;

    background: -webkit-gradient(linear, left top, right top, color-stop(5%, #110c5e), color-stop(56%, #1c9fff), to(#cbf6ff));
    background: -o-linear-gradient(60deg, #110c5e 5%, #1c9fff 56%, #cbf6ff);

    box-shadow: 0px 0px 50px 10px #029aff86;


    background: linear-gradient(30deg, #110c5e 5%, #1c9fff 66%, #cbf6ff);
    background-size: 100% 100%;
    
    animation: pulse 1.5s infinite;
    -webkit-animation: pulse 1.5s infinite;
    
}
@-webkit-keyframes pulse { 
  0% {
    -webkit-box-shadow: 0 0 0 0 rgba(2, 141, 255, 0.7);
  }
  70% {
      -webkit-box-shadow: 0 0 0 1.5vh rgba(61,149,214, 0);
  }
  100% {
      -webkit-box-shadow: 0 0 0 0 rgba(61,149,214, 0);
  }
}
@keyframes pulse {
  0% {
    -moz-box-shadow: 0 0 0 0 rgba(2, 141, 255, 0.7);
    box-shadow: 0 0 0 0 rgba(2, 141, 255, 0.7);
  }
  70% {
      -moz-box-shadow: 0 0 0 1.5vh rgba(61,149,214, 0);
      box-shadow: 0 0 0 1.5vh rgba(61,149,214, 0);
  }
  100% {
      -moz-box-shadow: 0 0 0 0 rgba(61,149,214, 0);
      box-shadow: 0 0 0 0 rgba(61,149,214, 0);
  }}


/*---------------------------------------------------------------------------------------------*/

    </style>
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

                    <form id= formulario method="POST" action="{{ route('login.verifyLogin') }}">
                        @csrf
                        <div style="margin-bottom:.8vh;">
                            <input type="text" id="email" name="email" value="" placeholder="Insira seu E-Mail" required />
                        </div>
                        <div style="margin-bottom:1.5vh;" class="form-group">
                            <input type="text" id="cpf" name="cpf" value="" placeholder="Insira seu CPF" required />
                        </div>
                        
                        <input type="submit" value="LOGIN" class="botao" />
                        
                    
                    </form>
                    </div>
                </div>  
            </div>

                

            </div>
        </section>
<!---->

    </main>
    <script>
/*-----------------------------------------------------------------------------------------------*/

        const primeira = document.getElementById('primeira');
        primeira.addEventListener("mousemove", (e) =>{
            console.log(e);
            primeira.style.backgroundPositionX = (-e.screenX)/2 + "px";
            primeira.style.backgroundPositionY = (-e.screenY)/2 + "px";
        });

    </script>
</body>
</html>