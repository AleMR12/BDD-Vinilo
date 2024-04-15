<?php
// Verificar si se reciben los datos del formulario
if(isset($_POST['id']) && isset($_POST['nombre_artistico']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2'])) {
    // Recoger los datos del formulario
    $artista_id = $_POST['id'];
    $nombre_artistico = $_POST['nombre_artistico'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];

    //Conexion a la BDD
    require('../../Mi-Proyecto/PHP/conexionBDD.php');

    // Actualizar los datos del artista en la base de datos
    $sql = "UPDATE artistas SET Nombre_Artistico='$nombre_artistico', Nombre='$nombre', Apellido1='$apellido1', Apellido2='$apellido2' WHERE ID=$artista_id";

    if ($conexion->query($sql) === TRUE) {
        // Redireccionar a la página de despedida
        header("Location: ../HTML/DespedidaModificarArtistas.html");
        exit();
    } else {
        echo "Error al actualizar los datos del artista: " . $conexion->error;
    }

    // Cerrar conexión
    $conexion->close();
} else {
    echo "No se recibieron los datos del formulario correctamente.";
}
?>
