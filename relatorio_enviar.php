<?php
require_once("src/Comandos.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Meu Relatório</title>
    <link rel="shortcut icon" href="Terno.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <!-- Para o script de ANO funvionar -->
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f1f1f1;
        }

        #regForm {
            background-color: #ffffff;
            margin: 100px auto;
            font-family: Raleway;
            padding: 40px;
            width: 70%;
            min-width: 300px;
        }

        @media (max-width: 400px) {
            #regForm {
                margin: 2%;
                padding: 15px;
                width: 100%;
            }
        }

        h1,
        h2 {
            text-align: center;
        }

        input {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa;
        }

        select {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa;
        }

        /* Mark input boxes that gets an error on validation: */
        input.invalid {
            background-color: #ffdddd;
        }

        button {
            background-color: #04AA6D;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }

        #prevBtn {
            background-color: #bbbbbb;
        }

        /*--- TABELA DO RELATORIO ---*/
        table {
            width: 100%;
            margin: 10px 0 10px 0;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table td {
            width: 80%;
        }

        @media (max-width:400px) {
            table td {
                width: 70%;
            }
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }


        /* --------------------------- */

        .grupo-item {
            margin-bottom: 10px;
            font-weight: 400;
            line-height: 1.5;
        }

        .icone {
            max-width: 42px;
            text-align: center;
            background: none;
            /* border-bottom: 1px solid #e1e1e1; */
            padding-left: 5px;
        }

        textarea {
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            min-height: 20px;
            text-align: left;
        }



        /*MODAL*/
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 80%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0
            }

            to {
                top: 0;
                opacity: 1
            }
        }

        /* The Close Button */
        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            background-color: #5cb85c;
            color: white;
        }

        .modal-body {
            padding: 20px 16px;
        }

        .radio {
            width: auto;
            margin-bottom: 20px;
        }

        /* FIM MODAL */
    </style>

</head>

<body>
    <form id="regForm" action="?act=Salvar_RELATORIO_CAMPO" method="POST" name="Relatorio_Campo">
        <h2>Relatório de Serviço de Campo</h2>
        <table>
            <thead>
                <!-- Nome -->
                <div class="grupo-item">
                    <!-- <span class="icone"><i class="fa fa-calendar-o"></i></span> -->
                    <input type="text" name="nome" id="nome" placeholder="Nome Completo" required>
                </div>
                <!-- Mês -->
                <div class="grupo-item">
                    <!-- <span class="icone"><i class="fa fa-calendar-o"></i></span> -->
                    <select name="mes" id="mesdoano" required>
                        <option selected value="0">Escolha o mês</option>
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
                <!-- Ano -->
                <div class="grupo-item">
                    <!-- Script que corrige o ano do relatorio no ano novo -->
                    <script type="text/javascript">
                        var hoje = new Date();
                        var ano = hoje.getFullYear();
                        var anoNovo = ano - 1;
                        var mesAtual = hoje.getMonth() + 1;
                        
                        $(document).ready(function() {
                            $("#mesdoano").change(function() {
                                var mes = $("#anorel").val($("#mesdoano").val());
                                if (mes.val() == 12 & mesAtual == 1) {
                                    $("#anorel").val(anoNovo);
                                } else if (mes.val() == 12 & mesAtual == 12) {
                                    $("#anorel").val(ano);
                                } else {
                                    $("#anorel").val(ano);
                                }
                            });
                        });
                    </script>
                    <input type="text" name="ano" id="anorel" placeholder="Ano" hidden>
                </div>
            </thead>

            <tbody>
                <!-- Publicações -->
                <div class="grupo-item">
                    <tr>
                        <td>Publicações</td>
                        <td>
                            <input type="number" name="publicacoes" id="publicacoes">
                        </td>
                    </tr>
                </div>
                <!-- Videos -->
                <div class="grupo-item">
                    <tr>
                        <td>Vídeos Mostrados</td>
                        <td>
                            <input type="number" name="videos" id="videos">
                        </td>
                    </tr>
                </div>
                <!-- Horas -->
                <div class="grupo-item">
                    <tr>
                        <td>Horas</td>
                        <td>
                            <input type="number" name="horas" id="hora">
                        </td>
                    </tr>
                </div>
                <!-- Revisitas -->
                <div class="grupo-item">
                    <tr>
                        <td>Revisitas</td>
                        <td>
                            <input type="number" name="revisitas" id="revisitas">
                        </td>
                    </tr>
                </div>
                <!-- Estudos -->
                <div class="grupo-item">
                    <tr>
                        <td>Estudos</td>
                        <td>
                            <input type="number" name="estudos" id="estudos">
                        </td>
                    </tr>
                </div>
            </tbody>
        </table>

        <table>
            <!-- Observações -->
            <div class="grupo-itens">
                <tr>
                    Observações:
                    <textarea name="obs" id="obs" cols="30" rows="1" placeholder="Escreva aqui."></textarea>
                </tr>
            </div>
        </table>
        <!-- BOTÃO -->
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="myBtn" onclick="return validar()">Enviar meu relatório</button>
                <!-- <input type="button" id="myBtn" onclick="return validar()" value="Enviar input"> -->
                <script>
                    function validar() {
                        var nome = document.forms["regForm"]["nome"].value;
                        var mes = document.forms["regForm"]["mes"].value;
                        if (nome == "") {
                            alert("Coloque seu nome");
                            return false;
                        } else if (mes == 0) {
                            alert("Escolha o mês");
                            return false;
                        } else {
                            // Get the modal
                            var modal = document.getElementById("myModal");

                            // Get the button that opens the modal
                            var btn = document.getElementById("myBtn");

                            // Get the <span> element that closes the modal
                            var span = document.getElementsByClassName("close")[0];

                            // When the user clicks the button, open the modal 
                            btn.onclick = function() {
                                modal.style.display = "block";
                            }

                            // When the user clicks on <span> (x), close the modal
                            span.onclick = function() {
                                modal.style.display = "none";
                            }

                            // When the user clicks anywhere outside of the modal, close it
                            window.onclick = function(event) {
                                if (event.target == modal) {
                                    modal.style.display = "none";
                                }
                            }
                        }
                    }
                </script>
            </div>
        </div>
        <!-- MODAL -->
        <div id="myModal" class="modal">

            <!-- CONTEÚDO DO MODAL -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Você trabalhou este mês como:</h2>
                </div>
                <div class="modal-body">
                    <div class="grupo-itens">
                        <input class="radio" type="radio" name="pioneiro" id="pioneiro0" value="0" checked>Publicador
                    </div>
                    <div class="grupo-itens">
                        <input class="radio" type="radio" name="pioneiro" id="pioneiro1" value="1">Pioneiro Auxiliar
                    </div>
                    <div class="grupo-itens">
                        <input class="radio" type="radio" name="pioneiro" id="pioneiro2" value="2">Pioneiro Regular
                    </div>
                    <div class="grupo-itens">
                        <input class="radio" type="radio" name="pioneiro" id="pioneiro3" value="3">Pioneiro Especial
                    </div>

                    <div style="overflow:auto;">
                        <div style="float:right;">
                            <input type="submit" value="Finalizar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>