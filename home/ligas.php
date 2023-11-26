<?php

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    /* if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) != "/home/home.php"){
        header("Location: ../home/home.php");
    } */

    $nomeUsuario = $_SESSION['nome_usuario'];

    require("../database/credentials.php");
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
    }

    $sql = "use $dbname";
    if (!mysqli_query($conn, $sql)) {
        echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
    }

    $ligas = array();
    $sql = "SELECT * FROM liga";
    if (mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $ligas[] = $row;
            }
        }
    }

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Runner | Ligas</title>

    <link rel="stylesheet" href="../style/ligas.css">
    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <main>
        <table>
        <?php foreach($ligas as $liga) : ?>
            <tr>
                <td>
                    <div>
                        <img src="../assets/img/profiles/liga<?php echo $liga['imagem']; ?>.png" alt="Liga">
                        <?php echo $liga['nome']; ?>
                        <?php if ($liga['private']==1) : ?>
                            <span class="material-symbols-outlined">lock</span>
                        <?php endif; ?>
                    </div>
                </td>
                <td>
                    <form action="../database/entrarLiga.php" method="post">
                        <input type="hidden" name="idLiga" value="<?php echo $liga['id']; ?>">
                        <button type="submit" name="entrarLiga" value="entrarLiga">Entrar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    </main>
    <footer>
        <form action="../database/criarLiga.php" method="post" id="criarLiga">
            <button type="submit" name="criarLiga" value="criarLiga">Criar Liga</button>
        </form>
    </footer>
    <script src="../script/ligas.js"></script>
</body>
</html>