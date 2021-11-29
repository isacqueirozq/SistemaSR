<?php
require_once("ConexaoBD.php");
try {
    $conn->exec("set names utf8");
    //VERIFICANDO BASES E SUAS TABELAS
        $databases = "SistemaSR"; 
        $existe = $conn->query("SHOW DATABASES LIKE '$databases'")->rowCount() > 0;
        if ($existe > 0) {
            //VERIFICA TODAS AS TABELAS
            $myTables = array("USUARIOS", "ASSISTENCIA", "DESIGNACOES", "NOTICIAS", "PETICAO_AUXILIAR", "RELATORIO_CAMPO", "SAIDA_CAMPO", "CONFIGURACOES");
            $contaTabelas = count($myTables);
            echo $databases ."<br>"; 
            for ($x = 0; $x < $contaTabelas; $x++) {
                $existetabela =
                    $conn->query("SHOW TABLES LIKE '$myTables[$x]'")->rowCount() > 0;
                if ($existetabela > 0) {
                    echo $myTables[$x]." - OK <br>";
                } else {
                    echo "<br> -> Recriando a tabela: ".$myTables[$x]."... <br>";
                    echo "<br>";
                    switch ($myTables[$x]) {
                        case "DESIGNACOES":
                            //==== CRIA TABELA ==== DESIGNACOES
                            /*Reunião = 0 para MEIO de SEMANA e 1 FIM DE SEMANA */
                            $sql = "CREATE TABLE IF NOT EXISTS DESIGNACOES (
                            ID int(11) AUTO_INCREMENT PRIMARY KEY,
                            Reuniao BOOLEAN NOT NULL COMMENT 'false = meio de semana\r\ntrue = fim de semana',
                            Data date NOT NULL,
                            Presidente varchar(30),
                            Orador varchar(30) COMMENT 'FIM de semana',
                            Tema varchar(50) COMMENT 'FIM de semana',
                            Leitor varchar(30) COMMENT 'FIM de semana',
                            Tesouros varchar(30) COMMENT 'MEIO da Semana',
                            Joias varchar(30) COMMENT 'MEIO da Semana',
                            L_Biblia varchar(30) COMMENT 'MEIO da Semana',
                            Faca_01 varchar(30) COMMENT 'MEIO da Semana',
                            Faca_02 varchar(30) COMMENT 'MEIO da Semana',
                            Faca_03 varchar(30) COMMENT 'MEIO da Semana',
                            Faca_04 varchar(30) COMMENT 'MEIO da Semana',
                            Vida_01 varchar(30) COMMENT 'MEIO da Semana',
                            Vida_02 varchar(30) COMMENT 'MEIO da Semana',
                            Vida_03 varchar(30) COMMENT 'MEIO da Semana',
                            Dirigente_EBC varchar(30) COMMENT 'MEIO da Semana',
                            Leitor_EBC varchar(30) COMMENT 'MEIO da Semana',
                            Oracao varchar(30) COMMENT 'MEIO da Semana'
                            )";
                            $conn->exec($sql);
                        break;

                        case "RELATORIO_CAMPO":
                            //==== CRIA TABELA ==== RELATORIO DE CAMPO
                            $sql = "CREATE TABLE IF NOT EXISTS RELATORIO_CAMPO (
                            ID int AUTO_INCREMENT PRIMARY KEY,
                            Nome varchar(50) NOT NULL,
                            Mes varchar(10) NOT NULL,
                            Ano year(4) NOT NULL,
                            Pioneiro int(1) NOT NULL COMMENT '0 = Publicador 1 = Auxiliar 2 = Regular 3 = Especial',
                            Publicacoes int,
                            Videos int,
                            Horas int,
                            Revisitas int,
                            Estudos int,
                            Obs text 
                            )";
                            $conn->exec($sql);
                        break;

                        case "SAIDA_CAMPO":
                            //==== CRIA TABELA ==== SAÍDAS DE CAMPO
                            $sql = "CREATE TABLE IF NOT EXISTS SAIDA_CAMPO (
                            ID int(11) AUTO_INCREMENT PRIMARY KEY,
                            Dia_Semana int(11) NOT NULL,
                            Semana_do_mes int(11),
                            Dirigente varchar(30) NOT NULL,
                            Link varchar(50) NOT NULL,
                            Hora time NOT NULL)";
                            $conn->exec($sql);
                        break;

                        case "NOTICIAS":
                            //==== CRIA TABELA ==== NOTICIAS
                            $sql = "CREATE TABLE IF NOT EXISTS NOTICIAS (
                                ID int(11) AUTO_INCREMENT PRIMARY KEY,
                                Titulo varchar(50) NOT NULL,
                                Subtitulo varchar(30),
                                Texto text NOT NULL,
                                Data_Postagem date NOT NULL,
                                Data_Retirada date NOT NULL
                                )";
                            $conn->exec($sql);
                        break;

                        case "PETICAO_AUXILIAR":
                            //==== CRIA TABELA ==== PETIÇÃO de AUXILIAR
                            $sql = "CREATE TABLE IF NOT EXISTS PETICAO_AUXILIAR (
                                ID int(11) AUTO_INCREMENT PRIMARY KEY,
                                Nome varchar(50) NOT NULL,
                                Mes varchar(30) NOT NULL,
                                Requisito int,
                                Ano int(4)
                                )";
                            $conn->exec($sql);
                        break;

                        case "ASSISTENCIA":
                            //==== CRIA TABELA ==== ASSISTENCIA
                            $sql = "CREATE TABLE IF NOT EXISTS ASSISTENCIA (
                                ID int(11) AUTO_INCREMENT PRIMARY KEY,
                                Data date NOT NULL,
                                Quantidade int(5) NOT NULL
                                )";
                            $conn->exec($sql);
                        break;

                        case "CONFIGURACOES":
                            //==== CRIA TABELA ==== CONFIGURAÇÕES
                            $sql = "CREATE TABLE IF NOT EXISTS CONFIGURACOES (
                                    ID int(11) PRIMARY KEY,
                                    Congregacao varchar(50),
                                    Publicadores int
                                    )";
                            $conn->exec($sql);
                        break;
                    }
                    echo "Tabelas recriadas com sucesso!";
                }
            }
        }
        else
        {
            //### CRIA BASE DE DADOS ###
            $sql = "CREATE DATABASE IF NOT EXISTS SistemaSR";
            $conn->exec($sql);
            $sql = "use " . $databases . "";
            $conn->exec($sql);
        
            //==== CRIA TABELA ==== USUARIOS
            $sql = "CREATE TABLE IF NOT EXISTS USUARIOS (
                    ID int(11) AUTO_INCREMENT PRIMARY KEY,
                    Nome varchar(30) NOT NULL,
                    Senha varchar(30) NOT NULL,
                    Nivel_Privilegio int(3) NOT NULL
                    )";
            $conn->exec($sql);

            //==== CRIA TABELA ==== DESIGNACOES
            /*Reunião = 0 para MEIO de SEMANA e 1 FIM DE SEMANA */
            $sql = "CREATE TABLE IF NOT EXISTS DESIGNACOES (
                        ID int(11) AUTO_INCREMENT PRIMARY KEY,
                        Reuniao BOOLEAN NOT NULL COMMENT 'false = meio de semana\r\ntrue = fim de semana',
                        Data date NOT NULL,
                        Presidente varchar(30),
                        Orador varchar(30) COMMENT 'FIM de semana',
                        Tema varchar(50) COMMENT 'FIM de semana',
                        Leitor varchar(30) COMMENT 'FIM de semana',
                        Tesouros varchar(30) COMMENT 'MEIO da Semana',
                        Joias varchar(30) COMMENT 'MEIO da Semana',
                        L_Biblia varchar(30) COMMENT 'MEIO da Semana',
                        Faca_01 varchar(30) COMMENT 'MEIO da Semana',
                        Faca_02 varchar(30) COMMENT 'MEIO da Semana',
                        Faca_03 varchar(30) COMMENT 'MEIO da Semana',
                        Faca_04 varchar(30) COMMENT 'MEIO da Semana',
                        Vida_01 varchar(30) COMMENT 'MEIO da Semana',
                        Vida_02 varchar(30) COMMENT 'MEIO da Semana',
                        Vida_03 varchar(30) COMMENT 'MEIO da Semana',
                        Dirigente_EBC varchar(30) COMMENT 'MEIO da Semana',
                        Leitor_EBC varchar(30) COMMENT 'MEIO da Semana',
                        Oracao varchar(30) COMMENT 'MEIO da Semana'
                        )";
            $conn->exec($sql);

            //==== CRIA TABELA ==== RELATORIO DE CAMPO
            $sql = "CREATE TABLE IF NOT EXISTS RELATORIO_CAMPO (
                        ID int AUTO_INCREMENT PRIMARY KEY,
                        Nome varchar(50) NOT NULL,
                        Mes varchar(10) NOT NULL,
                        Ano year(4) NOT NULL,
                        Pioneiro int(1) NOT NULL COMMENT '0 = Publicador 1 = Auxiliar 2 = Regular 3 = Especial',
                        Publicacoes int,
                        Videos int,
                        Horas int,
                        Revisitas int,
                        Estudos int,
                        Obs text 
                        )";
            $conn->exec($sql);

            //==== CRIA TABELA ==== SAÍDAS DE CAMPO
            $sql = "CREATE TABLE IF NOT EXISTS SAIDA_CAMPO (
                        ID int(11) AUTO_INCREMENT PRIMARY KEY,
                        Dia_Semana int NOT NULL,
                        Grupo varchar(30),
                        Dirigente varchar(30) NOT NULL,
                        Local varchar(30) NOT NULL,
                        Hora time NOT NULL,
                        Detalhes varchar(50)
                        )";
            $conn->exec($sql);
                
            //==== CRIA TABELA ==== NOTICIAS
            $sql = "CREATE TABLE IF NOT EXISTS NOTICIAS (
                            ID int(11) AUTO_INCREMENT PRIMARY KEY,
                            Titulo varchar(50) NOT NULL,
                            Subtitulo varchar(30),
                            Texto text NOT NULL,
                            Data_Postagem date NOT NULL,
                            Data_Retirada date NOT NULL
                            )";
            $conn->exec($sql);

            //==== CRIA TABELA ==== PETIÇÃO de AUXILIAR
            $sql = "CREATE TABLE IF NOT EXISTS PETICAO_AUXILIAR (
                            ID int(11) AUTO_INCREMENT PRIMARY KEY,
                            Nome varchar(50) NOT NULL,
                            Mes varchar(30) NOT NULL,
                            Requisito int,
                            Ano int(4)
                            )";
            $conn->exec($sql);

            //==== CRIA TABELA ==== ASSISTENCIA
            $sql = "CREATE TABLE IF NOT EXISTS ASSISTENCIA (
                            ID int(11) AUTO_INCREMENT PRIMARY KEY,
                            Data date NOT NULL,
                            Quantidade int(5) NOT NULL
                            )";
            $conn->exec($sql);

            //==== CRIA TABELA ==== CONFIGURAÇÕES
            $sql = "CREATE TABLE IF NOT EXISTS CONFIGURACOES (
                                ID int(11) PRIMARY KEY,
                                Congregacao varchar(50),
                                Publicadores int
                                )";
            $conn->exec($sql);
        }
}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
