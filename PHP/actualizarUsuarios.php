<?php
// Verificar si se reciben los datos del formulario
if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['correo']) && isset($_POST['contraseña'])) {
    // Recoger los datos del formulario
    $usuario_id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : null;
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    // Hashear la contraseña
    $contraseña_hasheada = password_hash($contraseña, PASSWORD_DEFAULT);

    // Conexión a la base de datos
    $servername = "localhost"; // Cambia esto por tu servidor de base de datos
    $username = "root"; // Cambia esto por tu nombre de usuario de MySQL
    $password = ""; // Cambia esto por tu contraseña de MySQL
    $database = "mundovinilo"; // Cambia esto por el nombre de tu base de datos

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("La conexión ha fallado: " . $conn->connect_error);
    }

    // Actualizar los datos del usuario en la base de datos con la contraseña hasheada
    $sql = "UPDATE usuarios SET Nombre='$nombre', Apellido1='$apellido1', Apellido2='$apellido2', Correo='$correo', Contraseña='$contraseña_hasheada' WHERE ID=$usuario_id";

    if ($conn->query($sql) === TRUE) {
        echo "Los datos del usuario se han actualizado correctamente.";
    } else {
        echo "Error al actualizar los datos del usuario: " . $conn->error;
    }

    // Cerrar conexión
    $conn->close();
} else {
    echo "No se recibieron los datos del formulario correctamente.";
}
?>
