<?php

    session_start();
    $_SESSION['nome_usuario'] = "Usuário";
    header("Location: home.php");

?>


