<?php
// Verificar si se reciben los datos del formulario
if(isset($_POST['usuarios'])) {
    // Recoger los IDs de los usuarios a eliminar
    $usuarios_a_eliminar = $_POST['usuarios'];

    //Conexion a la BDD
    require('../../Mi-Proyecto/PHP/conexionBDD.php');

    // Eliminar los usuarios seleccionados de la base de datos
    foreach ($usuarios_a_eliminar as $usuario_id) {
        $sql = "DELETE FROM usuarios WHERE ID=$usuario_id";
        if ($conexion->query($sql) !== TRUE) {
            echo "Error al eliminar el usuario con ID $usuario_id: " . $conexion->error;
        }
    }

    // Cerrar conexión
    $conexion->close();

    // Redireccionar a la página de éxito
    header("Location: ../HTML/DespedidaEliminarUsuarios.html");
    exit();
} else {
    echo "No se recibieron los datos del formulario correctamente.";
}
?>
