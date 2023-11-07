<?php

    session_start();
    $_SESSION['nome_usuario'] = "User";
    header("Location: user/edit_user.php");

?>