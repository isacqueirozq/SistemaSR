<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Relatório de atividades</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" href="https://rawgit.com/pguso/jquery-plugin-circliful/1.0.2/css/jquery.circliful.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://rawgit.com/pguso/jquery-plugin-circliful/1.0.2/js/jquery.circliful.js"></script>

    <style>
        body {
            padding-top: 10px;
            background: #fff;
        }

        .conteudo {
            width: 95%;
            margin: 0 auto;
            padding: 5%;
            background-color: #f5f5f5;
            border: 1px solid #f3f3f3;

        }

        .conteudo p {
            margin-bottom: 0;
        }

        .col-2 {
            width: 16.66666667%;
            float: left;
            position: relative;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (max-width:400px) {
            .col-2 {
                width: 50%;
                float: left;
            }

            .resumo {
                text-align: right;
                font-size: 1.2rem;
                padding-right: 5px;
            }
        }
    </style>

</head>

<body>
    <section id="Grafico">
        <div class="conteudo">
            <div class="row">
                <div class="col-2">
                    <div id="test-circle5"></div>
                </div>
                <div class="resumo">
                    <p><span>Total</span>|<span>Média</span></p>
                    <p>Publicadores Ativos:<span>000</span>|<span>000</span></p>
                    <p>Relatórios:<span>000</span>|<span>000</span></p>
                    <p>Publicações:<span>000</span>|<span>000</span></p>
                    <p>Videos Mostrados<span>000</span>|<span>000</span></p>
                    <p>Horas:<span>000</span>|<span>000</span></p>
                    <p>Revisitas:<span>000</span>|<span>000</span></p>
                    <p>Estudos:<span>000</span>|<span>000</span></p>
                </div>
            </div>
            <script>
                $(document).ready(function() { // 6,32 5,38 2,34
                    $("#test-circle5").circliful({
                        animationStep: 5,
                        foregroundBorderWidth: 5,
                        backgroundBorderWidth: 15,
                        percent: 100,
                        halfCircle: 1,
                    });
                });
            </script>
        </div>
    </section>


</body>

</html>