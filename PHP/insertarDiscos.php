<!-- Ponemos el icono en la ventana -->
<link rel="icon" type="image/x-icon" href="../../Mi-Proyecto/Imagenes/Extras/IsotipoMV.png">
<?php
// Verificar si se recibieron los datos del formulario correctamente
if (
    isset($_FILES['imagen']) &&
    isset($_POST['nombre']) &&
    isset($_POST['descripcion']) &&
    isset($_POST['precio']) &&
    isset($_POST['existencias']) &&
    isset($_POST['enlacespotify']) &&
    isset($_POST['artista'])
) {
    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $existencias = $_POST['existencias'];
    $enlace_spotify = $_POST['enlacespotify'];
    $artista_id = $_POST['artista'];

    // Conexión a la base de datos
    require('../../Mi-Proyecto/PHP/conexionBDD.php');

    // Verificar si se recibió una nueva imagen
    if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Guardar la nueva imagen en la carpeta de destino
        $nombre_imagen = $_FILES['imagen']['name'];
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $carpeta_destino = '../../Mi-Proyecto/Imagenes/BD/';
        $ruta_destino = $carpeta_destino . $nombre_imagen;

        // Mover la imagen a la carpeta de destino
        if (move_uploaded_file($imagen_temp, $ruta_destino)) {
            // Insertar los datos del disco en la base de datos
            $sql = "INSERT INTO discos (Nombre, Descripción, Precio, Existencias, Foto, EnlaceSpotify, ID_Artista) VALUES ('$nombre', '$descripcion', $precio, $existencias, '$ruta_destino', '$enlace_spotify', $artista_id)";

            if ($conexion->query($sql) === TRUE) {
                // Redireccionar a la página de éxito
                header("Location: ../HTML/DespedidaDiscos.html");
                exit();
            } else {
                echo "Error al insertar los datos del disco: " . $conexion->error;
            }
        } else {
            echo "Error al mover el archivo.";
        }
    } else {
        echo "Error al subir la imagen: " . $_FILES['imagen']['error'];
    }

    // Cerrar conexión
    $conexion->close();
} else {
    echo "No se recibieron los datos del formulario correctamente.";
}
?>
