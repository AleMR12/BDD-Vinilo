<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios - Mundo Vinilo</title>

    <!-- Añadimos CSS -->
    <link rel="stylesheet" type="text/css" href="../../Mi-Proyecto/CSS/Reset.css">

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

        .usuario-list {
            list-style-type: none;
            padding: 0;
            text-align: center;
            margin-top: 50px;
        }

        .usuario-item {
            margin-bottom: 20px;
        }

        .usuario-item a {
            text-decoration: none;
            color: white;
            transition: color 0.3s ease;
        }

        .usuario-item a:hover {
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

    <h1>Lista de Usuarios</h1>

    <?php
    // Conexión a la base de datos
    $servername = "localhost"; // Cambia esto por tu servidor de base de datos
    $username = "root"; // Cambia esto por tu nombre de usuario de MySQL
    $password = ""; // Cambia esto por tu contraseña de MySQL
    $database = "mundovinilo"; // Cambia esto por el nombre de tu base de datos

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("La conexión ha fallado: " . $conn->connect_error);
    }

    // Consulta a la base de datos para obtener los usuarios
    $sql = "SELECT * FROM usuarios";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Mostrar los datos de cada usuario
        echo "<ul class='usuario-list'>";
        while($row = $result->fetch_assoc()) {
            echo "<li class='usuario-item'><a href='editarUsuarios.php?id=" . $row["ID"] . "'>" . $row["Nombre"] . " " . $row["Apellido1"] . " - " . $row["Correo"] . "</a></li>";
        }
        echo "</ul>";
    } else {
        echo "No hay usuarios registrados.";
    }

    // Cerrar conexión
    $conn->close();
    ?>
</body>

</html>
