<?php
// Verificar si se reciben los datos del formulario
if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['existencias'])) {
    // Recoger los datos del formulario
    $disco_id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $existencias = $_POST['existencias'];

    //Conexion a la BDD
    require('../../Mi-Proyecto/PHP/conexionBDD.php');

    // Actualizar los datos del disco en la base de datos
    $sql = "UPDATE discos SET Nombre='$nombre', Descripción='$descripcion', Precio=$precio, Existencias=$existencias WHERE ID=$disco_id";

    if ($conexion->query($sql) === TRUE) {
        // Redireccionar a la página de despedida
        header("Location: ../HTML/DespedidaModificarDiscos.html");
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
