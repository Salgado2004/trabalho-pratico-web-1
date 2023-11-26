<?php
    if(isset($_POST['type-transaction'])){
        echo $_POST['type-transaction'];
    }
    $erros = ["", 
            "Email é obrigatório.", 
            "Email inválido.", 
            "Senha é obrigatória.", 
            "Senha deve ter pelo menos 8 caracteres.",
            "Senha deve ter pelo menos uma letra maiúscula.",
            "Nome é obrigatório.",
            "Confirmação de senha é obrigatória.",
            "Confirmação de senha deve ser igual à senha.",
            "Erro ao criar usuário.",
            "Erro ao selecionar banco de dados.",
            "Erro ao acessar banco de dados.",
            "Email já cadastrado.",
            "Nome de usuário já cadastrado"
        ];

    if (isset($_GET['e'])){
        $erro_log = $_GET['e'];
    }
    if (isset($_GET['E'])){
        $erro_cad = $_GET['E'];
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
                <?php if (isset($erro_log)):?>
                <p class="erro-input"><?php echo $erros[$erro_log]; ?></p>
                <?php endif; ?>
                <button type="submit">Entrar</button>
            </form>
            <form id="cadastro" action="cadastro.php" method="post">
                <legend>Cadastro</legend>
                <div class="form-input">
                    <label for="nome-user">Nome do Usuário:</label>
                    <input type="text" name="nome-cad" id="nome-cad" placeholder="Seu apelido aqui">
                </div>
                <div class="form-input">
                    <label for="email-user">Email:</label>
                    <input type="email" name="email-cad" id="email-cad" placeholder="Seu email aqui">
                </div>
                <div class="form-input">
                    <label for="senha-user">Senha:</label>
                    <input type="password" name="senha-cad" id="senha-cad" placeholder="Sua senha aqui">
                </div>
                <div class="form-input">
                    <label for="senha-confirm">Confirmar Senha:</label>
                    <input type="password" name="senha-confirm" id="senha-confirm" placeholder="Confirme sua senha aqui">
                </div>
                <?php if (isset($erro_cad)):?>
                <p class="erro-input"><?php echo $erros[$erro_cad]; ?></p>
                <?php endif; ?>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </main>
    <footer>
        &copy; TADS UFPR 2023;
    </footer>

</body>
</html>