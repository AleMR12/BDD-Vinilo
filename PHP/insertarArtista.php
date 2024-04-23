<?php
// Verificar si se reciben los datos del formulario
if (isset($_POST['nombre_artistico']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2'])) {
    // Recoger los datos del formulario
    $nombre_artistico = $_POST['nombre_artistico'];
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    // Almacenar la información de la imagen
    $nombre_imagen = $_FILES["imagen"]["name"];
    $tipo_imagen = $_FILES["imagen"]["type"];
    $size_imagen = $_FILES["imagen"]["size"];

    // Ruta de la carpeta destino relativa a $_SERVER['DOCUMENT_ROOT']
    $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Proyectos/Mi-Proyecto/Imagenes/BD/';

    // Mover el archivo de la carpeta temporal a la carpeta destino
    move_uploaded_file($_FILES["imagen"]["tmp_name"], $carpeta_destino . $nombre_imagen);


    //Conexion a la BDD
    require('../../Mi-Proyecto/PHP/conexionBDD.php');

    // Insertar el nuevo artista en la base de datos
    $sql = "INSERT INTO artistas (Nombre_Artistico, Nombre, Apellido1, Apellido2, Foto) VALUES ('$nombre_artistico', '$nombre', '$apellido1', '$apellido2', '$carpeta_destino$nombre_imagen')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: ../HTML/DespedidaArtistas.html");
    } else {
        echo "Error al insertar el nuevo artista: " . $conexion->error;
    }

    // Cerrar conexión
    $conexion->close();
} else {
    echo "No se recibieron los datos del formulario correctamente.";
}
