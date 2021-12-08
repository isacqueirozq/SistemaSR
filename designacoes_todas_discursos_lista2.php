<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discursos Públicos</title>
    <style>
        * {
            box-sizing: border-box;
        }

        .caixa{
            width: 100%;
            height: auto;
            margin: auto;
            /* background-color: #f1f1f1; */
            box-sizing: border-box;
        }
        /* Tabela */
        table{width: 100%;background-color: whitesmoke;border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;}
        caption{padding: 15px;font-size: 16pt;}
        th{text-align: right;padding: 0px 15px 0 5px;}
        td{padding: 0px 15px 0 5px;} 
        tr:nth-child(even) {background-color: #D6EEEE;} 
        .data td{text-align: right;}
        .data span{font-weight: bold;}
        .tema td{padding:5px;} 

        article {
            float: left;
            padding: 20px;
            width: 50%;
            background-color: #f1f1f1;
        }
        @media (max-width: 600px) {
            nav, article {
                width: 100%;
                height: auto;
            }
        }

    </style>
</head>
<body>
    <!-- Array de teste -->
    <?php
    $tabela = array('Oradores','Roberto Lima','Trabalhe como escravo para o senhor da colheita.','Isac Queiroz','Samuel Carvalho','19/12/2021');
    ?>
    <div class="caixa">
        <section>
            <article>
                <table>
                    <tbody>
                        <tr class="data">
                            <th></th>
                            <td><span>Data: </span><?php echo $tabela[5];?></td>
                        </tr>
                        <tr class="presidente">
                            <th>Presidente:</th>
                            <td><?php echo $tabela[1];?></td>
                        </tr>
                        <tr class="tema">
                            <th>Tema:</th>
                            <td><?php echo $tabela[2];?> - <i><?php echo $tabela[3];?></i></td>
                        </tr>
                        <tr class="leitor">
                            <th>Leitor:</th>
                            <td><?php echo $tabela[4];?></td>
                        </tr>
                    </tbody>
                </table>
            </article>

            <article>
                <table>
                    <tbody>
                        <tr class="data">
                            <th></th>
                            <td><span>Data: </span><?php echo $tabela[5];?></td>
                        </tr>
                        <tr class="presidente">
                            <th>Presidente:</th>
                            <td><?php echo $tabela[1];?></td>
                        </tr>
                        <tr class="tema">
                            <th>Tema:</th>
                            <td><?php echo $tabela[2];?> - <i><?php echo $tabela[3];?></i></td>
                        </tr>
                        <tr class="leitor">
                            <th>Leitor:</th>
                            <td><?php echo $tabela[4];?></td>
                        </tr>
                    </tbody>
                </table>
            </article>
        </section>     
    </div>
</body>
</html>

