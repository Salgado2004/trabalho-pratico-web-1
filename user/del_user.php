<?php 

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    if (!isset($_SESSION['existe_liga'])){
        header("Location: ../user/profile.php");
    } else{
        $erroSenha=false;
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
                    $sql = "DELETE FROM pontuacao WHERE fk_usuario=$idUsuario;";
                    if (mysqli_query($conn, $sql)) {
                        $sql = "DELETE FROM usuario WHERE id=$idUsuario;";
                        if (mysqli_query($conn, $sql)) {
                            session_destroy();
                            echo "<script>window.top.location = '../index.html'</script>";
                        } else {
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                        }
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
                } else {
                    $erroSenha=true;
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
        <h3>Ao excluir seu perfil não será possível recuperá-lo</h3>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
            <label for="senha">Digite sua senha para confirmar: </label>
            <input type="password" name="senha" placeholder="Senha">
            <?php if($erroSenha): ?>
                <span class="erro">Senha incorreta</span>
            <?php endif; ?>
            <button type="submit" name="confirm">Confirmar</button>
        </form>
    </main>
</body>
</html>