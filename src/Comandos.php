<?php
require_once("ConexaoBD.php");
//----------------------
// Tabela: ASSISTENCIA
//----------------------
$tabela = "ASSISTENCIA";
$id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
$data = (isset($_POST["data"]) && $_POST["data"] != null) ? $_POST["data"] : "";
$quantidade = (isset($_POST["qtd"]) && $_POST["qtd"] != null) ? $_POST["qtd"] : "";
// ------- Salvar -------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Salvar_$tabela" && $data != "") {
    try {
        if ($id != "") {
            $stmt = $conn->prepare("UPDATE $tabela SET Data = ?, Quantidade = ? WHERE id = ?");
            $stmt->bindParam(3, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO $tabela (Data,Quantidade) VALUES (?,?)");
        }
        $stmt->bindParam(1, $data);
        $stmt->bindParam(2, $quantidade);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Gravado com sucesso!";
                $data = null;
                $quantidade = null;
?>
                <script type="text/javascript">
                    window.open('index.php', '_self');
                </script>
            <?php
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Atualizar ------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Atualizar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            $id = $rs->id;
            $data = $rs->Data;
            $quantidade = $rs->Quantidade;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Delete ---------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Deletar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}




//###############################################################################




//----------------------
// Tabela: DESIGNACOES
//----------------------
$tabela = "DESIGNACOES";
//ID,Reuniao,Data,Presidente,Orador, Tema, Leitor, Tesouros,Joias,L_Biblia,Faca_01,Faca_02, Faca_03,Faca_04,Vida_01,Vida_02,Vida_03,Dirigente_EBC,Leitor_EBC,Oracao
$id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
$reuniao = (isset($_POST["reuniao"]) && $_POST["reuniao"] != null) ? $_POST["reuniao"] : "";
$data = (isset($_POST["data"]) && $_POST["data"] != null) ? $_POST["data"] : "";
$presidente = (isset($_POST["presidente"]) && $_POST["presidente"] != null) ? $_POST["presidente"] : "";
$orador = (isset($_POST["orador"]) && $_POST["orador"] != null) ? $_POST["orador"] : "";
$t_discurso = (isset($_POST["t_discurso"]) && $_POST["t_discurso"] != null) ? $_POST["t_discurso"] : "";
$leitor_revista = (isset($_POST["leitor_revista"]) && $_POST["leitor_revista"] != null) ? $_POST["leitor_revista"] : "";
$tesouros = (isset($_POST["tesouros"]) && $_POST["tesouros"] != null) ? $_POST["tesouros"] : "";
$joias = (isset($_POST["joias"]) && $_POST["joias"] != null) ? $_POST["joias"] : "";
$l_biblia = (isset($_POST["l_biblia"]) && $_POST["l_biblia"] != null) ? $_POST["l_biblia"] : "";
$faca_01 = (isset($_POST["faca_01"]) && $_POST["faca_01"] != null) ? $_POST["faca_01"] : "";
$faca_02 = (isset($_POST["faca_02"]) && $_POST["faca_02"] != null) ? $_POST["faca_02"] : "";
$faca_03 = (isset($_POST["faca_03"]) && $_POST["faca_03"] != null) ? $_POST["faca_03"] : "";
$faca_04 = (isset($_POST["faca_04"]) && $_POST["faca_04"] != null) ? $_POST["faca_04"] : "";
$vida_01 = (isset($_POST["vida_01"]) && $_POST["vida_01"] != null) ? $_POST["vida_01"] : "";
$vida_02 = (isset($_POST["vida_02"]) && $_POST["vida_02"] != null) ? $_POST["vida_02"] : "";
$vida_03 = (isset($_POST["vida_03"]) && $_POST["vida_03"] != null) ? $_POST["vida_03"] : "";
$dirigente_ebc = (isset($_POST["dirigente_ebc"]) && $_POST["dirigente_ebc"] != null) ? $_POST["dirigente_ebc"] : "";
$leitor_ebc = (isset($_POST["leitor_ebc"]) && $_POST["leitor_ebc"] != null) ? $_POST["leitor_ebc"] : "";
$oracao = (isset($_POST["oracao"]) && $_POST["oracao"] != null) ? $_POST["oracao"] : "";

// ------- Salvar -------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Salvar_$tabela" && $reuniao != "") {
    try {
        if ($id != "") {
            $stmt = $conn->prepare("UPDATE $tabela SET Reuniao = ?,Data = ?,Presidente = ?,Orador = ?, Tema = ?, Leitor = ?, Tesouros = ?,Joias = ?,L_Biblia = ?,Faca_01 = ?,Faca_02 = ?, Faca_03 = ?,Faca_04 = ?,Vida_01 = ?,Vida_02 = ?,Vida_03 = ?,Dirigente_EBC = ?,Leitor_EBC = ?,Oracao = ? WHERE id = ?");
            $stmt->bindParam(20, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO $tabela (Reuniao,Data,Presidente,Orador, Tema, Leitor, Tesouros,Joias,L_Biblia,Faca_01,Faca_02, Faca_03,Faca_04,Vida_01,Vida_02,Vida_03,Dirigente_EBC,Leitor_EBC,Oracao) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        }
        $stmt->bindParam(1, $reuniao);
        $stmt->bindParam(2, $data);
        $stmt->bindParam(3, $presidente);
        $stmt->bindParam(4, $orador);
        $stmt->bindParam(5, $t_discurso);
        $stmt->bindParam(6, $leitor_revista);
        $stmt->bindParam(7, $tesouros);
        $stmt->bindParam(8, $joias);
        $stmt->bindParam(9, $l_biblia);
        $stmt->bindParam(10, $faca_01);
        $stmt->bindParam(11, $faca_02);
        $stmt->bindParam(12, $faca_03);
        $stmt->bindParam(13, $faca_04);
        $stmt->bindParam(14, $vida_01);
        $stmt->bindParam(15, $vida_02);
        $stmt->bindParam(16, $vida_03);
        $stmt->bindParam(17, $dirigente_ebc);
        $stmt->bindParam(18, $leitor_ebc);
        $stmt->bindParam(19, $oracao);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Gravado com sucesso!";
                $reuniao = null;
                $data = null;
            ?>


                <script type="text/javascript">
                    var passaValor = function(valor) {
                        window.location = "Sucesso.html?minhaVariavel=" + valor;
                    }
                    var pagina = 'designacoes_editar.php';
                    passaValor(pagina);
                    // window.open('designacoes_editar.php', '_self');
                </script>



            <?php
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Atualizar ------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Atualizar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            // $id = $rs->id;
            // $data = $rs->Data;
            // $quantidade = $rs->Quantidade;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Delete ---------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Deletar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}




//###############################################################################




//----------------------
// Tabela: NOTICIAS
//----------------------
$tabela = "NOTICIAS";
$id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
$titulo = (isset($_POST["titulo"]) && $_POST["titulo"] != null) ? $_POST["titulo"] : "";
$subtitulo = (isset($_POST["subtitulo"]) && $_POST["subtitulo"] != null) ? $_POST["subtitulo"] : "";
$postagem = (isset($_POST["postagem"]) && $_POST["postagem"] != null) ? $_POST["postagem"] : "";
$retirada = (isset($_POST["retirada"]) && $_POST["retirada"] != null) ? $_POST["retirada"] : "";
$texto = (isset($_POST["texto"]) && $_POST["texto"] != null) ? $_POST["texto"] : "";
// ------- Salvar -------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Salvar_$tabela" && $titulo != "") {
    try {
        if ($id != "") {
            $stmt = $conn->prepare("UPDATE $tabela SET Titulo = ?, Subtitulo = ?, Texto = ?, Data_Postagem = ?, Data_Retirada = ? WHERE id = ?");
            $stmt->bindParam(6, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO $tabela (Titulo, Subtitulo, Texto,Data_Postagem, Data_Retirada) VALUES (?,?,?,?,?)");
        }
        $stmt->bindParam(1, $titulo);
        $stmt->bindParam(2, $subtitulo);
        $stmt->bindParam(3, $texto);
        $stmt->bindParam(4, $postagem);
        $stmt->bindParam(5, $retirada);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Gravado com sucesso!";
                $titulo = null;
                $subtitulo = null;
                $texto = null;
                $postagem = null;
                $retirada = null;
            ?>
                <script type="text/javascript">
                    window.open('index.php', '_self');
                </script>
            <?php
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Atualizar ------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Atualizar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            // $id = $rs->id;
            // $data = $rs->Data;
            // $quantidade = $rs->Quantidade;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Delete ---------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Deletar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}




//###############################################################################




//----------------------
// Tabela: EVENTOS
//----------------------
$tabela = "EVENTOS";
$id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
$nome = (isset($_POST["Nome_do_evento"]) && $_POST["Nome_do_evento"] != null) ? $_POST["Nome_do_evento"] : "";
$data = (isset($_POST["Data_do_evento"]) && $_POST["Data_do_evento"] != null) ? $_POST["Data_do_evento"] : "";
$local = (isset($_POST["Local_do_evento"]) && $_POST["Local_do_evento"] != null) ? $_POST["Local_do_evento"] : "";

// ------- Salvar -------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Salvar_$tabela" && $nome != "") {
    try {
        if ($id != "") {
            $stmt = $conn->prepare("UPDATE $tabela SET Nome_do_evento = ?, Data_do_evento = ?, Local_do_evento = ? WHERE id = ?");
            $stmt->bindParam(4, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO $tabela (Nome_do_evento, Data_do_evento, Local_do_evento) VALUES (?,?,?)");
        }
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $data);
        $stmt->bindParam(3, $local);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Gravado com sucesso!";
                $nome = null;
                $data = null;
                $local = null;
            ?>
                <script type="text/javascript">
                    window.open('evento_editar.php', '_self');
                </script>
            <?php
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Atualizar ------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Atualizar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            // $id = $rs->id;
            // $data = $rs->Data;
            // $quantidade = $rs->Quantidade;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Delete ---------

if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Deletar_$tabela" && $id != "") {
    echo $id;
    try {
        $stmt = $conexao->prepare("DELETE FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}




//###############################################################################




//----------------------
// Tabela: PIONEIRO AUXILIAR
//----------------------
$tabela = "PETICAO_AUXILIAR";
//ID, Nome, Mes, Requisito, Ano
$id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
$nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
$mes = (isset($_POST["mes"]) && $_POST["mes"] != null) ? $_POST["mes"] : "";
$requisito = (isset($_POST["requisito"]) && $_POST["requisito"] != null) ? $_POST["requisito"] : "";
$ano = (isset($_POST["ano"]) && $_POST["ano"] != null) ? $_POST["ano"] : "";
// ------- Salvar -------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Salvar_$tabela" && $nome != "") {
    try {
        if ($id != "") {
            $stmt = $conn->prepare("UPDATE $tabela SET Nome = ?, Mes = ?, Requisito = ?, Ano = ? WHERE id = ?");
            $stmt->bindParam(5, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO $tabela (Nome, Mes, Requisito,Ano) VALUES (?,?,?,?)");
        }
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $mes);
        $stmt->bindParam(3, $requisito);
        $stmt->bindParam(4, $ano);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $nome = null;
                $mes = null;
                $requisito = null;
                $ano = null;
            ?>
                <script type="text/javascript">
                    var passaValor = function(valor) {
                        window.location = "Sucesso.html?minhaVariavel=" + valor;
                    }
                    var pagina = 'index.php';
                    passaValor(pagina);
                    // window.open('designacoes_editar.php', '_self');
                </script>

            <?php
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Atualizar ------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Atualizar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            // $id = $rs->id;
            // $data = $rs->Data;
            // $quantidade = $rs->Quantidade;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Delete ---------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Deletar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}




//###############################################################################

// function verifica($Campo_Form){
//     $verifica = (isset($_POST["$Campo_Form"]) && $_POST["$Campo_Form"] != null) ? $_POST["$Campo_Form"] : "";
//     echo $verifica;
// };


//---------------------------------------
// Tabela: RELATÓRIO DE SERVIÇO DE CAMPO
//---------------------------------------
$tabela = "RELATORIO_CAMPO";
$id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
$nome = (isset($_POST["nome"]) && $_POST["nome"] != null) ? $_POST["nome"] : "";
$mes = (isset($_POST["mes"]) && $_POST["mes"] != null) ? $_POST["mes"] : "";
$ano = (isset($_POST["ano"]) && $_POST["ano"] != null) ? $_POST["ano"] : "";
$pioneiro = (isset($_POST["pioneiro"]) && $_POST["pioneiro"] != null) ? $_POST["pioneiro"] : "";
$publicacoes = (isset($_POST["publicacoes"]) && $_POST["publicacoes"] != null) ? $_POST["publicacoes"] : "0";
$videos = (isset($_POST["videos"]) && $_POST["videos"] != null) ? $_POST["videos"] : "0";
$horas = (isset($_POST["horas"]) && $_POST["horas"] != null) ? $_POST["horas"] : "0";
$revisitas = (isset($_POST["revisitas"]) && $_POST["revisitas"] != null) ? $_POST["revisitas"] : "0";
$estudos = (isset($_POST["estudos"]) && $_POST["estudos"] != null) ? $_POST["estudos"] : "0";
$obs = (isset($_POST["obs"]) && $_POST["obs"] != null) ? $_POST["obs"] : "";

// ------- Salvar -------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Salvar_$tabela" && $nome != "") {
    // if ($estudos > 0 && $revisitas = 0 || $revisitas = "") {
    //     echo "Encontramos um problema!/nSe você tem estudos/n o campo REVISITAS não pode ser 0.";
    // }else{
    try {
        if ($id != "") {
            $stmt = $conn->prepare("UPDATE $tabela SET Nome = ?, Mes = ?, Ano = ?, Pioneiro =?,Publicacoes = ?, Videos = ?, Horas = ?, Revisitas = ?, Estudos = ?, Obs = ?  WHERE id = ?");
            $stmt->bindParam(11, $id);
        } else {
            if ($conn->query("select count(*) from $tabela where Nome = '{$nome}' AND Mes = '{$mes}' AND Ano = '{$ano}'")->fetchColumn() <= 0){
                $stmt = $conn->prepare("INSERT INTO $tabela (Nome, Mes, Ano, Pioneiro, Publicacoes, Videos, Horas, Revisitas, Estudos, Obs) VALUES (?,?,?,?,?,?,?,?,?,?)");
            } else{
                ?><script type = "text/javascript" >
                    var passaValor = function(valor) {
                        window.location = "erro_duplicado.html?minhaVariavel=" + valor;
                    }
                    var pagina = 'relatorio_enviar.php';
                    passaValor(pagina);
                </script><?php
            }
        }
        $stmt->bindParam(1, $nome);
        $stmt->bindParam(2, $mes);
        $stmt->bindParam(3, $ano);
        $stmt->bindParam(4, $pioneiro);
        $stmt->bindParam(5, $publicacoes);
        $stmt->bindParam(6, $videos);
        $stmt->bindParam(7, $horas);
        $stmt->bindParam(8, $revisitas);
        $stmt->bindParam(9, $estudos);
        $stmt->bindParam(10, $obs);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                // $nome = null;
                // $mes = null;
                // $requisito = null;
                // $ano = null;
            ?>
                <script type="text/javascript">
                    var passaValor = function(valor) {
                        window.location = "Sucesso.html?minhaVariavel=" + valor;
                    }
                    var pagina = 'index.php';
                    passaValor(pagina);
                    // window.open('designacoes_editar.php', '_self');
                </script>
            <?php
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
        // }
    }
}
// ------ Atualizar ------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Atualizar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            // $id = $rs->id;
            // $data = $rs->Data;
            // $quantidade = $rs->Quantidade;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Delete ---------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Deletar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}




//###############################################################################





//---------------------------------------
// Tabela: Saída de Campo
//---------------------------------------
$tabela = "SAIDA_CAMPO";
$id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
$dia = (isset($_POST["dia_Semana"]) && $_POST["dia_Semana"] != null) ? $_POST["dia_Semana"] : "";
$semana_do_mes = (isset($_POST["semana_do_mes"]) && $_POST["semana_do_mes"] != null) ? $_POST["semana_do_mes"] : "";
$dirigente = (isset($_POST["dirigente"]) && $_POST["dirigente"] != null) ? $_POST["dirigente"] : "";
$link = (isset($_POST["link"]) && $_POST["link"] != null) ? $_POST["link"] : "";
$hora = (isset($_POST["hora"]) && $_POST["hora"] != null) ? $_POST["hora"] : "";

// ------- Salvar -------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Salvar_$tabela" && $dirigente != "") {
    //validar se existe
    try {
        /* Consultando a base e vendo se ja existe */
        $existe = $conn->query("SELECT * FROM $tabela WHERE Dia_Semana = $dia AND Semana_do_mes = $semana_do_mes")->rowCount() > 0;
       
        if ($existe > 0) {
            $stmt = $conn->prepare("UPDATE $tabela SET Dia_Semana = ?, Semana_do_mes = ?, Dirigente = ?, Link =?, Hora = ? WHERE Dia_Semana = ? AND Semana_do_mes = ?");
            $stmt->bindParam(6, $dia);
            $stmt->bindParam(7, $semana_do_mes);
        } else {
            $stmt = $conn->prepare("INSERT INTO $tabela (Dia_Semana, Semana_do_mes, Dirigente, Link, Hora) VALUES (?,?,?,?,?)");
        }
        $stmt->bindParam(1, $dia);
        $stmt->bindParam(2, $semana_do_mes);
        $stmt->bindParam(3, $dirigente);
        $stmt->bindParam(4, $link);
        $stmt->bindParam(5, $hora);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                
             ?>
                <!-- <script type="text/javascript">
                    window.open('saidas_campo.php', '_self');
                </script> -->
             <?php
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
        // }
    }
}
// ------ Atualizar ------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Atualizar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            // $id = $rs->id;
            // $data = $rs->Data;
            // $quantidade = $rs->Quantidade;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Delete ---------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Deletar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}




//###############################################################################





//---------------------------------------
// Tabela: USUARIOS
//---------------------------------------
$tabela = "USUARIOS";
$id = (isset($_POST["id"]) && $_POST["id"] != null) ? $_POST["id"] : "";
$user = (isset($_POST["user"]) && $_POST["user"] != null) ? $_POST["user"] : "";
$senha = (isset($_POST["senha"]) && $_POST["senha"] != null) ? $_POST["senha"] : "";
$nivel = (isset($_POST["nivel"]) && $_POST["nivel"] != null) ? $_POST["nivel"] : "0";
// ------- Salvar -------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Salvar_$tabela" && $user != "") {

    try {
        if ($id != "") {
            $stmt = $conn->prepare("UPDATE $tabela SET Nome = ?, Senha = ?, Nivel_Privilegio = ? WHERE id = ?");
            $stmt->bindParam(4, $id);
        } else {
            $stmt = $conn->prepare("INSERT INTO $tabela (Nome, Senha, Nivel_Privilegio) VALUES (?,?,?)");
        }
        $stmt->bindParam(1, $user);
        $stmt->bindParam(2, $senha);
        $stmt->bindParam(3, $nivel);

        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                echo "Gravado com sucesso!";
                // $nome = null;
                // $mes = null;
                // $requisito = null;
                // $ano = null;
            ?>
                <script type="text/javascript">
                    window.open('index.php', '_self');
                </script>
<?php
            } else {
                echo "Erro ao tentar efetivar cadastro";
            }
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
        // }
    }
}
// ------ Atualizar ------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Atualizar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("SELECT * FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $rs = $stmt->fetch(PDO::FETCH_OBJ);
            // $id = $rs->id;
            // $data = $rs->Data;
            // $quantidade = $rs->Quantidade;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
// ------ Delete ---------
if (isset($_REQUEST["act"]) && $_REQUEST["act"] == "Deletar_$tabela" && $id != "") {
    try {
        $stmt = $conexao->prepare("DELETE FROM $tabela WHERE id = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            echo "Registo foi excluído com êxito";
            $id = null;
        } else {
            throw new PDOException("Erro: Não foi possível executar a declaração sql");
        }
    } catch (PDOException $erro) {
        echo "Erro: " . $erro->getMessage();
    }
}
?>