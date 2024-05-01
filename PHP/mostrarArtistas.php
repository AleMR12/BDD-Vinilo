<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Artistas - Mundo Vinilo</title>

    <!-- Añadimos CSS -->
    <link rel="stylesheet" type="text/css" href="../../Mi-Proyecto/CSS/Reset.css">

    <!-- Ponemos el icono en la ventana -->
    <link rel="icon" type="image/x-icon" href="../../Mi-Proyecto/Imagenes/Extras/IsotipoMV.png">

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
            transition: color 0.3s ease; /* Añade una animación de transición para el cambio de color */
        }

        .icon-container i:hover {
            color: #a62f2f; /* Cambia el color al pasar el ratón por encima */
        }

        .artista-list {
            list-style-type: none;
            padding: 0;
            text-align: center;
            margin-top: 50px;
        }

        .artista-item {
            margin-bottom: 20px;
        }

        .artista-item a {
            text-decoration: none;
            color: white;
            transition: color 0.3s ease;
        }

        .artista-item a:hover {
            color: #a62f2f; /* Cambia el color al pasar el ratón por encima */
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

    <h1>Lista de Artistas</h1>

    <?php
    
    //Conexion a la BDD
    require('../../Mi-Proyecto/PHP/conexionBDD.php');

    // Consulta a la base de datos para obtener los artistas
    $sql = "SELECT * FROM artistas";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos de cada artista
        echo "<ul class='artista-list'>";
        while($row = $result->fetch_assoc()) {
            echo "<li class='artista-item'><a href='editarArtistas.php?id=" . $row["ID"] . "'>" . $row["Nombre_Artistico"] . " - " . $row["Nombre"] . " " . $row["Apellido1"] . " " . $row["Apellido2"] . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "No hay artistas registrados.";
    }

    // Cerrar conexión
    $conexion->close();
    ?>
</body>

</html>
