<?php

include 'recupera.php';

$numero1 = recupera("numero1", 1, 10);
$numero2 = recupera("numero2", 10, 20);

if ($numero1 === false || $numero2 === false || $numero1 > $numero2) {
    die("Error: introduce valores válidos.");
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla dinámica</title>

    <style>
        table {
            border-collapse: collapse;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #b98bdc;
        }

        .cabecera {
            background-color: #7777ff;
        }

        .fila1 {
            background-color: #fff2cc;
        }

        .fila2 {
            background-color: #fce0b2;
        }
    </style>
</head>

<body>

<h2 style="text-align:center;">Tabla de divisores del 50 al 60</h2>

<table>

    <tr>
        <th class="cabecera"></th>

        <?php
        for ($numero = 50; $numero <= 60; $numero++) {
            echo "<th>$numero</th>";
        }
        ?>

    </tr>

    <?php

    for ($divisor = $numero1; $divisor <= $numero2; $divisor++) {

        $clase = ($divisor % 2 == 0) ? "fila2" : "fila1";

        echo "<tr>";
        echo "<th>$divisor</th>";

        for ($numero = 50; $numero <= 60; $numero++) {

            if ($numero % $divisor == 0) {
                echo "<td class='$clase'>*</td>";
            } else {
                echo "<td class='$clase'>-</td>";
            }

        }

        echo "</tr>";
    }

    ?>

</table>

<br>

<p style="text-align:center;">
    <a href="tabla1.html">Volver al formulario</a>
</p>

</body>
</html>
