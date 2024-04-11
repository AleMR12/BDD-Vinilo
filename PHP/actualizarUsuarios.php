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

    //Conexion a la BDD
    require('../../Mi-Proyecto/PHP/conexionBDD.php');

    // Actualizar los datos del usuario en la base de datos con la contraseña hasheada
    $sql = "UPDATE usuarios SET Nombre='$nombre', Apellido1='$apellido1', Apellido2='$apellido2', Correo='$correo', Contraseña='$contraseña_hasheada' WHERE ID=$usuario_id";

    if ($conexion->query($sql) === TRUE) {
        // Redireccionar a la página de despedida
        header("Location: ../HTML/DespedidaModificarUsuarios.html");
        exit();
    } else {
        echo "Error al actualizar los datos del disco: " . $conexion->error;
    }

    // Cerrar conexión
    $conexion->close();
} else {
    echo "No se recibieron los datos del formulario correctamente.";
}
?>
