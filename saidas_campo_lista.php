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
/**
 * Calcula o número de semanas de um mês
 * 
 * @param int $ano
 * @param int $mes
 * @param int $primeiroDiaSemana Intervalo 1 (Segunda-Feira) até 7 (domingo), segundo ISO-8601
 * @return int
 */
echo countSemanasMes(2021,10);
function countSemanasMes($ano, $mes, $primeiroDiaSemana = 7)
{
    $primeiroDiaMes = new DateTime("$ano-$mes-01");
    $ultimoDiaMes = new DateTime($primeiroDiaMes->format('Y-m-t'));

    $numSemanaInicio = $primeiroDiaMes->format('W');
    $numSemanaFinal  = $ultimoDiaMes->format('W') + 1;

    // Última semana do ano pode ser semana 1
    $numeroSemanas = ($numSemanaFinal < $numSemanaInicio)
        ? (52 + $numSemanaFinal) - $numSemanaInicio
        : $numSemanaFinal - $numSemanaInicio;

    if ($primeiroDiaMes->format('N') > $primeiroDiaSemana)
        $numeroSemanas--;

    if ($ultimoDiaMes->format('N') < $primeiroDiaSemana)
        $numeroSemanas--;

    return $numeroSemanas;
}



setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');
echo (strftime("%u")-1);
$cod = strftime("%u")-1;
function t($i){
    $dirigente = ["Moisés", "Roberto", "Raimundo", "Maurício", "Isac", "Francisco","Roberto"];
    $horario = ["18:00","18:00","18:00","---", "18:00", "8:30", "8:30"];
    $link = ["Link1", "Link2", "Link3","Link4","Link5","Link6", "Link7"];
    $dias = ["Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado", "Domingo"];
    return ["$dirigente[$i]","$horario[$i]", "$dias[$i]", "$link[$i]"];
} 

?>

<body>
    <div class="container px-1 px-sm-4 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="card text-center pt-4 border-0">
                <h4 class="mb-0"><?php echo t($cod)[0] ?></h4> <small class="text-muted mb-3">Dirigente</small>
                <small>
                    <h5><?php echo t($cod)[2] ?></h5>
                </small>
                <h2 class="large-font"><?php echo t($cod)[1] ?></h2>
                <small>
                    <a href='<?php echo t($cod)[3] ?>'>ENTRAR NA CONSIDERAÇÃO</a>
                </small>
                <div class="text-center mt-3 mb-4">
                    <!-- informações -->
                </div>



            <div class="linha d-flex px-3 mt-auto">
                <div class="d-flex flex-column block first-block"> <small class="text-muted mb-0">SEG</small>
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