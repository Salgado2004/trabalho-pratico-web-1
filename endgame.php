<?php
    $file = fopen("log.txt", "a");
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        session_start();

        if (isset($_POST['time'])){
            $tempoFormatado = getdate($_POST['time']);
            $time = $tempoFormatado['hours'] . ":" . $tempoFormatado['minutes'] . ":" . $tempoFormatado['seconds'];
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
            if(is_numeric($_POST['modo'])){
                $modo = $_POST['modo'];
            }
        } else{
            die("Error: Requisição incorreta\n");
            fwrite($file, date('l jS \of F Y h:i:s A') . "Error: Requisição incorreta\n");
        }
    
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d H:i:s');

        $entry = new stdClass();
        $entry->datetime = $data;
        $entry->name = $_SESSION['nome_usuario'];
        $entry->time = $time;
        $entry->points = $pontos;

        // Read the existing JSON file
        $jsonFile = 'pontuations.json';
        if (file_exists($jsonFile)) {
            $entries = json_decode(file_get_contents($jsonFile));
        } else {
            $entries = [];
        }

        // Add the new entry to the list
        $entries[] = $entry;

        // Write the updated list back to the JSON file
        file_put_contents($jsonFile, json_encode($entries));
        fwrite($file, date('l jS \of F Y h:i:s A') . " - Pontuação registrada com sucesso\n");

    } else{
        fwrite($file, date('l jS \of F Y h:i:s A') . "Error: Requisição incorreta\n");
        fclose($file);
        header("Location: ../home/home.php");
    }

?>