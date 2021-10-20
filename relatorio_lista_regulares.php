<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Regulares</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        #myInput {
            background-image: url('/css/searchicon.png');
            background-position: 10px 12px;
            background-repeat: no-repeat;
            width: 100%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

        #myUL {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL li a {
            border: 1px solid #ddd;
            margin-top: -1px;
            /* Prevent double borders */
            background-color: #f6f6f6;
            padding: 12px;
            text-decoration: none;
            font-size: 18px;
            color: black;
            display: block
        }

        #myUL li a:hover:not(.header) {
            background-color: #eee;
        }

        .center {
            text-align: center;
        }

        .btn {
            margin: 4%;
        }
    </style>
</head>

<body>

    <!-- Pesquisa -->
    <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por nomes.." title="Digite um nome">
    <!-- Lista -->
    <ul id='myUL'>
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
                $stmt = $conn->prepare("SELECT * FROM RELATORIO_CAMPO 
                                        WHERE Mes = $mesAnterior 
                                        AND Pioneiro = 2
                                        AND Ano = $anoAtual 
                                        GROUP BY id ASC");
            } else {
                $stmt = $conn->prepare("SELECT * FROM RELATORIOS_CAMPO 
                                        WHERE mes = 12 
                                        AND Pioneiro = 2
                                        AND Ano = $anoAnterior 
                                        GROUP BY id ASC");
            }
            if ($stmt->execute()) {
                while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                    $id = $rs->ID;
                    $nome = $rs->Nome;
                    $publicacoes = $rs->Publicacoes;
                    $videos = $rs->Videos;
                    $horas = $rs->Horas;
                    $revisitas = $rs->Revisitas;
                    $estudos = $rs->Estudos;
                    $obs = $rs->Obs;

                    echo "
                    <li>
                        <a href='#' class='lista' data-toggle='modal' data-target='#modal" . $id . "'>$nome</a>
                    </li>
                    <div class='modal' id='modal" . $id . "'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>

                            <div class='modal-body'>
                                <table class='table table-bordered table-sm'>
                                    <tbody>
                                        <tr>
                                            <td class='center'>
                                                <h5>$nome</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class='table table-bordered table-sm'>
                                    <tbody>
                                        <tr>
                                            <th class='center'>
                                                Publicações
                                            </th>
                                            <td class='center'>
                                                $publicacoes
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class='center'>
                                                Vídeos
                                            </th>
                                            <td class='center'>
                                                $videos
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class='center'>
                                                Horas
                                            </th>
                                            <td class='center'>
                                                $horas
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class='center'>
                                                Revisitas
                                            </th>
                                            <td class='center'>
                                                $revisitas
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class='center'>
                                                Estudos
                                            </th>
                                            <td class='center'>
                                                $estudos
                                            </td>
                                        </tr>

                                </table>
                                <table class='table table-bordered table-sm'>
                                    <tr>
                                        <th>Observações: </th>
                                    </tr>
                                    <td>
                                        $obs
                                    </td>
                                </table>
                            </div>
                            <button type='button' class='btn btn-info' data-dismiss='modal'>Fechar</button>
                        </div>
                    </div>
                    </div>
                    ";
                }
            } else {
                echo "Erro: Não foi possível recuperar os dados do banco de dados";
            }
        } catch (PDOException $erro) {
            echo "Erro: " . $erro->getMessage();
        }
        ?>
    </ul>
    <!-- Filtro com pesquisa -->
    <script>
        function myFunction() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>