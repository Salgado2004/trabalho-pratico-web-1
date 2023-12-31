<?php 

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: index.html");
    }

    $nomeJogador = $_SESSION['nome_usuario'];
    $estilo = $_POST['estilo'];
    $dificuldade = $_POST['dificuldade'];
    $estiloCarro = $_SESSION['estiloCarro'];

    if ($nomeJogador == null || ''){
        $nomeJogador = 'Jogador';
    } else{
        $nomeJogador[0] = strtoupper($nomeJogador[0]);
    }

    echo "<script>
        const nomeJogador = '$nomeJogador';
        const estiloCarro = '$estiloCarro';
        const estilo = '$estilo';
        const dificuldade = '$dificuldade';
        const tempoMax = 2;
        const voltasMax = 10;
        const baseSpeed = 2;
    </script>"
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Word Runner | Game</title>

    <link rel="stylesheet" href="style/fonts.css">
    <link rel="stylesheet" href="style/game.css">
</head>
<body>
    <main>
        <div class="banner">
            <h1>Word Runner!</h1>
            <button onclick="start()">Começar!</button>
        </div>
        <div class="game">
            <div>
                <canvas class="scene"></canvas>
                <span class="time"></span>
                <span class="player-place"></span>
                <span class="lap-count"></span>
            </div>
        </div>
    </main>
    <footer>
        &copy; TADS UFPR 2023;
    </footer>

    <script src="js/background.js"></script>
    <script src="js/car.js"></script>
    <script src="js/words.js"></script>
    <script src="js/road.js"></script>
    <script src="js/game.js"></script>
</body>
</html>