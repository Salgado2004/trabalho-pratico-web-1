<?php

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    /* if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) != "/home/ranking.php"){
        header("Location: ../home/home.php");
    } */
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Runner | Error</title>
    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="../style/error.css">

</head>
<body>
    <h1>Whoops</h1>
    <h2>Parece que você não faz parte de nenhuma liga</h2>
    <h2>Entre em uma liga para ver seu ranking</h2>
</body>
</html>