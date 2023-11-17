<?php

    session_start();
    if (!isset($_SESSION['nome_usuario'])) {
        session_destroy();
        header("Location: index.html");
    }

    $nomeUsuario = $_SESSION['nome_usuario'];

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Runner | Home</title>
    <link rel="stylesheet" href="style/fonts.css">
</head>
<body>
    <form class="game-settings" action="game.php" method="post">
        <fieldset>
            <legend>Jogador</legend>
            <label for="nome-jogador">Nome do jogador:</label>
            <?php
              echo '<input type="text" name="nome-jogador" id="nome-jogador" value="'.$nomeUsuario.'" disabled>';
            ?>
        </fieldset>
        <fieldset>
            <legend>Circuito</legend>
            <label for="estilo">Cenário:</label>
            <select name="estilo" id="estilo">
                <option value="default">Estrada</option>
                <option value="desert">Deserto</option>
            </select>
            <label for="voltas">Voltas:</label>
            <input type="number" name="voltas" id="voltas" min="10" max="15" value="15" required>
        </fieldset>
        <fieldset>
            <legend>Modo do jogo</legend>
            <label for="tempo">Tempo:</label>
            <input type="number" name="tempo" id="tempo" min="1" max="3" value="2" required>
            <label for="dificuldade">Dificuldade:</label>
            <input type="radio" name="dificuldade" id="facil" value="facil" checked>
            <label for="facil">Fácil</label>
            <input type="radio" name="dificuldade" id="medio" value="medio">
            <label for="medio">Médio</label>
            <input type="radio" name="dificuldade" id="dificil" value="dificil">
            <label for="dificil">Impossível</label>
        </fieldset>
        <button type="submit">Jogar</button>
    </form>
</body>
</html>
