<?php
// Configuración de la conexión a la base de datos
$servername = "localhost"; // Cambia esto por tu servidor de base de datos
$username = "root"; // Cambia esto por tu nombre de usuario de MySQL
$password = ""; // Cambia esto por tu contraseña de MySQL
$database = "mundovinilo"; // Cambia esto por el nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$repetircontraseña = $_POST['repetircontraseña'];

// Verificar si las contraseñas coinciden
if ($contraseña !== $repetircontraseña) {
    // Redirigir al formulario de registro otra vez en caso de fallar
    header("Location: ../HTML/InsertarUsuarios.html");
    exit();
}

// Encriptar la contraseña antes de almacenarla en la base de datos
$contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);

// Preparar la consulta SQL
$sql = "INSERT INTO usuarios (Nombre, Apellido1, Apellido2, Correo, Contraseña) VALUES (?, ?, ?, ?, ?)";

// Preparar la declaración
$stmt = $conn->prepare($sql);

// Vincular los parámetros con los valores
$stmt->bind_param("sssss", $nombre, $apellido1, $apellido2, $correo, $contraseña_encriptada);

// Ejecutar la consulta
if ($stmt->execute()) {
    header("Location: ../HTML/DespedidaUsuarios.html");;
} else {
    echo "Error al registrar el usuario: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
