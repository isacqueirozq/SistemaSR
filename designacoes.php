<?php
require_once("src/ConexaoBD.php");
// $tipo = 2;
// if ($tipo == 1) {
//     echo "REVISITA";
// } else {
//     echo "ESTUDO";
// }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tabela_designacoes.css">

    <link rel="shortcut icon" href="Terno.ico" type="image/x-icon">
    <title>Designações</title>

    <style>
        .conteiner{
            width: 100%;
        }
        
        @media screen and (min-width:500px){
            .conteiner{
            width: 80%;
            margin: auto;
            }
        }

        .footer{
            text-align: center;
            
            background-color:#53524f ;
            padding: 15px;
            
        }
        a{
            text-decoration: none;
            font-weight: bold;
            color: rgb(243, 233, 215);
            
        }
    </style>
</head>

<body>
    <div class="conteiner">
        <div class="conteudo">
            <header id="Data">
                <?php
                setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                echo ucfirst(utf8_encode(strftime("%d - " . strftime("%d de %B de %Y", strtotime("next Sunday")) . "", strtotime("last Monday"))));
                ?>
            </header>
            <?php
                // #####################
                // # Vida e Ministério #
                // #####################
                try {
                    $existe = $conn->query("SELECT * FROM DESIGNACOES WHERE Data >= CURRENT_DATE() AND Reuniao = 0 LIMIT 1")->rowCount();
                    if ($existe > 0) {
                        //Se tiver uma programação, carregue os dados.
                        $stmt = $conn->prepare("SELECT * FROM DESIGNACOES WHERE Data >= CURRENT_DATE() AND Reuniao = 0 LIMIT 1");
                        if ($stmt->execute()) {
                            while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                                $reuniao = $rs->Reuniao;
                                $data = $rs->Data;
                                $presidente = $rs->Presidente;
                                $orador = $rs->Orador;
                                $tema = $rs->Tema;
                                $leitor = $rs->Leitor;
                                $tesouro = $rs->Tesouros;
                                $joias = $rs->Joias;
                                $l_biblia = $rs->L_Biblia;
                                $faca1 = $rs->Faca_01;
                                $faca2 = $rs->Faca_02;
                                $faca3 = $rs->Faca_03;
                                $faca4 = $rs->Faca_04;
                                $vida1 = $rs->Vida_01;
                                $vida2 = $rs->Vida_02;
                                $vida3 = $rs->Vida_03;
                                $dirigente = $rs->Dirigente_EBC;
                                $leitor_ebc = $rs->Leitor_EBC;
                            }
                        } else {
                            echo "Erro: Não foi possível recuperar os dados do banco de dados";
                        }
                    } else {
                        //Se não tiver, coloque tudo em branco.
                        $presidente = "";
                        $orador = "";
                        $tema = "";
                        $leitor = "";
                        $tesouro = "";
                        $joias = "";
                        $l_biblia = "";
                        $faca1 = "";
                        $faca2 = "";
                        $faca3 = "";
                        $faca4 = "";
                        $vida1 = "";
                        $vida2 = "";
                        $vida3 = "";
                        $dirigente = "";
                        $leitor_ebc = "";
                    }
                } catch (PDOException $erro) {
                    echo "Erro: " . $erro->getMessage();
                }
            ?>
            <section id="Tesouros">
                <table class="tabela-cabecalho">
                    <tbody>
                        <tr>
                            <td class="cabecalho tesouro">Tesouros da Palavra de Deus</td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item">
                    <tbody>
                        <tr>
                            <td class="itens">Presidente</td>
                            <td class="dado"><?php echo $presidente ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item">
                    <tbody>
                        <tr>
                            <td class="itens">Tesouros</td>
                            <td class="dado"><?php echo $tesouro ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item">
                    <tbody>
                        <tr>
                            <td class="itens">Jóias</td>
                            <td class="dado"><?php echo $joias ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item">
                    <tbody>
                        <tr>
                            <td class="itens">Leitura da Bíblia</td>
                            <td class="dado"><?php echo $l_biblia ?></td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section id="Faca-seu-melhor">
                <table class="tabela-cabecalho">
                    <tbody>
                        <tr>
                            <td class="cabecalho faca">Faça seu Melhor no Ministério</td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item" id="faca1">
                    <tbody>
                        <tr>
                            <td class="itens">Primeira Visita</td>
                            <td class="dado"><?php echo $faca1 ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item" id="faca2">
                    <tbody>
                        <tr>
                            <td class="itens">Revisita</td>
                            <td class="dado"><?php echo $faca2 ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item" id="faca3">
                    <tbody>
                        <tr>
                            <td class="itens">Parte 3</td>
                            <td class="dado"><?php echo $faca3 ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item" id="faca4">
                    <tbody>
                        <tr>
                            <td class="itens">Estudo</td>
                            <td class="dado"><?php echo $faca4 ?></td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section id="Vida">
                <table class="tabela-cabecalho">
                    <tbody>
                        <tr>
                            <td class="cabecalho vida">Nossa Vida Cristã</td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item">
                    <tbody>
                        <tr>
                            <td class="itens">Vida 1</td>
                            <td class="dado"><?php echo $vida1 ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item">
                    <tbody>
                        <tr>
                            <td class="itens">Vida 2</td>
                            <td class="dado"><?php echo $vida2 ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item" hidden>
                    <tbody>
                        <tr>
                            <td class="itens">Vida 3</td>
                            <td class="dado"><?php echo $vida3 ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item">
                    <tbody>
                        <tr>
                            <td class="itens">Estudo Bíblico de Congregação</td>
                            <td class="dado"><?php echo $dirigente ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item">
                    <tbody>
                        <tr>
                            <td class="itens">Leitor</td>
                            <td class="dado"><?php echo $leitor_ebc ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-item">
                    <tbody>
                        <tr>
                            <td class="itens">Oração</td>
                            <td class="dado"><?php echo $leitor_ebc ?></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>

        <div class="conteudo">
            <?php
            // ###############
            // #  Discursos  #
            // ###############
            $presidente = "";
            try {
                $stmt = $conn->prepare("SELECT * FROM DESIGNACOES WHERE Data >= CURRENT_DATE() AND Reuniao = 1 LIMIT 1");
                if ($stmt->execute()) {
                    while ($rs = $stmt->fetch(PDO::FETCH_OBJ)) {
                        $reuniao = $rs->Reuniao;
                        $data = $rs->Data;
                        $presidente = $rs->Presidente;
                        $orador = $rs->Orador;
                        $tema = $rs->Tema;
                        $leitor = $rs->Leitor;
                        $tesouro = $rs->Tesouros;
                        $joias = $rs->Joias;
                        $l_biblia = $rs->L_Biblia;
                        $faca1 = $rs->Faca_01;
                        $faca2 = $rs->Faca_02;
                        $faca3 = $rs->Faca_03;
                        $faca4 = $rs->Faca_04;
                        $vida1 = $rs->Vida_01;
                        $vida2 = $rs->Vida_02;
                        $vida3 = $rs->Vida_03;
                        $dirigente = $rs->Dirigente_EBC;
                        $leitor_ebc = $rs->Leitor_EBC;
                    }
                } else {
                    echo "Erro: Não foi possível recuperar os dados do banco de dados";
                }
            } catch (PDOException $erro) {
                echo "Erro: " . $erro->getMessage();
            }
            // DESIGNÇÕES - FIM
            ?>
            <section id="Publica">
                <table class="tabela-cabecalho">
                    <tbody>
                        <tr>
                            <td class="cabecalho publica">Reunião do Fim de Semana</td>
                        </tr>
                    </tbody>
                </table>
                <table class="tabela-cabecalho">
                    <tbody>
                        <tr>
                            <td class="publica-frame">
                                <strong>Presidente: </strong><?php echo $presidente ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="caixatema">
                                <strong>Discurso: </strong><span class="tema">"<span><?php echo $tema ?></span>"</span> - <span><i><?php echo $orador ?></i></span>
                            </td>
                        </tr>
                        <tr>
                            <td class="publica-frame"><strong>Leitor de A Sentinela : </strong><span><?php echo $leitor ?></span></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>

        <div class="footer">
            <a href="designacoes_todas.php">Ver próximas semanas</a>
        </div>
    </div>
</body>

</html>