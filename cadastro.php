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
      $erro = 6;
    }else if(empty($_POST["email-cad"])){
      $erro = 1;
    }
    else if(!filter_var($_POST["email-cad"], FILTER_VALIDATE_EMAIL)){
      $erro = 2;
    } 
    else if(empty($_POST["senha-cad"])){
      $erro = 3;
    }
    else if(strlen($_POST["senha-cad"]) < 8){
      $erro = 4;
    }
    else if(!preg_match('@[A-Z]@',$_POST["senha-cad"])){
      $erro = 5;
    }
    else if(empty($_POST["senha-confirm"])){
      $erro = 7;
    }
    else if($_POST["senha"] != $_POST["senha-conf"]){
      $erro = 8;
    }
    else{
      $nome = verifica_campo($_POST["nome-cad"]);
      $email = verifica_campo($_POST["email-cad"]);
      $senha = verifica_campo($_POST["senha-cad"]);
      $senha_conf = verifica_campo($_POST["senha-conf"]);
    }
    

    if (!$erro) {  
        session_start();
        $_SESSION['nome_usuario'] = "User";
        header("Location: user/edit_user.php");}
    else {
        header("Location: signup.php/?E=" . $erro);
    }
  }


?>