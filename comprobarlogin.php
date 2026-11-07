
<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once "cabecera.php";

// Comprueba que recibimos
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Acceso no permitido.");
}

// Recoge datos del formulario
$nombre = $_POST["nombre"];
$clave = md5($_POST["clave"]);

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

// Crea consulta
$sql = "SELECT * FROM usuarios
        WHERE nombre = ? AND clave = ?";

// Prepara consulta
$stmt = $conexion->prepare($sql);

$stmt->bind_param("ss", $nombre, $clave);

// Ejecuta consulta
$stmt->execute();

// Obtiene resultado
$resultado = $stmt->get_result();

// Comprueba si existe el usuario
if ($resultado->num_rows > 0) {

    $_SESSION["usuario"] = $nombre;

    echo "<h1>Inicio de sesión correcto</h1>";
    echo "<p>Bienvenido, " .
         htmlspecialchars($nombre) . "</p>";

} else {

    echo "<h1>Error de autenticación</h1>";
    echo "<p>Usuario o contraseña incorrectos.</p>";

}


$stmt->close();
$conexion->close();

?>
