<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Runner | Home</title>
    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="../style/game-settings.css">
</head>
<body>
    <form class="game-settings" action="../game.php" method="post" target="_parent">
        <div>
            <label for="nome-jogador">Nome do jogador:</label>
            <input type="text" name="nome-jogador" id="nome-jogador" placeholder="Digite seu nome" required>;
        </div>
        <div>
            <label for="estilo">Cenário:</label>
            <select name="estilo" id="estilo">
                <option value="default">Estrada</option>
                <option value="desert">Deserto</option>
                <option value="jungle">Selva</option>
            </select>
        </div>
        <div>
            <label for="modo">Modo de jogo:</label>
            <select name="modo" id="modo">
                <option value="arcade">Arcade</option>
                <option value="tempo">Tempo</option>
            </select>
        </div>
        <div>
            <label for="dificuldade">Dificuldade:</label>
            <select name="dificuldade" id="dificuldade">
                <option value="facil">Fácil</option>
                <option value="medio">Médio</option>
                <option value="dificil">Difícil</option>
                <option value="impossivel">Impossível</option>
            </select>
        </div>
        <button type="submit">Jogar</button>
    </form>
</body>
</html>
