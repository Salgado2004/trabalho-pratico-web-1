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
  $erro = false;

  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if(empty($_POST["email-log"])){
      $erro_email = "Email é obrigatório.";
      $erro = true;
    }
    else if(!filter_var($_POST["email-log"], FILTER_VALIDATE_EMAIL)){
      $erro_email = "Email inválido.";
      $erro = true;
    } 
    else{
      $email = verifica_campo($_POST["email-log"]);
    }
  
    if(empty($_POST["senha-log"])){
      $erro_senha = "Senha é obrigatória.";
      $erro = true;
    }
    else if(strlen($_POST["senha-log"]) < 8){
      $erro_senha = "Senha deve ter pelo menos 8 caracteres.";
      $erro = true;
    }
    else if(!preg_match('@[A-Z]@',$_POST["senha-log"])){
      $erro_senha = "Senha deve ter pelo menos uma letra maiúscula.";
      $erro = true;
    }
    else{
      $senha = verifica_campo($_POST["senha-log"]);
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


