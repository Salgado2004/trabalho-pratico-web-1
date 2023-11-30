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
    $sql = "SELECT usuario.nome, email, usuario.imagem, usuario.carro, usuario.fk_liga FROM usuario WHERE usuario.id = $id_usuario";
    if (mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($result);
        $nome = $row[0];
        $email = $row[1];
        $imagem = $row[2];
        $carro = $row[3];
        $fk_liga = $row[4];
    } else{
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    if ($fk_liga == NULL) {
        $liga = "Sem liga";
    } else{
        $sql = "SELECT liga.nome FROM liga WHERE liga.id = $fk_liga";
        if (mysqli_query($conn, $sql)) {
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_row($result);
            $liga = $row[0];
        } else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    
    $sql = "SELECT pontuacao, pontuacao.data_reg FROM pontuacao WHERE fk_usuario = $id_usuario ORDER BY pontuacao DESC";
    if (mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            $highScore = "Não há pontuações registradas";
        } else{
            $history = array();
            while ($row = mysqli_fetch_assoc($result)) {
                if (!isset($highScore)) {
                    $highScore = $row['pontuacao'] . " pontos em " . date('d/m/Y, H:i', strtotime($row['data_reg']));
                } else{
                    array_push($history, $row['pontuacao'] . " pontos em " . date('d/m/Y, H:i', strtotime($row['data_reg'])));
                }
            }

        }
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
            <a href="del_user.php">Excluir Perfil</a>
        </div>
    </header>
    <main id="profile">
        <section id="main-info">
            <div id="user-img">
                <img src="../assets/img/profiles/user<?php echo $imagem; ?>.png" alt="User">
            </div>
            <div id="user-main-info">
                <h3>Nome: <?php echo $nome; ?></h3>
                <p>Email: <?php echo $email; ?></p>
                <p>Liga: <?php echo $liga; ?></p>
            </div>
            <div id="user-best-score">
                <h3>Melhor pontuação</h3>
                <h4><?php echo $highScore; ?></h4>
            </div>
        </section>
        <section id="extra-info">
            <div id="user-car">
                <h3>Meu carro</h3>
                <img src="../assets/img/carros/carro<?php echo $carro; ?>.png" alt="Car">
            </div>
            <div id="historico">
                <?php if (isset($history)): ?>
                    <h3>Histórico</h3>
                    <table class="hist">
                    <?php foreach ($history as $value): ?>
                        <tr><td><?php echo $value ?><td></tr>
                    <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>