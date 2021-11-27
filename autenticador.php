<?php
ob_start();
$senha_registrada = 'congsal'; //Senha armazenada.
$senha_enviada = $_POST['password']; //Senha enviada da tela de login.

//Comparando as senhas
if ($senha_enviada == $senha_registrada) {
    header("Location: gerenciamento.html");
}else{
    //exiba um alerta dizendo que a senha esta errada
?>  <script type="text/javascript">
    alert("Senha Incorreta!")
    </script>
<?php
    echo "<a href=login.php>VOLTAR</a>";
    }
?>