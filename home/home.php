<?php

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    $nomeUsuario = $_SESSION['nome_usuario'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Runner | Home</title>
    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="../style/home.css">
</head>
<body>
    <header>
        <a id="profile" href="../user/user.php">Meu perfil</a>
        <div class="sair">
            <a href="../logout.php">Sair</a>
        </div>
    </header>
    <main>
        <h3>World Runner</h3>
        <nav>
            <ul>               
                <li><a class="nav-link active" href="game-settings.php" target="main-menu">Menu</a></li>
                <li><a class="nav-link" href="ranking.php?scope=geral" target="main-menu">Ranking geral</a></li>
                <li><a class="nav-link" href="ligas.php" target="main-menu">Ligas</a></li>
                <li><a class="nav-link" href="ranking.php?scope=liga" target="main-menu">Minha Liga</a></li>
            </ul>
        </nav>
        <iframe id="main-menu" name="main-menu" src="game-settings.php" frameborder="0"></iframe>
    </main>
    <footer>
        &copy; TADS UFPR 2023;
    </footer>
    <script src="../js/home.js"></script>
</body>
</html>
