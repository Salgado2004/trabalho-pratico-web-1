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

    require("../database/credentials.php");
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $sql = "use $dbname";
    if (!mysqli_query($conn, $sql)) {
        echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
    }

    if ($_GET['scope'] == "geral"){
        $sql = "SELECT nome, imagem, sum(pontuacao) as pontuacao FROM pontuacao INNER JOIN usuario ON pontuacao.fk_usuario = usuario.id GROUP BY usuario.id ORDER BY pontuacao DESC;";
    } else{
        $sql = "SELECT nome, imagem, sum(pontuacao) as pontuacao FROM pontuacao INNER JOIN usuario ON pontuacao.fk_usuario = usuario.id WHERE usuario.fk_liga = " . $_SESSION['liga_usuario'] . " GROUP BY usuario.id ORDER BY pontuacao DESC";
    }

    $ranking = array();
    if(mysqli_query($conn, $sql)){
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $ranking[] = $row;
        }
    } else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $sql = "SELECT liga.nome, count(usuario.id) as participantes FROM liga INNER JOIN usuario ON usuario.fk_liga = liga.id WHERE liga.id = " . $_SESSION['liga_usuario']." GROUP BY liga.id";
    if(mysqli_query($conn, $sql)){
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $nomeLiga = $row['nome'];
        $participantes = $row['participantes'];
    } else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);

    $nomeUsuario = $_SESSION['nome_usuario'];
    $scope = $_GET['scope'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Runner | Ranking</title>

    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="../style/ranking.css">
</head>
<body>
    <header>
        <?php if ($scope == "liga") : ?>
            <h1 class="league"><?php echo $nomeLiga; ?></h1>
            <span class="participants"><?php echo $participantes; ?> participantes</span>
        <?php endif; ?>
    </header>
    <main>
        <table>
            <tr>
                <th>Posição</th>
                <th>Usuário</th>
                <th>Pontuação</th>
            </tr>
            <?php $posicao = 1; foreach($ranking as $usuario) : ?>
                <tr>
                    <td><?php echo $posicao; ?>º</td>
                    <td>
                        <div class="user">
                        <img class="img_perfil" src="../assets/img/profiles/user<?php echo $usuario['imagem']; ?>.png" alt="Foto de perfil">
                        <?php echo $usuario['nome']; ?>
                        </div>
                    </td>
                    <td><?php echo $usuario['pontuacao']; ?> pts</td>
                </tr>
            <?php $posicao++; endforeach; ?>
        </table>
    </main>
</body>
</html>