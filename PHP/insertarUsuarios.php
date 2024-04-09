<?php

// Conexión a la base de datos
require('../Mi-Proyecto/PHP/conexionBDD.php');

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
    header("Location: ../HTML/errorContraseñaUsuarios.html");
    exit();
}

// Verificar si ya existe un usuario con el mismo correo electrónico
$sql_check_email = "SELECT COUNT(*) AS count FROM usuarios WHERE Correo = ?";
$stmt_check_email = $conn->prepare($sql_check_email);
$stmt_check_email->bind_param("s", $correo);
$stmt_check_email->execute();
$result_check_email = $stmt_check_email->get_result();
$count = $result_check_email->fetch_assoc()['count'];

if ($count > 0) {
    // Si el correo ya está en uso, redirigir al formulario con un mensaje de error
    header("Location: ../HTML/errorCorreoUsuarios.html");
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
    header("Location: ../HTML/DespedidaUsuarios.html");
} else {
    echo "Error al registrar el usuario: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
