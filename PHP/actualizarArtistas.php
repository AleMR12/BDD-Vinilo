<!-- Ponemos el icono en la ventana -->
<link rel="icon" type="image/x-icon" href="../../Mi-Proyecto/Imagenes/Extras/IsotipoMV.png">

<?php
// Verificar si se reciben los datos del formulario correctamente
if (isset($_POST['id']) && isset($_POST['nombre_artistico']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['descripcion'])) {
    // Recoger los datos del formulario
    $artista_id = $_POST['id'];
    $nombre_artistico = $_POST['nombre_artistico'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $descripcion = $_POST['descripcion'];

    // Conexion a la BDD
    require('../../Mi-Proyecto/PHP/conexionBDD.php');

    // Obtener la ruta de la imagen actual
    $sql_ruta = "SELECT Foto FROM artistas WHERE ID=$artista_id";
    $resultado_ruta = $conexion->query($sql_ruta);

    if ($resultado_ruta->num_rows > 0) {
        $fila = $resultado_ruta->fetch_assoc();
        $ruta_antigua = $fila['Foto'];

        // Verificar si hay una imagen existente y eliminarla
        if (!empty($ruta_antigua)) {
            if (file_exists($ruta_antigua)) {
                unlink($ruta_antigua);
            }
        }

        // Verificar si se recibió una nueva imagen
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            // Guardar la nueva imagen en la carpeta de destino
            $nombre_imagen = $_FILES['imagen']['name'];
            $imagen_temp = $_FILES['imagen']['tmp_name'];
            $carpeta_destino = '../../Mi-Proyecto/Imagenes/BD/';
            $ruta_destino = $carpeta_destino . $nombre_imagen;

            // Mover la imagen a la carpeta de destino
            if (move_uploaded_file($imagen_temp, $ruta_destino)) {
                // Actualizar los datos del artista en la base de datos con la nueva imagen
                $sql = "UPDATE artistas SET Nombre_Artistico='$nombre_artistico', Nombre='$nombre', Apellido1='$apellido1', Apellido2='$apellido2', Descripción='$descripcion', Foto='$ruta_destino' WHERE ID=$artista_id";
            } else {
                echo "Error al mover el archivo.";
                exit(); // Salir del script si hay un error
            }
        } else {
            // Si no se recibió una nueva imagen, solo actualizar los datos sin incluir la imagen en la consulta
            $sql = "UPDATE artistas SET Nombre_Artistico='$nombre_artistico', Nombre='$nombre', Apellido1='$apellido1', Apellido2='$apellido2', Descripción='$descripcion' WHERE ID=$artista_id";
        }

        // Ejecutar la consulta SQL
        if ($conexion->query($sql) === TRUE) {
            // Redireccionar a la página de despedida
            header("Location: ../HTML/DespedidaModificarArtistas.html");
            exit();
        } else {
            echo "Error al actualizar los datos del artista: " . $conexion->error;
        }
    } else {
        echo "No se encontró el artista.";
    }

    // Cerrar conexión
    $conexion->close();
} else {
    echo "No se recibieron los datos del formulario correctamente.";
}
?>
