
<?php

require_once "cabecera.php";

// Comprueba que recibimos datos
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("No se han recibido datos.");
}

// Recoge datos
$nombre = $_POST["nombre"];
$autor = $_POST["autor"];
$isbn = $_POST["isbn"];
$puntuacion = $_POST["puntuacion"];
$genero = $_POST["genero"];

// muestra datos para comprobar
echo "<h2>Datos recibidos:</h2>";

echo "<pre>";
print_r($_POST);
echo "</pre>";

// Conecta con mysql
$conexion = new mysqli(
    $servidor,
    $userBD,
    $passwdBD,
    $nomBD
);

// Comprobar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Comprueba si existe isbn
$sql = "SELECT id FROM libros WHERE isbn = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $isbn);
$stmt->execute();

$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {

    echo "<h2>ERROR: Ya existe un libro con ese ISBN.</h2>";

} else {

    // Insertar el libro
    $sqlInsert = "INSERT INTO libros
    (nombre, autor, isbn, puntuacion, genero)
    VALUES (?, ?, ?, ?, ?)";

    $stmtInsert = $conexion->prepare($sqlInsert);

    $stmtInsert->bind_param(
        "sssis",
        $nombre,
        $autor,
        $isbn,
        $puntuacion,
        $genero
    );

    if ($stmtInsert->execute()) {

        echo "<h2>Libro añadido correctamente.</h2>";

    } else {

        echo "Error al insertar: " . $stmtInsert->error;

    }

    $stmtInsert->close();

}

$stmt->close();
$conexion->close();

?>
