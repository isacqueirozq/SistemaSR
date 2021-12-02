<?php
require_once("src/Comandos.php");
require_once("src/ConexaoBD.php");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/tabela.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <title>Eventos</title>

    <style>
        h1{
            text-align: center;
            font-size: 16pt;
        }
        #Data_do_evento{
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .delete{
            color: #E34724;
        }
        a[type=btn]{
            background-color: tomato;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: block;
            text-align: center;
            font-size: 0.8em;
            text-decoration: none;
        }

        a[type=btn]:hover{
            background-color: #FF7359;
        }
    </style>
</head>
<body>
    <section>
        <!-- EVENTOS -->
        <h1>Eventos da Congregação</h1>
        <div class="formulario">
            <form action="?act=Salvar_EVENTOS" method="POST" name="EVENTOS">
                <input type="text" name="Nome_do_evento" id="Nome_do_evento" placeholder="Nome do Evento" required>
                <input type="date" name="Data_do_evento" id="Data_do_evento">
                <input type="text" name="Local_do_evento" id="Local_do_evento" placeholder="Local do evento">
                <input type="submit" value="Salvar">
                <a type="btn" href="gerenciamento.html">Voltar</a>
            </form>
        </div>
    </section>

    <section>
        <!-- Lista -->
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
             <caption><h2>Eventos</h2></caption>
            <tr>
                <th>Descrição</th>
                <th>Data</th>
                <th>Local</th>
                <!-- <th>Ação</th> -->
            </tr>
            <?php
                try {
                    $stmt = $conn->prepare("SELECT * FROM EVENTOS WHERE Data_do_evento > CURRENT_DATE() ORDER BY Data_do_evento ASC");
                    
                    if ($stmt->execute()) {
                        while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                            $id = $rs->ID;
                            $nome = $rs->Nome_do_evento;
                            $bddata = $rs->Data_do_evento;
                            setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                            $data = strftime("%d de %B de %Y", strtotime($bddata));
                            $local = $rs->Local_do_evento;
                            
                            echo "<tr>
                                    <td>".$nome."</td>
                                    <td>".$data."</td>
                                    <td>".$local."</td>
                                  </tr>";
                                //   <td><a class='delete' title='Apagar' href=\"?act=Deletar_EVENTOS&id=".$id."\"><i class='material-icons'>&#xE872;</i></a></td>
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