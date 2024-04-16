<?php
// Verificar si se recibieron los datos del formulario correctamente
if (isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['precio']) && isset($_POST['existencias']) && isset($_POST['artista'])) {
    // Recoger los datos del formulario
    $disco_id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $existencias = $_POST['existencias'];
    $artista_id = $_POST['artista'];

    // Verificar si se recibió una nueva imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Guardar la nueva imagen en la carpeta de destino
        $nombre_imagen = $_FILES['imagen']['name'];
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $carpeta_destino = '../../Mi-Proyecto/Imagenes/BD/';
        $ruta_destino = $carpeta_destino . $nombre_imagen;

        // Mover la imagen a la carpeta de destino
        if (move_uploaded_file($imagen_temp, $ruta_destino)) {
            // Actualizar los datos del disco en la base de datos con la nueva imagen y el nuevo artista
            $sql = "UPDATE discos SET Nombre='$nombre', Descripción='$descripcion', Precio=$precio, Existencias=$existencias, Foto='$ruta_destino', ID_Artista=$artista_id WHERE ID=$disco_id";
        } else {
            echo "Error al mover el archivo.";
            exit(); // Salir del script si hay un error
        }
    } else {
        // Actualizar los datos del disco en la base de datos sin cambiar la imagen pero actualizando el artista
        $sql = "UPDATE discos SET Nombre='$nombre', Descripción='$descripcion', Precio=$precio, Existencias=$existencias, ID_Artista=$artista_id WHERE ID=$disco_id";
    }

    // Conexion a la BDD
    require('../../Mi-Proyecto/PHP/conexionBDD.php');

    // Ejecutar la consulta SQL
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
