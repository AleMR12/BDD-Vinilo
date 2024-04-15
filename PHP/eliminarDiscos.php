<?php
// Verificar si se reciben los datos del formulario
if(isset($_POST['discos'])) {
    // Recoger los IDs de los discos a eliminar
    $discos_a_eliminar = $_POST['discos'];

    //Conexion a la BDD
    require('../../Mi-Proyecto/PHP/conexionBDD.php');

    // Eliminar los discos seleccionados de la base de datos
    foreach ($discos_a_eliminar as $disco_id) {
        $sql = "DELETE FROM discos WHERE ID=$disco_id";
        if ($conexion->query($sql) !== TRUE) {
            echo "Error al eliminar el disco con ID $disco_id: " . $conexion->error;
        }
    }

    // Cerrar conexión
    $conexion->close();

    // Redireccionar a la página de éxito
    header("Location: ../HTML/DespedidaEliminarDiscos.html");
    exit();
} else {
    echo "No se recibieron los datos del formulario correctamente.";
}
?>
