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

        $sql = "UPDATE usuario SET fk_liga=NULL WHERE id=$idUsuario;";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['liga_usuario'] = NULL;
            $_SESSION['existe_liga'] = false;
            header("Location: ../home/ligas.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }

?>