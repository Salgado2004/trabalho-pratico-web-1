<?php
// Inicia a sessão
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
  $_SESSION['nome_usuario'] = $_POST['username'];
  // create a random number
  $_SESSION['estiloCarro'] = rand(1, 6);
  header("Location: home/home.php");
}
