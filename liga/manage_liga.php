<?php

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: ../index.html");
    }

    
    require("../database/credentials.php");

    
    $erro=false;
    if($_SERVER["REQUEST_METHOD"]=="GET"){
        if($_SESSION["existe_liga"]){
            $method="PUT";

            $conn = mysqli_connect($servername, $username, $password, $dbname);
            if (!$conn) {
                die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
            }

            $sql = "use $dbname";
            if (!mysqli_query($conn, $sql)) {
                echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
            }

            $sql = "SELECT * FROM liga WHERE id=".$_SESSION["liga_usuario"];
            if (mysqli_query($conn, $sql)) {
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $nomeLiga = $row['nome'];
                $private = $row['private'];
                $imagem = $row['imagem'];
            }
            mysqli_close($conn);
        } else{
            $method="POST";
            $nomeLiga = "";
            $private = 0;
            $imagem = 1;
        }

        if (isset($_GET["er"])){
            $erro=true;
            // Cuida disso depois
            $erroInput="Ocorreu um erro";
        }
    }

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $nomeLiga = $_POST["nome"];
        $private = $_POST["private"];
        $senha = NULL;
        if (isset($_POST["senha"]) && !empty($_POST["senha"])){
            $senha = md5($_POST["senha"]);
        }
        $imagem = $_POST["perfil"];

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
        }

        $sql = "use $dbname";
        if (!mysqli_query($conn, $sql)) {
            echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
        }

        $sql = "INSERT INTO liga (nome, private, imagem, senha, fk_criador) VALUES ('$nomeLiga', $private, $imagem, '$senha', ".$_SESSION["id_usuario"].")";
        if(mysqli_query($conn, $sql)){
            $_SESSION["existe_liga"]=true;
            $sql = "SELECT id FROM liga WHERE fk_criador=".$_SESSION["id_usuario"];
            if($result = mysqli_query($conn, $sql)){
                $row = mysqli_fetch_row($result);
                $_SESSION["liga_usuario"]=$row[0];
                $sql = "UPDATE usuario SET fk_liga=".$row[0]." WHERE id=".$_SESSION["id_usuario"];
                if(mysqli_query($conn, $sql)){
                    header("Location: ../home/ranking.php?scope=liga");
                }
            }
        } else{
            echo "Ocorreu um erro";
        }

        mysqli_close($conn);
    }

    if($_SERVER["REQUEST_METHOD"]=="PUT"){
        $nomeLiga = $_PUT["nome"];
        $private = $_PUT["private"];
        $imagem = $_PUT["perfil"];

        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
        }

        $sql = "use $dbname";
        if (!mysqli_query($conn, $sql)) {
            echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
        }

        $sql = "UPDATE liga SET nome='$nomeLiga', private=$private, imagem=$imagem WHERE id=".$_SESSION["liga_usuario"];
        if(mysqli_query($conn, $sql)){
            header("Location: ../home/ranking.php?scope=liga");
        } else{
            echo "Ocorreu um erro";
        }

        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordRunner | Ligas</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="../style/manageLiga.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
</head>
<body>
    <header>
        <h3><?php echo ($_SESSION['existe_liga']) ? "Editar" : "Criar"; ?> liga</h3>
        <a id="voltar" href="../home/ligas.php">Cancelar</a>
    </header>
    <main>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="<?php echo $method; ?>">
            <div class="input">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Nome da liga" value="<?php echo $nomeLiga; ?>">
            </div>
            <div class="input">
                <div>
                    <label for="no">Pública</label>
                    <input type="radio" id="no" name="private" value="0" <?php if($private==0) echo "checked"; ?>>
                </div>
                <div>
                    <label for="yes">Privada</label>
                    <input type="radio" id="yes" name="private" value="1" <?php if($private==1) echo "checked"; ?>>
                </div>
            </div>
            <?php if(!$_SESSION["existe_liga"]):?>
            <div class="input">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" placeholder="Senha da liga">
            </div>
            <?php endif; ?>
            <p class="label">Imagem de perfil</p>
            <div id="perfis" class="splide">
                <div class="splide__track">
                    <div class="splide__list">
                        <?php for ($i=1; $i<7; $i++): ?>
                        <input type="radio" name="perfil" id="perfil<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if($imagem==$i) echo "checked"; ?>>
                        <label for="perfil<?php echo $i; ?>" class="splide__slide">
                            <img src="../assets/img/profiles/liga<?php echo $i; ?>.png" alt="">
                        </label>
                        <?php endfor; ?>
                        </div>
                </div>
                <div class="splide__arrows"></div>
            </div>
            <?php if($erro): ?>
                <span class="erro"><?php echo $erroInput; ?></span>
            <?php endif; ?>
            <button type="submit"><?php echo ($_SESSION['existe_liga']) ? "Editar" : "Criar"; ?></button>
        </form>
    </main>
    <script src="../js/slider.js"></script>
</body>
</html>