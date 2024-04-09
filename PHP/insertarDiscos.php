<?php
// Verificar si se ha enviado una imagen
if (isset($_FILES["imagen"])) {
    // Almacenar la información de la imagen
    $nombre_imagen = $_FILES["imagen"]["name"];
    $tipo_imagen = $_FILES["imagen"]["type"];
    $size_imagen = $_FILES["imagen"]["size"];

    // Ruta de la carpeta destino del servidor para la imagen
    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Proyectos/Mi-Proyecto/Imagenes/BD/';

    // Mover el archivo de la carpeta temporal a la carpeta destino
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_destino . $nombre_imagen);

    // Guardar la información en la base de datos
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $existencias = $_POST['existencias'];

    // Conexión a la base de datos
    require('../Mi-Proyecto/PHP/conexionBDD.php');

    // Preparar la consulta SQL para insertar los datos en la tabla discos
    $sql = "INSERT INTO discos (Nombre, Descripción, Precio, Existencias, Foto) 
            VALUES ('$nombre', '$descripcion', $precio, $existencias, '$carpeta_destino$nombre_imagen')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        // Redirigir a la página de despedida
        header("Location: ../HTML/DespedidaDiscos.html");
        exit(); // Finalizar el script para evitar que se ejecute más código después de la redirección
    } else {
        echo "Error al guardar los datos en la base de datos: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
} else {
    echo "No se ha enviado ninguna imagen.";
}
?>
