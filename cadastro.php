<?php
function verifica_campo($texto){
    $texto = trim($texto);
    $texto = stripslashes($texto);
    $texto = htmlspecialchars($texto);
    return $texto;
  }
  
  $nome = "";
  $email = "";
  $senha = "";
  $senha_conf = "";
  $erro = false;
  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if(empty($_POST["nome-cad"])){
      $erro_nome = "Nome é obrigatório.";
      $erro = true;
    }
    else{
      $nome = verifica_campo($_POST["nome-cad"]);
    }
  
    if(empty($_POST["email-cad"])){
      $erro_email = "Email é obrigatório.";
      $erro = true;
    }
    else if(!filter_var($_POST["email-cad"], FILTER_VALIDATE_EMAIL)){
      $erro_email = "Email inválido.";
      $erro = true;
    } 
    else{
      $email = verifica_campo($_POST["email-cad"]);
    }
  
    if(empty($_POST["senha-cad"])){
      $erro_senha = "Senha é obrigatória.";
      $erro = true;
    }
    else if(strlen($_POST["senha-cad"]) < 8){
      $erro_senha = "Senha deve ter pelo menos 8 caracteres.";
      $erro = true;
    }
    else if(!preg_match('@[A-Z]@',$_POST["senha-cad"])){
      $erro_senha = "Senha deve ter pelo menos uma letra maiúscula.";
      $erro = true;
    }
    else{
      $senha = verifica_campo($_POST["senha-cad"]);
    }
  
    if(empty($_POST["senha-confirm"])){
      $erro_senha_conf = "Confirmação de senha é obrigatória.";
      $erro = true;
    }
    else if($_POST["senha"] != $_POST["senha-conf"]){
      $erro_senha_conf = "Confirmação de senha deve ser igual à senha.";
      $erro = true;
    }
    else{
      $senha_conf = verifica_campo($_POST["senha-conf"]);
    }

    if (!$erro) {  
        session_start();
        $_SESSION['nome_usuario'] = "User";
        header("Location: user/edit_user.php");}
    else {
        header("Location: signup.php");
    }
  }


?>