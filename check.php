<?php 
function verifica_campo($texto){
    $texto = trim($texto);
    $texto = stripslashes($texto);
    $texto = htmlspecialchars($texto);
    return $texto;
  }

function verifica_senha($texto){
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    

}

?>