<?php

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) != "/user/user.php"){
        header("Location: ../user/user.php");
    }


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Runner</title>
    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="../style/user.css">
</head>
<body>
    <header>
        <a class="edition" href="#">Alterar Senha</a>
        <a class="edition" href="edit_user.php">Editar Perfil</a>
        <div class="exclude">
            <a href="#">Excluir Perfil</a>
        </div>
    </header>
    <main id="profile">
        <section id="main-info">
            <div id="user-img">
                <img src="../assets/img/profiles/user2.png" alt="User">
            </div>
            <h3>Nome: <?php echo $_SESSION['nome_usuario']; ?></h3>
            <p>Email: <?php echo $_SESSION['email_usuario']; ?></p>
            <p>Liga: <?php echo $_SESSION['liga_usuario']; ?></p>
        </section>
        <section id="extra-info">
            <div id="user-car">
                <h3>Meu carro</h3>
                <img src="../assets/img/carros/carro1.png" alt="Car">
            </div>
            <div id="user-best-score">
                <h3>Melhor pontuação</h3>
                <h4>0</h4>
        </section>
    </main>
</body>
</html>