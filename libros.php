
<?php

require_once "cabecera.php";

$conexion = new mysqli($servidor, $userBD, $passwdBD, $nomBD);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if (isset($_POST["puntuacion"]) && $_POST["puntuacion"] !== "") {

    $puntuacion = $_POST["puntuacion"];

    $sql = "SELECT * FROM libros WHERE puntuacion = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $puntuacion);
    $stmt->execute();

    $resultado = $stmt->get_result();

} else {

    $sql = "SELECT * FROM libros";

    $resultado = $conexion->query($sql);

}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Biblioteca - Libros</title>
</head>

<body>

    <h1>Biblioteca</h1>

    <h2>Buscar libros</h2>

    <form action="libros.php" method="POST">

        <table border="1" cellpadding="8">

            <tr>
                <th>Nombre</th>
                <th>Autor</th>
                <th>ISBN</th>
                <th>Puntuación</th>
                <th>Género</th>
            </tr>

            <tr>
                <td><input type="text" name="nombre"></td>
                <td><input type="text" name="autor"></td>
                <td><input type="text" name="isbn"></td>

                <td>
                    <select name="puntuacion">
                        <option value="">Todas</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </td>

                <td><input type="text" name="genero"></td>
            </tr>

        </table>

        <br>

        <input type="submit" value="Buscar">

    </form>

    <h2>Listado de libros</h2>

    <table border="1" cellpadding="8">

        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Autor</th>
            <th>ISBN</th>
            <th>Puntuación</th>
            <th>Género</th>
        </tr>

        <?php

        if ($resultado->num_rows > 0) {

            while ($fila = $resultado->fetch_assoc()) {

                echo "<tr>";

                echo "<td>" . htmlspecialchars($fila["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["autor"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["isbn"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["puntuacion"]) . "</td>";
                echo "<td>" . htmlspecialchars($fila["genero"]) . "</td>";

                echo "</tr>";

            }

        } else {

            echo "<tr><td colspan='6'>No se han encontrado libros.</td></tr>";

        }

        ?>

    </table>

</body>
</html>

<?php

if (isset($stmt)) {
    $stmt->close();
}

$conexion->close();

?>
