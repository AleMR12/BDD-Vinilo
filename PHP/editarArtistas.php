<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Artista</title>

    <!-- Ponemos el icono en la ventana -->
    <link rel="icon" type="image/x-icon" href="../../Mi-Proyecto/Imagenes/Extras/IsotipoMV.png">

    <!-- Añadimos CSS -->
    <link rel="stylesheet" type="text/css" href="../../Mi-Proyecto/CSS/Reset.css">
    <link rel="stylesheet" type="text/css" href="../CSS/editarDiscos.css">

    <!-- Añadimos Iconos de Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Fuente de Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url(../../Mi-Proyecto/Imagenes/Extras/FondoBDD.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            font-family: 'Montserrat', sans-serif;
        }

        h1 {
            font-size: 48px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            margin-top: 4rem;
            text-align: center;
        }

        /* Estilos para el icono de ir hacia atrás */
        .icon-container {
            position: absolute;
            top: 10px;
            left: 10px;
            color: white;
        }

        .icon-container i {
            transition: color 0.3s ease;
            /* Añade una animación de transición para el cambio de color */
        }

        .icon-container i:hover {
            color: #a62f2f;
            /* Cambia el color al pasar el ratón por encima */
        }

        form {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 1rem;
            border-radius: 10px;
            width: 20rem;
            font-weight: bold;
            margin-top: 1rem;
        }

        input[type="text"],
        input[type="number"]{
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: none;
            background-color: rgba(255, 255, 255, 0.8);
            transition: background-color 0.3s ease;
            color: #000;
            border-radius: 5px;
            margin-bottom: 1rem;
            margin-top: .5rem;
        }

        textarea{

            width: 100%;
            padding: 10px;
            height: 7rem;
            box-sizing: border-box;
            border: none;
            background-color: rgba(255, 255, 255, 0.8);
            transition: background-color 0.3s ease;
            color: #000;
            border-radius: 5px;
            margin-bottom: 1rem;
            margin-top: .5rem;
            resize: none;

        }

        input[type="text"]:hover,
        input[type="number"]:hover,
        textarea:hover {
            background-color: #ffffff;
        }


        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            box-sizing: border-box;
            border: none;
            background-color: #cc3e3e;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #871e1e;
        }
    </style>

</head>

<body>
    <a href="../HTML/Modificar.html">
        <!-- Metemos el icono de ir hacia atrás -->
        <div class="icon-container">
            <i class="material-icons-outlined">arrow_back_ios</i>
        </div>
    </a>

    <?php
    if (isset($_GET['id'])) {
        $artista_id = $_GET['id'];

        //Conexion a la BDD
        require('../../Mi-Proyecto/PHP/conexionBDD.php');

        // Consulta a la base de datos para obtener los datos del artista seleccionado
        $sql = "SELECT * FROM artistas WHERE ID = $artista_id";
        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <h1>Editar Artista</h1>
            <form action="actualizarArtistas.php" method="post">
                <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                Nombre Artístico: <input type="text" name="nombre_artistico" value="<?php echo $row['Nombre_Artistico']; ?>"><br>
                Nombre: <input type="text" name="nombre" value="<?php echo $row['Nombre']; ?>"><br>
                Apellido 1: <input type="text" name="apellido1" value="<?php echo $row['Apellido1']; ?>"><br>
                Apellido 2: <input type="text" name="apellido2" value="<?php echo $row['Apellido2']; ?>"><br>
                <input type="submit" value="Guardar Cambios">
            </form>
    <?php
        } else {
            echo "<h1>No se encontró el artista.</h1>";
        }

        // Cerrar conexión
        $conexion->close();
    } else {
        echo "<h1>ID de artista no especificado.</h1>";
    }
    ?>
</body>

</html>
