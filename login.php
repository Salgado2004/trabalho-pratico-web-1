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
      require("database/credentials.php");
      $conn = mysqli_connect($servername, $username, $password, $dbname);
      if (!$conn) {
        die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
      }

      $sql = "use $dbname";
      if (!mysqli_query($conn, $sql)) {
        echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
      }

      $sql = "SELECT * FROM usuario WHERE email = '$email'";
      if (mysqli_query($conn, $sql)) {
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);
          if (md5($senha)== $row['senha']) {
            $nome = $row['nome'];
            $liga = $row['fk_liga'];
            $existe_liga = false;
            if ($liga != NULL) {
              $existe_liga = true;
            }
            session_start();
            $_SESSION['id_usuario'] = $row['id'];
            $_SESSION['nome_usuario'] = $nome;
            $_SESSION['existe_liga'] = $existe_liga;
            $_SESSION['email_usuario'] = $email;
            $_SESSION['liga_usuario'] = $liga;
            $_SESSION['estiloCarro'] = $row['carro'];
            header("Location: home/home.php");
          }
          else {
            $erro = 4;
            echo "Senha incorreta";
          }
        }
        else {
          $erro = 5;
          echo "Email não cadastrado";
        }
      }
      else {
        echo "Error connecting to database: " . mysqli_error($conn) . "<br>";
      }
    } else {
      header("Location: signup.php?el=" . $erro);
    }
}

?>