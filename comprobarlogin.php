
<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once "cabecera.php";

// Comprobar que recibimos datos
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Acceso no permitido.");
}

// Recoger datos del formulario
$nombre = $_POST["nombre"];
$clave = md5($_POST["clave"]);

// Conectar con MySQL
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

// Crear consulta
$sql = "SELECT * FROM usuarios
        WHERE nombre = ? AND clave = ?";

// Preparar consulta
$stmt = $conexion->prepare($sql);

$stmt->bind_param("ss", $nombre, $clave);

// Ejecutar consulta
$stmt->execute();

// Obtener resultado
$resultado = $stmt->get_result();

// Comprobar si existe el usuario
if ($resultado->num_rows > 0) {

    $_SESSION["usuario"] = $nombre;

    echo "<h1>Inicio de sesión correcto</h1>";
    echo "<p>Bienvenido, " .
         htmlspecialchars($nombre) . "</p>";

} else {

    echo "<h1>Error de autenticación</h1>";
    echo "<p>Usuario o contraseña incorrectos.</p>";

}

// Cerrar conexiones
$stmt->close();
$conexion->close();

?>
