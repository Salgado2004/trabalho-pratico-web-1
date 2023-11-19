<?php

    session_start();
    $_SESSION['nome_usuario'] = "Usuário";
    $_SESSION['existe_liga'] = false;
    $_SESSION['email_usuario'] = $_POST['email-user'];
    $_SESSION['liga_usuario'] = "Sem liga";
    header("Location: home/home.php");

?>


