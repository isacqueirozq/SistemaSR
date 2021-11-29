<?php
require_once("src/Comandos.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/tabela.css">
    <title>Saídas de Campo</title>

    <style>
        h1{
           text-align: center;
           font-size: 16pt;
        }
        h2{
            text-align: center;
            font-size: 12pt;
        }
        @media screen and (max-width:350px) {
            .col_link,.col_hora{
                display: none;
            }
        }
    </style>
</head>

<body>
    <!-- SAIDAS DE CAMPO -->
    <section id="6">
        <h1>Saídas de Campo</h1>
        <div class="formulario">
            <form action="?act=Salvar_SAIDA_CAMPO" method="POST" name="Saida_Campo">
                <select name="dia_Semana" id="dia_Semana" required>
                    <option selected>Escolha o Dia</option>
                    <option value="1">Domingo</option>
                    <option value="2">Segunda</option>
                    <option value="3">Terça</option>
                    <option value="4">Quarta</option>
                    <option value="5">Quinta</option>
                    <option value="6">Sexta</option>
                    <option value="7">Sábado</option>
                </select>
                <select name="semana_do_mes" id="semana_do_mes" required>
                    <option value="0" selected>Em todas as semanas</option>
                    <option value="1">1° Semana do mês</option>
                    <option value="2">2°Semana do mês</option>
                    <option value="3">3° Semana do mês</option>
                    <option value="4">4° Semena do mês</option>
                    <option value="5">5° Semana do mês</option>
                </select>
                <!-- <input type="text" name="semana_do_mes" id="semana_do_mes" placeholder="Semana do mês"> -->
                <input type="text" name="dirigente" id="dirigente" placeholder="Nome do Dirigente" required>
                <input type="text" name="link" id="link" placeholder="Link" required>
                <label for="hora">Hora</label>
                <input type="time" name="hora" id="hora" required>
                <input type="submit" value="Gravar e Fixar no Quadro">
            </form>
        </div>
        
        <br>
        <style>
            th{
                text-align: left;
                padding: 2px 15px 0 15px;
            }
            td{
                padding: 2px 15px 0 15px;
            }
        </style>
        <table id="table">
             <caption><h2>Programação de Saídas de campo</h2></caption>
            <tr>
                <th>Dirigente</th>
                <th>Dia</th>
                <th>Semana</th>
                <th class='col_hora'>hora</th>
                <th class='col_link'>Link</th>
            </tr>
            <?php
                require_once("src/Carrega_dados.php");
                $dia_da_semana;
                $semana_do_mes;
                try {
                    $stmt = $conn->prepare("SELECT * FROM SAIDA_CAMPO  ORDER BY Dia_semana,Semana_do_mes ASC");
                    
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $id = $rs->ID;
                            $diasemana = $rs->Dia_Semana;
                                if ($diasemana == 1) {
                                    $diasemana = "Domingo";
                                }elseif ($diasemana == 2) {
                                    $diasemana = "Segunda";
                                }elseif ($diasemana == 3) {
                                    $diasemana = "Terça";
                                }elseif ($diasemana == 4) {
                                    $diasemana = "Quarta";
                                }elseif ($diasemana == 5) {
                                    $diasemana = "Quinta";
                                }elseif ($diasemana == 6) {
                                    $diasemana = "Sexta";
                                }elseif ($diasemana == 7) {
                                    $diasemana = "Sábado";
                                }
                            $semanames = $rs->Semana_do_mes;
                                if ($semanames == 0) {
                                    $semanames = "Todas";
                                }elseif ($semanames == 1) {
                                    $semanames = "1° Semana";
                                }elseif ($semanames == 2) {
                                    $semanames = "2° Semana";
                                }elseif ($semanames == 3) {
                                    $semanames = "3° Semana";
                                }elseif ($semanames == 4) {
                                    $semanames = "4° Semana";
                                }elseif ($semanames == 5) {
                                    $semanames = "5° Semana";
                                }
                            $dirigente = $rs->Dirigente;
                            $link = $rs->Link;
                            $hora = $rs->Hora;
                            
                            echo "<tr>
                                    <td>".$dirigente."</td>
                                    <td>".$diasemana."</td>
                                    <td>".$semanames."</td>
                                    <td class='col_hora'>".$hora."</td>
                                    <td class='col_link'>".$link."</td>
                                  </tr>";
                            // echo $s1 = "['".$dirigente."','".$diasemana."','".$hora."','".$link."','".$id."']";
                        }
                    } else {
                        echo "Erro: Não foi possível recuperar os dados do banco de dados";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: " . $erro->getMessage();
                }
            ?>
        </table>
    </section>
</body>

</html>