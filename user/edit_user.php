<?php

session_start();
if (!isset($_SESSION['nome_usuario'])) {
    session_destroy();
    header("Location: ../index.html");
}

/* if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) != "/user/profile.php"){
        header("Location: ../user/profile.php");
    } */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require "../database/credentials.php";
    require "../verifica_campo.php";
    $erro = "";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (empty($_POST["nome"])) {
        $erro =  "Nome inválido";
    } else if (empty($_POST["email"])) {
        $erro =  "Email inválido";
    } else if (empty($_POST["perfil"])) {
        $erro =  "Perfil inválido";
    } else if (empty($_POST["carro"])) {
        $erro =  "Carro inválido";
    } else if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["perfil"]) && isset($_POST["carro"])) { {

            $nome = verifica_campo($conn, $_POST["nome"]);
            $email = verifica_campo($conn, $_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erro = "Email inválido";
            }
            if (is_numeric($_POST["perfil"]) && $_POST["perfil"] > 0 && $_POST["perfil"] < 10) {
                $perfil = $_POST["perfil"];
            } else {
                $erro =  "Perfil inválido";
            }
            if (is_numeric($_POST["carro"]) && $_POST["carro"] > 0 && $_POST["carro"] < 7) {
                $carro = $_POST["carro"];
            } else {
                $erro =  "Carro inválido";
            }

            $sql = "UPDATE usuario SET nome = '" . $nome . "',
                email = '" . $email . "', carro = '" . $carro . "',
                imagem = '" . $perfil . "' WHERE id = '" . $_SESSION["id_usuario"] . "'";

            if (!mysqli_query($conn, $sql)) {
                die("Error connecting to database: " . mysqli_error($conn) . "<br>");
            } else {
                $_SESSION["nome_usuario"] = $nome;
                $_SESSION["email_usuario"] = $email;
                $_SESSION["estiloCarro"] = $carro;
                $_SESSION["estiloPerfil"] = $perfil;
                header("Location: profile.php");
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Runner | Profile</title>
    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="../style/edit-user.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <script src="../js/check_edit.js"></script>
</head>

<body>
    <header>
        <a id="voltar" href="profile.php">Cancelar</a>
    </header>
    <main>
        <h1>Editar perfil</h1>
        <form action="edit_user.php" class="edit" method="post">
            <section class="left">
                <div class="input">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['nome_usuario']; ?>">
                </div>
                <div class="input">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="<?php echo $_SESSION['email_usuario']; ?>">
                </div>
                <p class="erro-input"><?php echo $erro; ?></p>


            </section>
            <section class="right">
                <p class="label">Imagem de perfil</p>
                <div id="perfis" class="splide">
                    <div class="splide__track">
                        <div class="splide__list">
                            <?php for ($i = 1; $i < 10; $i++) : ?>
                                <input type="radio" name="perfil" id="perfil<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if ($_SESSION['estiloPerfil'] == $i) echo "checked"; ?>>
                                <label for="perfil<?php echo $i; ?>" class="splide__slide">
                                    <img src="../assets/img/profiles/user<?php echo $i; ?>.png" alt="">
                                </label>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="splide__arrows"></div>
                </div>

                <p class="label">Carro</p>
                <div id="carros" class="splide">
                    <div class="splide__track">
                        <div class="splide__list">
                            <?php for ($i = 1; $i < 7; $i++) : ?>
                                <input type="radio" name="carro" id="carro<?php echo $i; ?>" value="<?php echo $i; ?>" <?php if ($_SESSION['estiloCarro'] == $i) echo "checked"; ?>>
                                <label for="carro<?php echo $i; ?>" class="splide__slide">
                                    <img src="../assets/img/carros/carro<?php echo $i; ?>.png" alt="">
                                </label>
                            <?php endfor; ?>
                        </div>
                    </div>
                    <div class="splide__arrows"></div>
                </div>
                
            </section>
            <button type="submit">Salvar</button>
        </form>
    </main>

    <script src="../js/edit_user.js"></script>
</body>

</html>