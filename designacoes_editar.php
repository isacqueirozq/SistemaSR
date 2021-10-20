<!DOCTYPE html>
<html lang="pt-br">

<head>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="Terno.ico" type="image/x-icon">
    <title>Criar Designaçoes</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <style>
        body {
            color: #999;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }

        /* Centraliza o palco */
        .caixa_formulario {
            width: 340px;
            margin: 0 auto;
            padding: 30px 0;
        }

        .caixa_formulario form {
            border-radius: 1px;
            margin-bottom: 15px;
            background: #fff;
            border: 1px solid #f3f3f3;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }

        .caixa_formulario h2 {
            color: #636363;
            margin: 0 0 15px;
            text-align: center;
            font-size: 2rem;
        }

        .caixa_formulario h4 {
            color: white;
            min-height: 38px;
        }

        .tesouro {
            background-color: #999999;
        }

        .faca {
            background-color: #f1c232;
        }

        .vida {
            background-color: #a61c00;
        }

        .publica {
            background-color: #26618e;
        }

        .titulo_menor {
            font-size: 14px;
            margin-bottom: 30px;
            text-align: center;
        }

        .grupo-item {
            margin-bottom: 10px;
            font-weight: 400;
            line-height: 1.5;
        }

        .centro {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        label {
            font-weight: normal;
            font-size: 14px;
        }

        .controle-itens,
        .controle-itens:focus,
        .icone {
            border-color: #e1e1e1;
            border-radius: 0;
            background-color: white;
        }

        .icone {
            max-width: 42px;
            text-align: center;
            background: none;
            /* border-bottom: 1px solid #e1e1e1; */
            padding-left: 5px;
        }

        .fa {
            font-size: 21px;
            position: relative;
            top: 25px;
        }

        .fas {
            font-size: 21px;
            position: relative;
            top: 30px;
        }

        .controle-itens {
            text-align: center;
            font-size: 18px;
            width: 100%;
            min-height: 38px;
            box-shadow: none !important;
            border-width: 0 0 1px 0;
            text-align-last: center;
            outline: 0;
        }

        .btn,
        .btn:active {
            font-size: 18px;
            font-weight: normal;
            background: #19aa8d !important;
            border-radius: 3px;
            border: none;
            min-width: 250px;
            color: white;
            min-height: 38px;
            padding: 0 10px 0 10px;
        }

        .btn:hover,
        .btn:focus {
            background: #179b81 !important;
        }

        .caixa_formulario a {
            color: #19aa8d;
            text-decoration: none;
            padding-left: 5px;
        }

        .caixa_formulario a:hover {
            text-decoration: underline;
        }

        @media (min-width: 480px) {
            .caixa_formulario {
                width: 480px;
            }
        }

        /* ######## */
        /*  TOOTIP  */
        /* ######## */

        /* TOOTIP - FIM */
    </style>
</head>

<body>
    <?php
    require_once("src/Comandos.php");
    //Configurando a data do Calendário
    //Somente Quintas ou Sábados.
    function quinta()
    {
        // coloque no input: min="<?php sabado(); step="7"
        echo date('Y-m-d', strtotime("next Thursday"));
    }
    function sabado()
    {
        // coloque no input: min="<?php sabado(); step="7"
        echo date('Y-m-d', strtotime("next Saturday"));
    }
    ?>
    <!-- Designações -->
    <section id="designacoes">
        <script>
            // Script que esconde ou mostra DIV de acordo 
            // com o que foi selecionado no SELECT
            $(document).ready(function() {
                $('#reuniao').on('change', function() {
                    var selectValor = '#' + $(this).val();
                    $('#opcoes').children('div').hide();
                    $('#opcoes').children(selectValor).show();

                    var tipo = $("#reuniao option:selected").text();
                    if (tipo == 'Fim de Semana') {
                        $('#dataSab').attr('disabled', false);
                        $('#dataQui').attr('disabled', true);
                        $('#presidenteSab').attr('disabled', false);
                        $('#presidenteQui').attr('disabled', true);
                    } else if (tipo == 'Meio de Semana') {
                        $('#dataSab').attr('disabled', true);
                        $('#dataQui').attr('disabled', false);
                        $('#presidenteSab').attr('disabled', true);
                        $('#presidenteQui').attr('disabled', false);
                    }
                });
            });
        </script>

        <div class="caixa_formulario">

            <form action="?act=Salvar_DESIGNACOES" method="POST" name="Designacoes">
                <h2>Designações</h2>
                <p class="titulo_menor">Partes das reuniões da congregação</p>

                <div class="grupo-item">
                    <span class="icone"><i class="fa fa-calendar-o"></i></span>
                    <select class="controle-itens" name="reuniao" id="reuniao" required>
                        <option value="" selected>Escolha uma Reunião</option>
                        <option value="0">Meio de Semana</option>
                        <option value="1">Fim de Semana</option>
                    </select>
                </div>
                <div id="opcoes">

                    <div id="1" hidden>
                        <!-- Fim de Semana -->
                        <h4 class="centro publica">Discurso e A Sentinela</h4>
                        <div class="grupo-item">
                            <span class="icone"><i class="fa fa-calendar-o"></i></span>
                            <input class="controle-itens" type="date" min="<?php sabado() ?>" step="7" name="data" id="dataSab" required>
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="presidente" id="presidenteSab" placeholder="Presidente" required>
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="orador" id="orador" placeholder="Nome do Orador">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fa fa-paste"></i></span>
                            <input class="controle-itens" type="text" name="t_discurso" id="t_discurso" placeholder="Tema do Discurso">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="leitor_revista" id="leitor_revista" placeholder="Leitor de A Sentinela">
                        </div>
                    </div>

                    <div id="0" hidden>
                        <!-- Meio de Semana -->
                        <h4 class="centro tesouro">Tesouros da Palavra de Deus</h4>
                        <div class="grupo-item">
                            <span class="icone"><i class="fa fa-calendar-o"></i></span>
                            <input class="controle-itens" type="date" min="<?php quinta() ?>" step="7" name="data" id="dataQui" required>
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="presidente" id="presidenteQui" placeholder="Presidente" required>
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="tesouros" id="tesouros" placeholder="Tesouros: Orador">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="joias" id="joias" placeholder="Encontre Jóias: Orador">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user"></i></span>
                            <input class="controle-itens" type="text" name="l_biblia" id="l_biblia" placeholder="Leitura da Bíblia">
                        </div>
                        <h4 class="centro faca">Faça Melhor no Ministério</h4>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-friends"></i></i></span>
                            <input class="controle-itens" type="text" name="faca_01" id="faca_01" placeholder="Faça 01: Participantes">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-friends"></i></span>
                            <input class="controle-itens" type="text" name="faca_02" id="faca_02" placeholder="Faça 02: Participantes">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-friends"></i></span>
                            <input class="controle-itens" type="text" name="faca_03" id="faca_03" placeholder="Faça 03: Participantes">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-friends"></i></span>
                            <input class="controle-itens" type="text" name="faca_04" id="faca_04" placeholder="Faça 4: Participantes">
                        </div>
                        <h4 class="centro vida">Nossa Vida Cristã</h4>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="vida_01" id="vida_01" placeholder="Vida: 1° Participante">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="vida_02" id="vida_02" placeholder="Vida: 2° Participante">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="vida_03" id="vida_03" placeholder="Vida: 3° Participante">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="dirigente_ebc" id="dirigente_ebc" placeholder="Estudo B. de Congregação">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="leitor_ebc" id="leitor_ebc" placeholder="Leitor do EBC">
                        </div>
                        <div class="grupo-item">
                            <span class="icone"><i class="fas fa-user-tie"></i></span>
                            <input class="controle-itens" type="text" name="oracao" id="oracao" placeholder="Oração Final">
                        </div>
                    </div>
                </div>

                <div class="grupo-item centro">
                    <input class="btn" type="submit" value="Gravar Programação">
                </div>
                <p class="titulo_menor">Ao deixar o campo em branco, ele não aparecerá na programação.</p>
            </form>
            <div class="titulo_menor centro"><a href="designacoes.php">Visualizar programação.</a>.</div>
        </div>
    </section>
</body>

</html>