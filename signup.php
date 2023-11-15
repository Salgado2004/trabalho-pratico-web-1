<?php
    if(isset($_POST['type-transaction'])){
        echo $_POST['type-transaction'];
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Runner | Login</title>
    <link rel="stylesheet" href="style/fonts.css">
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
    <main>
        <div class="container">
            <form id="login" action="login.php" method="post">
                <legend>Login</legend>
                <div class="form-input">
                    <label for="email-user">Email:</label>
                    <input type="email" name="email-log" id="email-log" placeholder="Seu email aqui">
                </div>
                <div class="form-input">
                    <label for="senha-user">Senha:</label>
                    <input type="password" name="senha-log" id="senha-log" placeholder="Sua senha aqui">
                </div>
                <button type="submit">Entrar</button>
            </form>
            <form id="cadastro" action="cadastro.php" method="post">
                <legend>Cadastro</legend>
                <div class="form-input">
                    <label for="nome-user">Nome do Usuário:</label>
                    <input type="text" name="nome-cad" id="nome-cad" placeholder="Seu apelido aqui">
                    <p class="erro-input"><?php echo $erro_nome; ?></p>
                </div>
                <div class="form-input">
                    <label for="email-user">Email:</label>
                    <input type="email" name="email-cad" id="email-cad" placeholder="Seu email aqui">
                    <p class="erro-input"><?php echo $erro_email; ?></p>
                </div>
                <div class="form-input">
                    <label for="senha-user">Senha:</label>
                    <input type="password" name="senha-cad" id="senha-cad" placeholder="Sua senha aqui">
                    <p class="erro-input"><?php echo $erro_senha; ?></p>
                </div>
                <div class="form-input">
                    <label for="senha-confirm">Confirmar Senha:</label>
                    <input type="password" name="senha-confirm" id="senha-confirm" placeholder="Confirme sua senha aqui">
                    <p class="erro-input"><?php echo $erro_senha_conf; ?></p>
                </div>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>

</body>
</html>