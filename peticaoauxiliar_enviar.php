<?php
require_once("src/Comandos.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petição de P. Auxiliar</title>
    <link rel="shortcut icon" href="/img/p_auxiliar.ico" type="image/x-icon">

    <meta property="og:title" content="Petição de Pioneiro Auxiliar">
    <meta property="og:site_name" content="Cong. Sto Antonio dos Lopes" />
    <meta property="og:url" content="https://abre.ai/quadrocongsal" />
    <meta property="og:description" content="RESPONDA A JEOVÁ: PORQUE AINDA NÃO SOU PIONEIRO?" />

    <!-- Favicon -->
    <meta property="og:image" content="https://assetsnffrgf-a.akamaihd.net/assets/m/202021023/univ/art/202021023_univ_sqr_xl.jpgpeticao.pnghttps://findicons.com/files/icons/1722/gnome_2_18_icon_theme/24/stock_form_line_horizontal.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="60">
    <meta property="og:image:height" content="60">
    <!--  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <style>
        #palco{
            width:70%;
            margin:auto;
            margin-top:20px;
            border: 1px solid #e1e9ff;
        }

        .conteiner {
            text-align: center;
        }

        p {
            text-align: justify;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            border-top: none;
            border-left: none;
            border-right: none;
        }

        .destaque {
            background-color: beige;
            padding: 8px 20px;
        }

        select {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px 20px;
        }

        .custom-select {
            padding: 5px 5px;
        }

        .column {
            float: left;
            width: 50%;
        }

        /* Clear floats after the columns */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        #btn_enviar {
            border: none;
            /* Remove borders */
            color: white;
            /* Add a text color */
            padding: 14px 28px;
            /* Add some padding */
            cursor: pointer;
            /* Add a pointer cursor on mouse-over */
            background-color: #04AA6D;
            /*color green */
        }

        #btn_enviar:hover {
            background-color: #46a049;
        }
        @media screen  and (max-width: 500px){
            #palco{
            width: 95%;
            margin-top: 5px;
            }
        }
        
        
            
        
    </style>

</head>

<body>
    <div id="palco" class="shadow p-4 mb-4 bg-white">
        <div class="conteiner">
            <h3>Petição para o Serviço de Pioneiro Auxiliar</h3>
            <br>
            <form action="?act=Salvar_PETICAO_AUXILIAR" method="POST" name="Pioneiro_Auxiliar">

                <input class="destaque" type="text" name="nome" id="nome" placeholder="COLOQUE SEU NOME COMPLETO" required>
                <p>Por causa do meu amor a Jeová e do meu desejo de ajudar outros a aprender sobre ele e seus amorosos propósitos, gostaria de aumentar minha participação no serviço de campo por trabalhar como pioneiro auxiliar no período indicado abaixo:</p>
                <input type="hidden" name="ano" id="ano" placeholder="Ano" value="<?php echo date('Y') ?>">
                <div class="custom-select">
                    <select name="mes" id="mes" required>
                        <option value="">Escolha o mês clicando aqui</option>
                        <option value="0">Tempo Indeterminado</option>
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>
                <p>Requisito de Horas:</p>
                <div class="row">
                    <div class="column"><input type="radio" name="requisito" id="requisito30" value="30">30 Horas</div>
                    <div class="column"><input type="radio" name="requisito" id="requisito50" value="50" checked>50 Horas</div>
                </div>

                <br>
                <p>Tenho boa reputação moral e bons hábitos. Fiz uma programação que me permitira cumprir o requisito de horas. -Veja o Nosso Ministério do Reino de junho de 2013 p.2</p>
                <input id="btn_enviar" type="submit" value="Enviar Petição para os Anciãos">
            </form>
        </div>
    </div>

</body>

</html>