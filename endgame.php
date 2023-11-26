<?php
    require('verifica_campo.php');
    $file = fopen("log.txt", "a");
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        session_start();

        require("database/credentials.php");
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (!$conn) {
            die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
            fwrite($file, date('l jS \of F Y h:i:s A') . "Falha na conexão com o banco de dados: " . mysqli_connect_error() . "\n");
        }

        if (isset($_SESSION['id_usuario'])){
            if(is_numeric($_SESSION['id_usuario'])){
              $id_usuario = $_SESSION['id_usuario'];
            }
        } else{
            header("Location: ../login/login.php");
        }

        if (isset($_POST['time'])){
            $tempoFormatado = getdate($_POST['time']);
            $time = $tempoFormatado['hours'] . ":" . $tempoFormatado['minutes'] . ":" . $tempoFormatado['seconds'];
            $time = verifica_campo($conn, $time);
        } else{
            $time = null;
        }

        if (isset($_POST['points'])){
            if(is_numeric($_POST['points'])){
                $pontos = $_POST['points'];
            }
        } else{
            die("Error: Requisição incorreta\n");
            fwrite($file, date('l jS \of F Y h:i:s A') . "Error: Requisição incorreta\n");
        }

        if (isset($_POST['modo'])){
            if(is_bool($_POST['modo'])){
                $modo = $_POST['modo'];
            }
        } else{
            die("Error: Requisição incorreta\n");
            fwrite($file, date('l jS \of F Y h:i:s A') . "Error: Requisição incorreta\n");
        }

        $data = date('Y-m-d H:i:s');

        $sql = "use $dbname";
        if (!mysqli_query($conn, $sql)) {
            echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
            fwrite($file, date('l jS \of F Y h:i:s A') . "Error connecting to database: " . mysqli_error($conn) . "\n");
        }

        $sql = "INSERT INTO pontuacao (fk_usuario, pontuacao, data_reg, tempo, modo_jogo) VALUES ($id_usuario, $pontos, '$data', '$time', $modo)";
        if (mysqli_query($conn, $sql)) {
            fwrite($file, date('l jS \of F Y h:i:s A') . "Pontuação registrada com sucesso\n");
        } else{
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            fwrite($file, date('l jS \of F Y h:i:s A') . "Error: " . $sql . "\n" . mysqli_error($conn) . "\n");
        }

        mysqli_close($conn);

    } else{
        fwrite($file, date('l jS \of F Y h:i:s A') . "Error: Requisição incorreta\n");
        fclose($file);
        header("Location: ../home/home.php");
    }

?>