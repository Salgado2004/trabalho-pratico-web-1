<?php

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) != "/user/profile.php"){
        header("Location: ../user/profile.php");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Runner | Profile</title>
    <link rel="stylesheet" href="../style/fonts.css">
</head>
<body>
    <header>
        <a id="voltar" href="user.php" target="_parent">Cancelar</a>
    </header>
    <main></main>
</body>
</html>