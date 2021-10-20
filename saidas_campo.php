<?php
require_once("src/Comandos.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saídas de Campo</title>
</head>

<body>
    <!-- SAIDAS DE CAMPO -->
    <section id="6">
        <h3>Saídas de Campo</h3>
        <form action="?act=Salvar_SAIDA_CAMPO" method="POST" name="Saida_Campo">
            <select name="dia_Semana" id="dia_Semana" required>
                <option value="0" selected>Dia da Semana</option>
                <option value="1">Domingo</option>
                <option value="2">Segunda</option>
                <option value="3">Terça</option>
                <option value="4">Quarta</option>
                <option value="5">Quinta</option>
                <option value="6">Sexta</option>
                <option value="7">Sábado</option>
            </select>
            <input type="text" name="grupo" id="grupo" placeholder="Nome do Grupo">
            <input type="text" name="dirigente" id="dirigente" placeholder="Nome do Dirigente" required>
            <input type="text" name="local_saida" id="local_saida" placeholder="Local da Saída" required>
            <input type="time" name="hora" id="hora" required>
            <input type="text" name="detalhes" id="detalhes" placeholder="Detalhes Adicionais">
            <input type="submit" value="Gravar e Fixar no Quadro">
        </form>
        <br>
        <a href="saidas_campo_lista.php">Ver Lista Completa</a>
    </section>
</body>

</html>