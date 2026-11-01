<?php

function recupera($nombre, $minimo, $maximo) {

    if (!isset($_POST[$nombre])) {
        return false;
    }

    $valor = filter_var($_POST[$nombre], FILTER_VALIDATE_INT);

    if ($valor === false || $valor < $minimo || $valor > $maximo) {
        return false;
    }

    return $valor;
}

?>
