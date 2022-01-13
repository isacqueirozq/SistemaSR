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
    $nsemana_sabado = qtd_fimdesemana()[0];//Mês tem 4 ou 5 semanas
    $nsemana_domingo = qtd_fimdesemana()[1];//Mês tem 4 ou 5 semanas
    require("src/ConexaoBD.php");
    try {     
            //Caso não seja sábado e domingo       
            if ($dia != 1 || $dia != 7) {
                $semana = 0;
            }
            //Caso seja sábado
            if ($dia == 7){ $semana = $nsemana_sabado; } 
            //Caso seja domingo
            if ($dia == 1){ $semana = $nsemana_domingo; } 
            $stmt = $conn->prepare("SELECT * FROM SAIDA_CAMPO WHERE Dia_Semana = $dia AND Semana_do_mes = $semana");
            if ($stmt->execute()) {
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $id = $rs->ID;
                    $diasemana = $rs->Dia_Semana;
                    if ($diasemana == 1) {
                        $diasemana = "Domingo";
                    } elseif ($diasemana == 2) {
                        $diasemana = "Segunda";
                    } elseif ($diasemana == 3) {
                        $diasemana = "Terça";
                    } elseif ($diasemana == 4) {
                        $diasemana = "Quarta";
                    } elseif ($diasemana == 5) {
                        $diasemana = "Quinta";
                    } elseif ($diasemana == 6) {
                        $diasemana = "Sexta";
                    } elseif ($diasemana == 7) {
                        $diasemana = "Sábado";
                    }
                    // $semanames = $rs->Semana_do_mes;
                    $dirigente = $rs->Dirigente;
                    $link = $rs->Link;

                    //mostrando hora e minuto e retirando os segundos
                    $hora = date("H:i", strtotime(".$rs->Hora."));

                    return [$dirigente,$diasemana,$hora,$link];
                }
            } else {
                echo "Erro: Não foi possível recuperar os dados do banco de dados";
            }
       
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
    /*echo "S".$nsemana_sabado;
    echo "D".$nsemana_domingo;
    print_r($dia);            
    return ["Moisés","Segunda","18:00","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $dia ---- 1 para segunda e 7 para domingo
    dirigente, dia,hora, link, semana(0 para todas)

    $s1 = ["Moisés","Segunda","18:00","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s2 = ["Roberto","Terça","18:00","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s3 = ["Francisco","Quarta","18:00","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s4 = ["---","Quinta","-- : --","semcampo.html"];
    $s5 = ["Isac","Sexta","18:00","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s6_1 = ["Roberto","Sábado","8:30","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s6_2 = ["Isac","Sábado","8:30","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s6_3 = ["Maurício","Sábado","8:30","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s6_4 = ["Francisco","Sábado","8:30","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s6_5 = ["Moisés","Sábado","8:30","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s7_1 = ["Roberto","Domingo","8:30","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s7_2 = ["Raimundo","Domingo","8:30","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s7_3 = ["João Victor","Domingo","8:30","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s7_4 = ["Márcio","Domingo","8:30","https://jworg.zoom.us/my/santoantoniodoslopes"];
    $s7_5 = ["Samuel","Domingo","8:30","https://jworg.zoom.us/my/santoantoniodoslopes"];
    
    

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
    }*/
} 

