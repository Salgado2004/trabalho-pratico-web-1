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
  $erro = 0;

  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    if(empty($_POST["email-log"])){
      $erro = 1;
    }
    else if(!filter_var($_POST["email-log"], FILTER_VALIDATE_EMAIL)){
      $erro = 2;
    }
    else if(empty($_POST["senha-log"])){
      $erro = 3;
    }
    else{
      $email = verifica_campo($_POST["email-log"]);
      $senha = verifica_campo($_POST["senha-log"]);
    }

    if (!$erro) {  
        session_start();
        $_SESSION['nome_usuario'] = "User";
        $_SESSION['existe_liga'] = false;
        $_SESSION['email_usuario'] = $_POST['email-user'];
        $_SESSION['liga_usuario'] = "Sem liga";
        header("Location: user/edit_user.php");}
    else {
        header("Location: signup.php/?e=" . $erro);
    }
}

?>