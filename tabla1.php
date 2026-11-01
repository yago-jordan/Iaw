<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tabla de divisores</title>

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

    for ($divisor = 1; $divisor <= 10; $divisor++) {

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

</body>
</html>
