<?php 

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $erroSenha=false;
        $idUsuario = $_SESSION['id_usuario'];
        if (isset($_POST['idLiga']) && is_numeric($_POST['idLiga'])){
            $idLiga = $_POST['idLiga'];

            require("../database/credentials.php");
            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
            }

            $sql = "use $dbname";
            if (!mysqli_query($conn, $sql)) {
                echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
            }

            if(!$_SESSION['existe_liga']){
                $sql = "SELECT * FROM liga WHERE id=$idLiga";
                if (mysqli_query($conn, $sql)) {
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $nomeLiga = $row['nome'];
                        $imagemLiga = $row['imagem'];
                        $private = $row['private'];
                        $senha = $row['senha'];
                        if ($private==1){
                            if (isset($_POST['senha'])){
                                if(md5($_POST['senha'])==$senha){
                                    $sql = "UPDATE usuario SET fk_liga=$idLiga WHERE id=$idUsuario;";
                                    if (mysqli_query($conn, $sql)) {
                                        $_SESSION['liga_usuario'] = $idLiga;
                                        $_SESSION['existe_liga'] = true;
                                        header("Location: ../home/ranking.php?scope=liga");
                                    } else {
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                    }
                                } else{
                                    $erroSenha=true;
                                }
                            }
                        } else{
                            $sql = "UPDATE usuario SET fk_liga=$idLiga WHERE id=$idUsuario;";
                            if (mysqli_query($conn, $sql)) {
                                $_SESSION['liga_usuario'] = $idLiga;
                                $_SESSION['existe_liga'] = true;
                                header("Location: ../home/ranking.php?scope=liga");
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                        }
                    }
                }
            } else{
                header("Location: ../home/ligas.php");
            }

            mysqli_close($conn);
        } else{
            header("Location: ../home/ligas.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordRunner | Ligas</title>
    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="../style/Entrarliga.css">
</head>
<body>
    <?php if($private==1): ?>
        <main>
            <h3>Liga protegida por senha</h3>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <input type="hidden" name="idLiga" value="<?php echo $idLiga; ?>">
                <label for="senha">Digite a senha da liga para entrar</label>
                <input type="password" name="senha" placeholder="Senha">
                <?php if($erroSenha): ?>
                    <span class="erro">Senha incorreta</span>
                <?php endif; ?>
                <button type="submit" name="entrarLiga" value="entrarLiga">Entrar</button>
            </form>
        </main>
    <?php endif; ?>
</body>
</html>