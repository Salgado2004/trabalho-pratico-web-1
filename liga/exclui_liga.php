<?php 

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    if (!isset($_SESSION['existe_liga'])){
        header("Location: ../home/ligas.php");
    } else{
        $idUsuario = $_SESSION['id_usuario'];
        $idLiga = $_SESSION['liga_usuario'];

        require("../database/credentials.php");
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
        }

        $sql = "use $dbname";
        if (!mysqli_query($conn, $sql)) {
            echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
        }

        $sql = "SELECT senha FROM usuario WHERE id=$idUsuario;";
        if($result = mysqli_query($conn, $sql)){
            $row = mysqli_fetch_assoc($result);
            $senha = $row['senha'];
            if (isset($_POST['confirm'])){
                if (md5($_POST['senha']) == $senha){
                    $sql = "UPDATE usuario SET fk_liga=NULL WHERE fk_liga=$idLiga;";
                    if (mysqli_query($conn, $sql)) {
                        $_SESSION['liga_usuario'] = NULL;
                        $_SESSION['existe_liga'] = false;
                        $sql = "DELETE FROM liga WHERE id=$idLiga;";
                        if (mysqli_query($conn, $sql)) {
                            header("Location: ../home/ligas.php");
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                } else {
                    echo "<script>alert('Senha incorreta!');</script>";
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordRunner | Excluir liga</title>

    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="../style/entrarLiga.css">
</head>
<body>
    <main>
        <h3>Ao excluir a liga não será possível recuperá-la</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <label for="senha">Digite sua senha para confirmar: </label>
            <input type="password" name="senha" placeholder="Senha">
            <button type="submit" name="confirm">Entrar</button>
        </form>
    </main>
</body>
</html>