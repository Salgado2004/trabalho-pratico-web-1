<?php

session_start();
if (!isset($_SESSION['nome_usuario'])) {
    session_destroy();
    header("Location: ../index.html");
}

if ($_GET['scope'] != "geral" && $_GET['scope'] != "liga") {
    header("Location: ../home/home.php");
}

if ($_GET['scope'] == "liga" && !$_SESSION['existe_liga']) {
    echo "<script>window.location.href='error_liga.php';</script>";
}

$pontuations = fopen("../pontuations.json", "r");

$data = json_decode(fread($pontuations, filesize("../pontuations.json")));

$ranking = array();

foreach ($data as $entry) {
    if (isset($ranking[$entry->name])) {
        $ranking[$entry->name] += $entry->points;
    } else {
        $ranking[$entry->name] = $entry->points;
    }
}

arsort($ranking);

$nomeUsuario = $_SESSION['nome_usuario'];
$scope = $_GET['scope'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>World Runner | Ranking</title>

    <link rel="stylesheet" href="../style/fonts.css">
    <link rel="stylesheet" href="../style/ranking.css">
</head>

<body>
    <header>
        <?php if ($scope == "liga") : ?>
            <h1 class="league"><?php echo $nomeLiga; ?></h1>
            <span class="participants"><?php echo $participantes; ?> participantes</span>
        <?php endif; ?>
        <!-- <div class="data">
            <p>Últimos</p>
            <a href="ranking.php?scope=<?php echo $scope; ?>&filter=week" class="<?php if ($filter == 'week') echo "active"; ?>">7 dias</a>
            <a href="ranking.php?scope=<?php echo $scope; ?>&filter=month" class="<?php if ($filter == 'month') echo "active"; ?>">30 dias</a>
        </div> -->
    </header>
    <main>
        <table>
            <tr>
                <th>Posição</th>
                <th>Usuário</th>
                <th>Pontuação</th>
            </tr>
            <?php $posicao = 1;
            foreach ($ranking as $usuario => $points) : ?>
                <tr>
                    <td><?php echo $posicao; ?>º</td>
                    <td>
                        <div class="user">
                            <img class="img_perfil" src="../assets/img/profiles/user<?php echo rand(1, 9); ?>.png" alt="Foto de perfil">
                            <?php echo $usuario; ?>
                        </div>
                    </td>
                    <td><?php echo $points; ?> pts</td>
                </tr>
            <?php $posicao++;
            endforeach; ?>
        </table>
        <?php if ($scope == "liga"): ?>
            <?php if ($criador == $_SESSION['id_usuario']): ?>
                <div class="actions">
                    <a href="../liga/manage_liga.php" class="edit_league">Editar liga</a>
                    <a href="../liga/exclui_liga.php" class="leave_league">Excluir liga</a>
                </div>
            <?php else: ?>
                <a href="../liga/sai_liga.php" class="leave_league">Sair da liga</a>
            <?php endif; ?>
        <?php endif; ?>
    </main>
</body>

</html>