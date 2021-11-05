<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petições recebidas</title>

    <style>
        table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 90%;
        border: 1px solid #ddd;
        margin-left: auto; /*Centraliza*/
        margin-right: auto; /*Centraliza*/
        }

        th, td {
        text-align: left;
        padding: 16px;
        }

        tr:nth-child(even) {
        background-color: #f2f2f2;
        }
        caption {
            margin-top: 20px;
            font-size: 1.4em;
            background-color: lavender;
        }
        @media screen and (min-width:600px){
            table {
                width: 600px;
            }
        }
    </style>
</head>
<body>
<div class="centro">
<table>
    <caption>Auxiliares mês passado</caption>
  <tr>
    <th style="width:70%">Nome</th>
    <th>Requisito</th>
    <th>Mês/Ano</th>
  </tr>
    <?php
            require_once("src/Carrega_dados.php");
            // Data correta ----------------------------------------------------
            setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
            date_default_timezone_set('America/Sao_Paulo');
            $anoAtual = date("Y");
            $anoAnterior = date("Y") - 1;
            $mesAnterior = date("m") - 1;
            // ---------------------------------------------------------------
            try {
                if ($mesAnterior > 0) {
                    $stmt = $conn->prepare("SELECT * FROM PETICAO_AUXILIAR 
                                            WHERE Mes = $mesAnterior
                                            AND Ano = $anoAtual 
                                            GROUP BY id ASC");
                } else {
                    $stmt = $conn->prepare("SELECT * FROM PETICAO_AUXILIAR 
                                            WHERE mes = 12 
                                            AND Ano = $anoAnterior 
                                            GROUP BY id ASC");
                }
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $id = $rs->ID;
                        $nome = $rs->Nome;
                        $mes = $rs->Mes;
                        $requisito = $rs->Requisito;
                        $ano = $rs->Ano;
                        
                        echo "<tr>
                                <td>".$nome."</td>
                                <td>".$requisito." horas</td>
                                <td>".$mes."/".$ano."</td>
                            </tr>";
                    }
                } else {
                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                }
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }
            ?>
</table>

<table>
    <caption>Auxiliares deste mês</caption>
  <tr>
    <th style="width:70%">Nome</th>
    <th>Requisito</th>
    <th>Mês/Ano</th>
  </tr>
    <?php
            $mesAnterior = date("m");
            // ---------------------------------------------------------------
            try {
                if ($mesAnterior > 0) {
                    $stmt = $conn->prepare("SELECT * FROM PETICAO_AUXILIAR 
                                            WHERE Mes = $mesAnterior
                                            AND Ano = $anoAtual 
                                            GROUP BY id ASC");
                } else {
                    $stmt = $conn->prepare("SELECT * FROM PETICAO_AUXILIAR 
                                            WHERE mes = 12 
                                            AND Ano = $anoAnterior 
                                            GROUP BY id ASC");
                }
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $id = $rs->ID;
                        $nome = $rs->Nome;
                        $mes = $rs->Mes;
                        $requisito = $rs->Requisito;
                        $ano = $rs->Ano;
                        
                        echo "<tr>
                                <td>".$nome."</td>
                                <td>".$requisito." horas</td>
                                <td>".$mes."/".$ano."</td>
                            </tr>";
                    }
                } else {
                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                }
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }
            ?>
</table>
</div>
</body>
</html>