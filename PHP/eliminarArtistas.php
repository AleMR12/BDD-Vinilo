<?php
// Verificar si se reciben los datos del formulario
if (isset($_POST['artistas'])) {
    // Recoger los artistas seleccionados
    $artistas_seleccionados = $_POST['artistas'];

    // Verificar si se seleccionaron artistas
    if (empty($artistas_seleccionados)) {
        echo "No se seleccionaron artistas para eliminar.";
    } else {
        // Crear la lista de artistas seleccionados para la consulta SQL
        $lista_artistas = implode(",", $artistas_seleccionados);

        //Conexion a la BDD
        require('../../Mi-Proyecto/PHP/conexionBDD.php');

        // Consulta a la base de datos para eliminar los artistas seleccionados
        $sql = "DELETE FROM artistas WHERE ID IN ($lista_artistas)";

        if ($conexion->query($sql) === TRUE) {
            // Redireccionar a la página de despedida
            header("Location: ../HTML/DespedidaModificarDiscos.html");
        } else {
            echo "Error al eliminar los artistas: " . $conexion->error;
        }

        // Cerrar conexión
        $conexion->close();
    }
} else {
    echo "No se recibieron los datos del formulario correctamente.";
}
