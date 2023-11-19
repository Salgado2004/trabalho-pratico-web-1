<?php

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) != "/home/home.php" || !isset($_GET['scope'])){
        header("Location: ../home/home.php");
    }

    if ($_GET['scope'] != "geral" && $_GET['scope'] != "liga"){
        header("Location: ../home/home.php");
    }

    if ($_GET['scope'] == "liga" && !$_SESSION['existe_liga']){
        echo "<script>window.location.href='error_liga.php';</script>";
    }

    $nomeUsuario = $_SESSION['nome_usuario'];
    $scope = $_GET['scope'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Runner | Ranking</title>
</head>
<body>
    <h1>Ranking <?php echo $scope ?></h1>
</body>
</html>