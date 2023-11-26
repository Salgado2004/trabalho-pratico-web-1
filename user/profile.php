<?php

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    /* if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) != "/user/user.php"){
        header("Location: ../user/user.php");
    } */

    require("../database/credentials.php");
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $sql = "use $dbname";
    if (!mysqli_query($conn, $sql)) {
        echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
    }

    $id_usuario = $_SESSION['id_usuario'];
    $sql = "SELECT usuario.nome, email, usuario.imagem, usuario.carro, liga.nome, pontuacao.pontuacao, pontuacao.data_reg FROM usuario INNER JOIN liga ON usuario.fk_liga = liga.id INNER JOIN pontuacao ON pontuacao.fk_usuario = usuario.id WHERE usuario.id = $id_usuario GROUP BY pontuacao.pontuacao ORDER BY pontuacao.pontuacao DESC LIMIT 1";
    if (mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        $nome = $row[0];
        $email = $row[1];
        $imagem = $row[2];
        $carro = $row[3];
        $liga = $row[4];
        $pontuacao = $row[5];
        $data = $row[6];
        $date = strtotime($data);
    } else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

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
                <img src="../assets/img/profiles/user<?php echo $imagem; ?>.png" alt="User">
            </div>
            <h3>Nome: <?php echo $nome; ?></h3>
            <p>Email: <?php echo $email; ?></p>
            <p>Liga: <?php echo $liga; ?></p>
        </section>
        <section id="extra-info">
            <div id="user-car">
                <h3>Meu carro</h3>
                <img src="../assets/img/carros/carro<?php echo $carro; ?>.png" alt="Car">
            </div>
            <div id="user-best-score">
                <h3>Melhor pontuação</h3>
                <h4><?php echo $pontuacao; ?> pontos em
                    <span><?php echo date('d/m/Y, H:i', $date); ?></span>
                </h4>
        </section>
    </main>
</body>
</html>