function mostrar($dia, $semana){
    /*
    Função que preenche a tela com as
    informações do banco de dados. Considerando
    Dia - 1 é domingo e 7 é sabado
    Semana - 0 é todas e 5 é quinta semana
    */

    //Necessários
    require_once("src/ConexaoBD.php");
    setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
    date_default_timezone_set('America/Sao_Paulo');

    //Consulta da Base sql
    try {
        $today = date('N');
        if ($dia == $today) {
            echo "<p class='caption-container'>HOJE</p>";
        }
        if ($dia != 1 || $dia != 7) {
            $semana = 0;
        }
        $stmt = $conn->prepare("SELECT * FROM SAIDA_CAMPO WHERE Dia_Semana = $dia AND Semana_do_mes = $semana");
        if ($stmt->execute()) {
            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                $id = $rs->ID;
                $diasemana = $rs->Dia_Semana;
                if ($diasemana == 1) {
                    $diasemana = "Domingo";
                } elseif ($diasemana == 2) {
                    $diasemana = "Segunda";
                } elseif ($diasemana == 3) {
                    $diasemana = "Terça";
                } elseif ($diasemana == 4) {
                    $diasemana = "Quarta";
                } elseif ($diasemana == 5) {
                    $diasemana = "Quinta";
                } elseif ($diasemana == 6) {
                    $diasemana = "Sexta";
                } elseif ($diasemana == 7) {
                    $diasemana = "Sábado";
                }
                // $semanames = $rs->Semana_do_mes;
                $dirigente = $rs->Dirigente;
                $link = $rs->Link;

                //mostrando hora e minuto e retirando os segundos
                $hora = date("H:i", strtotime(".$rs->Hora."));

                // if ($diasemana == "") {
                //     $diasemana = "Não designado";
                // }
                // if ($dirigente == "") {
                //     $dirigente = "Não designado";
                // }
                // if ($link == "") {
                //     $link = "Não informado";
                // }
                // if ($hora == "") {
                //     $hora = "Não informado";
                // }
                //Verifica se o dia escolhido é igual ao dia de hoje

                // Exibi os dados
                echo "<h4 class='mb-0'>" . $dirigente . "</h4> <small class='text-muted mb-3'>Dirigente</small>
                            <small>
                                <h5>" . $diasemana . "</h5>
                            </small>
                            <h2 class='large-font'>" . $hora . "</h2>
                            <small>
                                <a href='" . $link . "'>LINK DA CONSIDERAÇÃO VIA ZOOM</a>
                            </small>
                            <div class='text-center mt-3 mb-4'>
                                <!-- informações -->
                            </div>";
            }
        } else {
            echo "Erro: Não foi possível recuperar os dados do banco de dados";
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
?>
<body>
    <div class="container px-1 px-sm-4 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="card text-center pt-4 border-0">
                <!-- VISOR -->
                <div id="display">
                    <?php
                        function padrao($dia){
                            if ($dia == "") {
                                $dia = date('N'); // 1 para segunda e 7 para domingo
                            }
                        
                            $today = date('N')+1;
                            if ($dia == $today) {
                                echo "<p class='caption-container'>HOJE</p>";
                            }
                            $dado = t($dia);
                            echo "<h4 class='mb-0'>".$dado[0]."</h4> <small class='text-muted mb-3'>Dirigente</small>
                            <small>
                                <h5>".$dado[1]."</h5>
                            </small>
                            <h2 class='large-font'>".$dado[2]."</h2>
                            <small>
                                <a href='".$dado[3]."'>LINK DA CONSIDERAÇÃO VIA ZOOM</a>
                            </small>
                            <div class='text-center mt-3 mb-4'>
                                <!-- informações -->
                            </div>";
                        }
                        // padrao(0);
                    ?>
                    <!-- **** Slide ***  -->
                    <style>
                        * {
                        box-sizing: border-box;
                        }

                        /* Position the image container (needed to position the left and right arrows) */
                        .container {
                        position: relative;
                        }

                        /* Hide the images by default */
                        .mySlides {
                        display: none;
                        }

                        /* Add a pointer when hovering over the thumbnail images */
                        .cursor {
                        cursor: pointer;
                        }

                        /* Next & previous buttons */
                        .prev,
                        .next {
                        cursor: pointer;
                        position: absolute;
                        top: 40%;
                        width: auto;
                        padding: 16px;
                        margin-top: -50px;
                        color: white;
                        font-weight: bold;
                        font-size: 20px;
                        border-radius: 0 3px 3px 0;
                        user-select: none;
                        -webkit-user-select: none;
                        }

                        /* Position the "next button" to the right */
                        .next {
                        right: 0;
                        border-radius: 3px 0 0 3px;
                        }
                        .prev {
                        left: 0;
                        border-radius: 3px 0 0 3px;
                        }

                        /* On hover, add a black background color with a little bit see-through */
                        .prev:hover,
                        .next:hover {
                        background-color: rgba(0, 0, 0, 0.8);
                        }

                        /* Number text (1/3 etc) */
                        .numbertext {
                        color: #f2f2f2;
                        font-size: 12px;
                        padding: 8px 12px;
                        position: absolute;
                        top: 0;
                        display: none;
                        }

                        /* Container for image text */
                        .caption-container {
                        text-align: center;
                        background-color:darkcyan;
                        padding: 2px 16px;
                        color: white;
                        }

                        .row:after {
                        content: "";
                        display: table;
                        clear: both;
                        }

                        /* Six columns side by side */
                        .column {
                        float: left;
                        width: 16.66%;
                        }

                        /* Add a transparency effect for thumnbail images */
                        .demo {
                        opacity: 0.6;
                        }

                        .active,
                        .demo:hover {
                        opacity: 1;
                        }
                    </style>
                    <div class="container">
                        <!-- Full-width images with number text -->
                        <div class="mySlides">
                            <!-- numbertext está sendo oculto no css -->
                            <!-- 1 é domingo 7 é sábado -->
                            <div class="numbertext">0 / 0</div> 
                            <?php $hoje = date('N')+1; padrao($hoje);?>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">1 / 7</div>
                            <?php padrao(2);?>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">2 / 7</div>
                            <?php padrao(3);?>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">3 / 7</div>
                            <?php padrao(4);?>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">4 / 7</div>
                            <?php padrao(5);?>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">5 / 7</div>
                            <?php padrao(6);?>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">6 / 7</div>
                            <?php padrao(7);?>
                        </div>

                        <div class="mySlides">
                            <div class="numbertext">7 / 7</div>
                            <?php padrao(1);?>
                        </div>

                        <!-- Next and previous buttons -->
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>

                        <!-- Image text -->
                        <div class="caption-container" hidden>
                            <p id="caption"></p>
                        </div>

                        <script>
                            var slideIndex = 1;
                            showSlides(slideIndex);

                            // Next/previous controls
                            function plusSlides(n) {
                            showSlides(slideIndex += n);
                            }

                            // Thumbnail image controls
                            function currentSlide(n) {
                            showSlides(slideIndex = n);
                            }

                            function showSlides(n) {
                            var i;
                            var slides = document.getElementsByClassName("mySlides");
                            var dots = document.getElementsByClassName("demo");
                            var captionText = document.getElementById("caption");
                            if (n > slides.length) {slideIndex = 1}
                            if (n < 1) {slideIndex = slides.length}
                            for (i = 0; i < slides.length; i++) {
                                slides[i].style.display = "none";
                            }
                            for (i = 0; i < dots.length; i++) {
                                dots[i].className = dots[i].className.replace(" active", "");
                            }
                            slides[slideIndex-1].style.display = "block";
                            dots[slideIndex-1].className += " active";
                            captionText.innerHTML = dots[slideIndex-1].alt;
                            } 
                        </script>
                        <!-- Fim Slide -->
                    </div>
                </div>

                <!-- MENU INFERIOR -->
                <div class="linha d-flex px-3 mt-auto">
                    <div hidden>
                        <div class="d-flex flex-column block first-block demo">      <small class="text-muted mb-0">HOJE</small>
                            <div class="text-center" onclick="currentSlide(1)"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                            <h6><strong>18:00</strong></h6>
                        </div>
                    </div>
                    <div class="d-flex flex-column block first-block demo">      
                        <small class="text-muted mb-0">SEG</small>
                        <div class="text-center" onclick="currentSlide(2)"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                        <h6><strong>18:00</strong></h6>
                    </div>
                    <div class="d-flex flex-column block demo"> 
                        <small class="text-muted mb-0">TER</small>
                        <div class="text-center" onclick="currentSlide(3)"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                        <h6><strong>18:00</strong></h6>
                    </div>
                    <div class="d-flex flex-column block demo"> 
                        <small class="text-muted mb-0">QUA</small>
                        <div class="text-center" onclick="currentSlide(4)"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                        <h6><strong>18:00</strong></h6>
                    </div>
                    <div class="d-flex flex-column block demo"> 
                        <small class="text-muted mb-0">QUI</small>
                        <div class="text-center" onclick="currentSlide(5)"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/1147/1147965.png"></div>
                        <h6><strong>-</strong></h6>
                    </div>
                    <div class="d-flex flex-column block demo"> 
                        <small class="text-muted mb-0">SEX</small>
                        <div class="text-center" onclick="currentSlide(6)"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                        <h6><strong>18:00</strong></h6>
                    </div>
                    <div class="d-flex flex-column block demo"> 
                        <small class="text-muted mb-0">SAB</small>
                        <div class="text-center" onclick="currentSlide(7)"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                        <h6><strong>8:30</strong></h6>
                    </div>
                    <div class="d-flex flex-column block last-block demo"> 
                        <small class="text-muted mb-0">DOM</small>
                        <div class="text-center" onclick="currentSlide(8)"><img class="symbol-img" src="https://image.flaticon.com/icons/png/512/609/609040.png"></div>
                        <h6><strong>8:30</strong></h6>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>