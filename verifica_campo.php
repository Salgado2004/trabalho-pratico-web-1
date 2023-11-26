<?php
function verifica_campo($conn, $texto){
        $texto = trim($texto);
        $texto = stripslashes($texto);
        $texto = htmlspecialchars($texto);
        $texto = mysqli_real_escape_string($conn, $texto);
        return $texto;
    }

?>