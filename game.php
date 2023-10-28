<?php 
    $nomeJogador = $_POST['nome-jogador'];
    $estilo = $_POST['estilo'];
    $dificuldade = $_POST['dificuldade'];
    $tempo = $_POST['tempo'];
    $voltas = $_POST['voltas'];

    if ($nomeJogador == null || ''){
        $nomeJogador = 'Jogador';
    } else{
        $nomeJogador[0] = strtoupper($nomeJogador[0]);
    }

    switch($dificuldade){
        case 'facil':
            $baseSpeed = 2;
            break;
    }

    echo "<script>
        const nomeJogador = '$nomeJogador';
        const estilo = '$estilo';
        const dificuldade = '$dificuldade';
        const tempoMax = $tempo;
        const voltasMax = $voltas;
        const baseSpeed = $baseSpeed;
    </script>"
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Word Runner!</title>

    <link rel="stylesheet" href="style/fonts.css">
    <link rel="stylesheet" href="style/game.css">
</head>
<body>
    <header></header>
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

    </footer>

    <script src="js/background.js"></script>
    <script src="js/car.js"></script>
    <script src="js/words.js"></script>
    <script src="js/road.js"></script>
    <script src="js/game.js"></script>
</body>
</html>