<?php
require('database/credentials.php');
require('verifica_campo.php');

$nome = "";
$email = "";
$senha = "";
$senha_conf = "";
$erro = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Create connection
  $conn = mysqli_connect($servername, $username, $password);
  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    $erro = 10;
  }
  $sql = "use $dbname";

  if (!mysqli_query($conn, $sql)) {
    $erro = 11;
  } else {
    if (empty($_POST["nome-cad"])) {
      $erro = 6;
    } else if (empty($_POST["email-cad"])) {
      $erro = 1;
    } else if (!filter_var($_POST["email-cad"], FILTER_VALIDATE_EMAIL)) {
      $erro = 2;
    } else if (empty($_POST["senha-cad"])) {
      $erro = 3;
    } else if (strlen($_POST["senha-cad"]) < 8) {
      $erro = 4;
    } else if (!preg_match('/[A-Z]/', $_POST["senha-cad"])) {
      $erro = 5;
    } else if (empty($_POST["senha-confirm"])) {
      $erro = 7;
    } else if ($_POST["senha-cad"] != $_POST["senha-confirm"]) {
      $erro = 8;
    } else {
      $sql = "SELECT * FROM usuario WHERE email = '" . $_POST["email-cad"] . "'";
      $result = mysqli_query($conn, $sql);
      if ($result) {
        if (mysqli_num_rows($result) > 0) {
          $erro = 12;
        } else {
          $sql = "SELECT * FROM usuario WHERE nome = '" . $_POST["nome-cad"] . "'";
          $result = mysqli_query($conn, $sql);
          if ($result) {
            if (mysqli_num_rows($result) > 0) {
              $erro = 13;
            } else {
              $nome = verifica_campo($conn, $_POST["nome-cad"]);
              $email = verifica_campo($conn, $_POST["email-cad"]);
              $senha = verifica_campo($conn, $_POST["senha-cad"]);
              $senha_conf = verifica_campo($conn, $_POST["senha-confirm"]);

              $sql = "INSERT INTO usuario (nome, email, senha) VALUES ('" . $nome . "', '" . $email . "', '" . md5($senha) . "')";

              if (!mysqli_query($conn, $sql)) {
                $erro = 9;
              }
              $sql = "SELECT id FROM usuario WHERE email = '" . $email . "'";
              if (!mysqli_query($conn, $sql)) {
                die("Error connecting to database: " . mysqli_error($conn) . "<br>");
              } else {
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                  $id = mysqli_fetch_row($result);
                } else {
                  die("Error: " . $sql . "<br>" . mysqli_error($conn));
                }
              }
            }
          }
        }
      }
    }
  }

  mysqli_close($conn);
  if (!$erro) {
    session_start();
    $_SESSION['id_usuario'] = $id[0];
    $_SESSION['nome_usuario'] = $nome;
    $_SESSION['existe_liga'] = false;
    $_SESSION['email_usuario'] = $email;
    $_SESSION['liga_usuario'] = "Sem liga";
    $_SESSION['estiloCarro'] = 1;
    
    header("Location: user/edit_user.php");
  } else {
    header("Location: signup.php/?ec=" . $erro);
  }
}
