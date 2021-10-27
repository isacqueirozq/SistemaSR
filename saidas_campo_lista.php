<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saídas de Campo</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<style>
    body {
        color: #7B1FA2;
        overflow-x: hidden;
        height: 100%;
        background-color: #6A1B9A;
        background-repeat: no-repeat
    }

    .card {
        width: 500px;
        background-color: #F3E5F5
    }

    .block {
        width: 20%;
        background-color: #E1BEE7;
        cursor: pointer;
        padding: 10px 0px
    }

    .linha {
        /* flex-wrap: wrap; */
        margin-right: -15px;
        margin-left: -15px;
    }

    .first-block {
        border-bottom-left-radius: 5px
    }

    .last-block {
        border-bottom-right-radius: 5px
    }

    .block.active,
    .block:hover {
        background-color: #CE93D8
    }

    .city-symbol {
        width: 200px;
        height: 250px
    }

    .large-font {
        font-size: 60px
    }

    .symbol-img {
        width: 40px;
        height: 40px
    }

    @media screen and (max-width: 400px) {
        .card {
            width: 92%
        }

        .block {
            width: 25%;
        }

        .linha {
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        strong {
            font-size: 0.9em;
        }



    }
</style>

<?php

setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');
//$cod = strftime("%u")-1; // Dia da semana numerico 1 (para Segunda) até 7 (para Domingo)
//echo date( 'w' ) % 6 ? 'Não é fim de semana' : 'é fim de semana';

function qtd_fimdesemana(){
    /*Verifica de acordo com a data atual quantos
    sábados e domingos tem dentro do mês corrente*/
    $ultimodia = idate('t');//Último dia do mês. Retorna 30 ou 31
    $iano = idate('Y');//ano
    $imes = idate('m');//mês
    $qtd_domingo=0;
    $qtd_sabado=0;
    $domingo = array();//criando array**
    $sabado = array();//criando array**
    for ($i=1; $i <= $ultimodia; $i++) { 
        $date = new DateTime();
        $date->setDate($iano, $imes, $i);//$i é o dia
        $a = $date->format('w');//0 domingo ou 6 sabado
        if ($a == 0) {
            $qtd_domingo++;
            array_push($domingo,$i);//adiciona o valor de $a a array.** 
        } 
        if ($a == 6) {
            $qtd_sabado++;
            array_push($sabado,$i);//adiciona o valor de $a a array.** 
        }
        
    }
    //Caso não tenha uma quinta semana incluir o campo em branco
    $result = count($sabado);
    if ($result == 4) {
        array_push($sabado,'');
    }
    $result_domingo  = count($domingo);
    if ($result_domingo == 4) {
        array_push($domingo,'');
    }

    //atribuir uma key
    $ordem = array('1','2','3','4','5');
    $nSabado = array_combine($ordem,$sabado);
    $nDomingo = array_combine($ordem,$domingo); 
    
    $px_sabado = date('d',strtotime("next Saturday"));//proximo Sábado a partir de hoje
    $px_domingo = date('d',strtotime("next Sunday"));//proximo domingo a partir de hoje
    $hoje = date('d');
    
    $se_sabado = array_keys($nSabado, $px_sabado);//Identificando o numero da semana do sábado
    $se_domingo = array_keys($nDomingo, $px_domingo);//Identificando o numero da semana do Domingo

    if ($se_sabado != "") {
        $return_sabado = $se_sabado[0];//Resultado que será enviado
    }else{
        $return_sabado = 1;
    }
    if ($se_domingo != "") {
        $return_domingo = $se_domingo[0];//Resultado que será enviado
    }else{
        $return_domingo = 1;
    }
    return [$return_sabado,$return_domingo];
}
function t($dia){
    //$dia ---- 1 para segunda e 7 para domingo
    $s1 = ["Moisés","Segunda","18:00","https://linkdodirigente"];
    $s2 = ["Roberto","Terça","18:00","https://linkdodirigente"];
    $s3 = ["Francisco","Quarta","18:00","https://linkdodirigente"];
    $s4 = ["---","Quinta","---","semcampo.html"];
    $s5 = ["Isac","Sexta","18:00","https://linkdodirigente"];
    $s6_1 = ["Roberto","Sábado","8:30","https://linkdodirigente"];
    $s6_2 = ["Isac","Sábado","8:30","https://linkdodirigente"];
    $s6_3 = ["Maurício","Sábado","8:30","https://linkdodirigente"];
    $s6_4 = ["Francisco","Sábado","8:30","https://linkdodirigente"];
    $s6_5 = ["Moisés","Sábado","8:30","https://linkdodirigente"];
    $s7_1 = ["Roberto","Domingo","8:30","https://linkdodirigente"];
    $s7_2 = ["Raimundo","Domingo","8:30","https://linkdodirigente"];
    $s7_3 = ["João Victor","Domingo","8:30","https://linkdodirigente"];
    $s7_4 = ["Márcio","Domingo","8:30","https://linkdodirigente"];
    $s7_5 = ["Samuel","Domingo","8:30","https://linkdodirigente"];
    
    $nsemana_sabado = qtd_fimdesemana()[0];//O mês tem 4 ou 5 semanas
    $nsemana_domingo = qtd_fimdesemana()[1];//O mês tem 4 ou 5 semanas

    if ($dia == 1) {
        return $s1;
    }elseif ($dia == 2){
        return $s2;   
    }elseif ($dia == 3){
        return $s3; 
    }elseif ($dia == 4){
        return $s4;   
    }elseif ($dia == 5){
        return $s5;   
    }elseif ($dia == 6){
        //Sábado
        if ($nsemana_sabado == 1) {
            return $s6_1;
        }elseif($nsemana_sabado == 2){
            return $s6_2;
        }elseif($nsemana_sabado == 3){
            return $s6_3;
        }elseif($nsemana_sabado == 4){
            return $s6_4;
        }elseif($nsemana_sabado == 5){
            return $s6_5;
        }
           
    }elseif ($dia == 7){
        //Domingo
        if ($nsemana_domingo == 1) {
            return $s7_1;
        }elseif($nsemana_domingo == 2){
            return $s7_2;
        }elseif($nsemana_domingo == 3){
            return $s7_3;
        }elseif($nsemana_domingo == 4){
            return $s7_4;
        }elseif($nsemana_domingo == 5){
            return $s7_5;
        }  
    }
} 
?>
<body>
    <div class="container px-1 px-sm-4 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="card text-center pt-4 border-0">
                <div id="display">
                    <?php
                    $dia = date('N'); // 1 para segunda e 7 para domingo
                    echo "<h4 class='mb-0'>".t($dia)[0]."</h4> <small class='text-muted mb-3'>Dirigente</small>
                    <small>
                        <h5>".t($dia)[1]."</h5>
                    </small>
                    <h2 class='large-font'>".t($dia)[2]."</h2>
                    <small>
                        <a href='".t($dia)[3]."'>LINK DA CONSIDERAÇÃO VIA ZOOM</a>
                    </small>
                    <div class='text-center mt-3 mb-4'>
                        <!-- informações -->
                    </div>"
                    ?>
                </div>


            <div class="linha d-flex px-3 mt-auto">
                
                <div class="d-flex flex-column block first-block">      <small class="text-muted mb-0">SEG</small>
                    <div class="text-center"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                    <h6><strong>18:00</strong></h6>
                </div>
                <div class="d-flex flex-column block"> <small class="text-muted mb-0">TER</small>
                    <div class="text-center"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                    <h6><strong>18:00</strong></h6>
                </div>
                <div class="d-flex flex-column block active"> <small class="text-muted mb-0">QUA</small>
                    <div class="text-center"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                    <h6><strong>18:00</strong></h6>
                </div>
                <div class="d-flex flex-column block"> <small class="text-muted mb-0">QUI</small>
                    <div class="text-center"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/1147/1147965.png"></div>
                    <h6><strong>-</strong></h6>
                </div>
                <div class="d-flex flex-column block"> <small class="text-muted mb-0">SEX</small>
                    <div class="text-center"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                    <h6><strong>18:00</strong></h6>
                </div>
                <div class="d-flex flex-column block"> <small class="text-muted mb-0">SAB</small>
                    <div class="text-center"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                    <h6><strong>8:30</strong></h6>
                </div>
                <div class="d-flex flex-column block last-block"> <small class="text-muted mb-0">DOM</small>
                    <div class="text-center"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                    <h6><strong>8:30</strong></h6>
                </div>

            </div>
            </div>
        </div>
    </div>
</body>
</html>