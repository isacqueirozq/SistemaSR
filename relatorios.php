<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Resumo da Congregação</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://rawgit.com/pguso/jquery-plugin-circliful/1.0.2/js/jquery.circliful.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        .columns {
            float: left;
            width: 33.3%;
            padding: 8px;
        }

        .menor {
            width: 30%;
            min-width: 250px;
        }

        .resumo {
            list-style-type: none;
            border: 1px solid #eee;
            margin: 0;
            padding: 0;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .resumo:hover {
            box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.2)
        }

        .resumo .header {
            background-color: #111;
            color: white;
            font-size: 25px;
        }

        .resumo li {
            border-bottom: 1px solid #eee;
            padding: 10px;
            text-align: center;
        }

        .resumo .grey {
            background-color: #eee;
            font-size: 20px;
        }

        .resumo .grey p {
            color: darkgrey;
            font-size: 18px;
        }

        .button {
            background-color: #04AA6D;
            border: none;
            color: white;
            padding: 10px 25px;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
        }

        .info {
            width: 100%;
            text-align: right;
            font-size: 1.5rem;
            padding-right: 5px;
        }

        .info p {
            margin: 0;
        }

        .info span {
            display: inline-block;
            min-width: 25px;
            margin: 0 10px 0 5px;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        @media only screen and (max-width: 600px) {
            .columns {
                width: 100%;
            }
        }
    </style>

</head>

<body>
    <!-- GRÁFICO -->
    <div class="columns menor">
        <ul class="resumo">

            <?php
            require_once("src/Carrega_dados.php");
            // Data correta ----------------------------------------------------
            setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
            date_default_timezone_set('America/Sao_Paulo');
            $anoAtual = date("Y");
            $anoAnterior = date("Y") - 1;
            $mes = date("m") - 1;
            $mesNome = strftime('%B', strtotime("01-" . $mes . "-" . date("Y")));
            // ---------------------------------------------------------------


            try {
                $stmt = $conn->prepare("SELECT 
                                            COUNT(Nome) AS rel_total
                                            FROM RELATORIO_CAMPO 
                                            WHERE Mes = $mes");
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $rel_total = $rs->rel_total;
                    }
                } else {
                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                }
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }

            // MES
            $publicadores_qtd = 49;
            $percentual = round($rel_total / $publicadores_qtd * 100);
            ?>

            <li class="grey">Reletórios enviados <p>Mês: <?php echo $mesNome; ?></p>
            </li>
            <div id="test-circle5"></div>
            <script>
                $(document).ready(function() { // 6,32 5,38 2,34
                    $("#test-circle5").circliful({
                        animationStep: 5,
                        foregroundBorderWidth: 5,
                        backgroundBorderWidth: 15,
                        percent: <?php echo $percentual; ?>,
                        halfCircle: 1,
                    });
                });
            </script>
        </ul>
    </div>
    <!-- GERAL -->
    <a href="relatorio_lista_todos.php">
        <div class="columns menor">
            <ul class="resumo">
                <!-- <li class="header" style="background-color:#04AA6D">Pro</li> -->
                <li class="grey">Congregação</li>

                <?php
                // ###############
                // # Congregação #
                // ###############
                try {
                    $stmt = $conn->prepare("SELECT 
                                            SUM(Publicacoes) AS pub_total, 
                                            TRUNCATE(AVG(Publicacoes),1) AS pub_med,
                                            SUM(Videos) AS vid_total, 
                                            TRUNCATE(AVG(Videos),1) AS vid_med,
                                            SUM(Horas) AS hrs_total, 
                                            TRUNCATE(AVG(Horas),1) AS hrs_med,
                                            SUM(Revisitas) AS rev_total, 
                                            TRUNCATE(AVG(Revisitas),1) AS rev_med,
                                            SUM(Estudos) AS est_total, 
                                            TRUNCATE(AVG(Estudos),1) AS est_med,
                                            COUNT(Nome) AS total
                                            FROM RELATORIO_CAMPO 
                                            WHERE Mes = $mes");
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $pub_total = $rs->pub_total;
                            $pub_med = $rs->pub_med;
                            $vid_total = $rs->vid_total;
                            $vid_med = $rs->vid_med;
                            $hrs_total = $rs->hrs_total;
                            $hrs_med = $rs->hrs_med;
                            $rev_total = $rs->rev_total;
                            $rev_med = $rs->rev_med;
                            $est_total = $rs->est_total;
                            $est_med = $rs->est_med;
                            $total = $rs->total;
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: " . $erro->getMessage();
                }
                // ###############
                ?>

                <div class="info">
                    <br>
                    <p>Total | Média</p>
                    <p>Publicadores Ativos:<span><?php echo $publicadores_qtd; ?></span>|<span></span></p>
                    <p>Relatórios:<span><?php echo $total; ?></span>|<span></span></p>
                    <p>Publicações:<span><?php echo $pub_total; ?></span>|<span><?php echo $pub_med; ?></span></p>
                    <p>Videos Mostrados<span><?php echo $vid_total; ?></span>|<span><?php echo $vid_med; ?></span></p>
                    <p>Horas:<span><?php echo $hrs_total; ?></span>|<span><?php echo $hrs_med; ?></span></p>
                    <p>Revisitas:<span><?php echo $rev_total; ?></span>|<span><?php echo $rev_med; ?></span></p>
                    <p>Estudos:<span><?php echo $est_total; ?></span>|<span><?php echo $est_med; ?></span></p>
                    <br>
                </div>
            </ul>
        </div>
    </a>
    <!-- PUBLICADORES -->
    <a href="relatorio_lista_publicadores.php">
        <div class="columns menor">
            <ul class="resumo">
                <!-- <li class="header" style="background-color:#04AA6D">Pro</li> -->
                <li class="grey">Publicadores</li>

                <?php
                // ###############
                // # PUBLICADORES #
                // ###############
                try {
                    $stmt = $conn->prepare("SELECT 
                                                SUM(Publicacoes) AS pub_total, 
                                                TRUNCATE(AVG(Publicacoes),1) AS pub_med,
                                                SUM(Videos) AS vid_total, 
                                                TRUNCATE(AVG(Videos),1) AS vid_med,
                                                SUM(Horas) AS hrs_total, 
                                                TRUNCATE(AVG(Horas),1) AS hrs_med,
                                                SUM(Revisitas) AS rev_total, 
                                                TRUNCATE(AVG(Revisitas),1) AS rev_med,
                                                SUM(Estudos) AS est_total, 
                                                TRUNCATE(AVG(Estudos),1) AS est_med,
                                                COUNT(Nome) AS total
                                                FROM RELATORIO_CAMPO 
                                                WHERE Mes = $mes
                                                AND Pioneiro = 0");
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $Ppub_total = $rs->pub_total;
                            $Ppub_med = $rs->pub_med;
                            $Pvid_total = $rs->vid_total;
                            $Pvid_med = $rs->vid_med;
                            $Phrs_total = $rs->hrs_total;
                            $Phrs_med = $rs->hrs_med;
                            $Prev_total = $rs->rev_total;
                            $Prev_med = $rs->rev_med;
                            $Pest_total = $rs->est_total;
                            $Pest_med = $rs->est_med;
                            $Ptotal = $rs->total;
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: " . $erro->getMessage();
                }
                // ###############
                ?>

                <div class="info">
                    <br>
                    <p>Total | Média</p>
                    <br>
                    <p>Relatórios:<span><?php echo $Ptotal; ?></span>|<span></span></p>
                    <p>Publicações:<span><?php echo $Ppub_total; ?></span>|<span><?php echo $Ppub_med; ?></span></p>
                    <p>Videos Mostrados<span><?php echo $Pvid_total; ?></span>|<span><?php echo $Pvid_med; ?></span></p>
                    <p>Horas:<span><?php echo $Phrs_total; ?></span>|<span><?php echo $Phrs_med; ?></span></p>
                    <p>Revisitas:<span><?php echo $Prev_total; ?></span>|<span><?php echo $Prev_med; ?></span></p>
                    <p>Estudos:<span><?php echo $Pest_total; ?></span>|<span><?php echo $Pest_med; ?></span></p>
                    <br>
                </div>
            </ul>
        </div>
    </a>
    <!-- AUXILIARES -->
    <a href="relatorio_lista_auxiliares.php">
        <div class="columns menor">
            <ul class="resumo">
                <!-- <li class="header" style="background-color:#04AA6D">Pro</li> -->
                <li class="grey">Pioneiros Auxiliares</li>

                <?php
                // ###############
                // # PUBLICADORES #
                // ###############
                try {
                    $stmt = $conn->prepare("SELECT 
                                                SUM(Publicacoes) AS pub_total, 
                                                TRUNCATE(AVG(Publicacoes),1) AS pub_med,
                                                SUM(Videos) AS vid_total, 
                                                TRUNCATE(AVG(Videos),1) AS vid_med,
                                                SUM(Horas) AS hrs_total, 
                                                TRUNCATE(AVG(Horas),1) AS hrs_med,
                                                SUM(Revisitas) AS rev_total, 
                                                TRUNCATE(AVG(Revisitas),1) AS rev_med,
                                                SUM(Estudos) AS est_total, 
                                                TRUNCATE(AVG(Estudos),1) AS est_med,
                                                COUNT(Nome) AS total
                                                FROM RELATORIO_CAMPO 
                                                WHERE Mes = $mes
                                                AND Pioneiro = 1");
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $Apub_total = $rs->pub_total;
                            $Apub_med = $rs->pub_med;
                            $Avid_total = $rs->vid_total;
                            $Avid_med = $rs->vid_med;
                            $Ahrs_total = $rs->hrs_total;
                            $Ahrs_med = $rs->hrs_med;
                            $Arev_total = $rs->rev_total;
                            $Arev_med = $rs->rev_med;
                            $Aest_total = $rs->est_total;
                            $Aest_med = $rs->est_med;
                            $Atotal = $rs->total;
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: " . $erro->getMessage();
                }
                // ###############
                ?>

                <div class="info">
                    <br>
                    <p>Total | Média</p>
                    <br>
                    <p>Relatórios:<span><?php echo $Atotal; ?></span>|<span></span></p>
                    <p>Publicações:<span><?php echo $Apub_total; ?></span>|<span><?php echo $Apub_med; ?></span></p>
                    <p>Videos Mostrados<span><?php echo $Avid_total; ?></span>|<span><?php echo $Avid_med; ?></span></p>
                    <p>Horas:<span><?php echo $Ahrs_total; ?></span>|<span><?php echo $Ahrs_med; ?></span></p>
                    <p>Revisitas:<span><?php echo $Arev_total; ?></span>|<span><?php echo $Arev_med; ?></span></p>
                    <p>Estudos:<span><?php echo $Aest_total; ?></span>|<span><?php echo $Aest_med; ?></span></p>
                    <br>
                </div>
            </ul>
        </div>
    </a>
    <!-- REGULARES -->
    <a href="relatorio_lista_regulares.php">
        <div class="columns menor">
            <ul class="resumo">
                <!-- <li class="header" style="background-color:#04AA6D">Pro</li> -->
                <li class="grey">Pioneiros Regulares</li>

                <?php
                // ###############
                // # PUBLICADORES #
                // ###############
                try {
                    $stmt = $conn->prepare("SELECT 
                                                        SUM(Publicacoes) AS pub_total, 
                                                        TRUNCATE(AVG(Publicacoes),1) AS pub_med,
                                                        SUM(Videos) AS vid_total, 
                                                        TRUNCATE(AVG(Videos),1) AS vid_med,
                                                        SUM(Horas) AS hrs_total, 
                                                        TRUNCATE(AVG(Horas),1) AS hrs_med,
                                                        SUM(Revisitas) AS rev_total, 
                                                        TRUNCATE(AVG(Revisitas),1) AS rev_med,
                                                        SUM(Estudos) AS est_total, 
                                                        TRUNCATE(AVG(Estudos),1) AS est_med,
                                                        COUNT(Nome) AS total
                                                        FROM RELATORIO_CAMPO 
                                                        WHERE Mes = $mes
                                                        AND Pioneiro IN ('2','3')");
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $Ppub_total = $rs->pub_total;
                            $Ppub_med = $rs->pub_med;
                            $Pvid_total = $rs->vid_total;
                            $Pvid_med = $rs->vid_med;
                            $Phrs_total = $rs->hrs_total;
                            $Phrs_med = $rs->hrs_med;
                            $Prev_total = $rs->rev_total;
                            $Prev_med = $rs->rev_med;
                            $Pest_total = $rs->est_total;
                            $Pest_med = $rs->est_med;
                            $Ptotal = $rs->total;
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: " . $erro->getMessage();
                }
                // ###############
                ?>

                <div class="info">
                    <br>
                    <p>Total | Média</p>
                    <br>
                    <p>Relatórios:<span><?php echo $Ptotal; ?></span>|<span></span></p>
                    <p>Publicações:<span><?php echo $Ppub_total; ?></span>|<span><?php echo $Ppub_med; ?></span></p>
                    <p>Videos Mostrados<span><?php echo $Pvid_total; ?></span>|<span><?php echo $Pvid_med; ?></span></p>
                    <p>Horas:<span><?php echo $Phrs_total; ?></span>|<span><?php echo $Phrs_med; ?></span></p>
                    <p>Revisitas:<span><?php echo $Prev_total; ?></span>|<span><?php echo $Prev_med; ?></span></p>
                    <p>Estudos:<span><?php echo $Pest_total; ?></span>|<span><?php echo $Pest_med; ?></span></p>
                    <br>
                </div>
            </ul>
        </div>
    </a>

</body>

</html>