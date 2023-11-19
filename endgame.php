<?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['points'])){
        $pontos = $_POST['points'];

        $file = fopen("ranking.txt", "a");
        fwrite($file, $pontos . "\n");
        fclose($file);

    } else{
        header("Location: ../home/home.php");
    }

?>