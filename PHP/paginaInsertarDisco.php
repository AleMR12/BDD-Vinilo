<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imagen</title>

    <!-- Añadimos CSS -->
    <link rel="stylesheet" type="text/css" href="../../Mi-Proyecto/CSS/Reset.css">

    <!-- Añadimos Iconos de Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Ponemos el icono en la ventana -->
    <link rel="icon" type="image/x-icon" href="../../Mi-Proyecto/Imagenes/Extras/IsotipoMV.png">

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
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-family: 'Montserrat', sans-serif;
            margin: 4rem 0 4rem 0;
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
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            width: 25rem;
            margin-bottom: 1rem;
        }

        label {
            font-size: 18px;
            font-weight: bold;
            /* Añade más peso a las palabras */
            color: #ffffff;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        textarea,
        input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.814);
            transition: background-color 0.3s ease;
        }

        input[type="text"]:hover,
        input[type="password"]:hover,
        input[type="number"]:hover,
        textarea:hover {

            background-color: #ffffff;

        }

        textarea {
            resize: none;
            /* Deshabilitar el redimensionamiento */
        }

        input[type="file"] {
            display: none;
            /* Ocultamos el input original */
        }

        input[type="file"]:focus+.custom-file-upload {
            border-color: #999;
        }

        input[type="file"]:focus+.custom-file-upload::before {
            border-color: #999;
        }

        h1 {
            font-size: 40px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px;
            margin-top: 5rem;
            text-align: center;
        }

        .custom-file-upload::before {
            content: 'Selecciona tu archivo';
            position: absolute;
            top: 10;
            left: 0;
            right: 0;
            visibility: visible;
        }

        /* Estilos para el contenedor del archivo seleccionado */
        .custom-file-upload {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            text-align: center;
            /* Centra el texto horizontalmente */
        }

        /* Estilos para el texto dentro del contenedor */
        .custom-file-upload span {
            display: inline-block;
            max-width: calc(100% - 20px);
            /* Ajusta el ancho máximo */
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            margin-right: 5px;
            vertical-align: middle;
            /* Centra el texto verticalmente */
        }

        .custom-file-upload.file-selected::before {
            visibility: hidden;
        }

        .custom-file-upload.file-selected span {
            visibility: visible;
        }

        button[type="submit"] {
            width: 100%;
            padding: 12px;
            font-size: 18px;
            background-color: #a62f2f;
            color: white;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #932a2a;
        }

        /* Estilos para el campo de selección de artistas */
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.814);
            transition: background-color 0.3s ease;
        }

        select:hover {
            background-color: #ffffff;
        }
    </style>


</head>

<body>

    <a href="../HTML/Insertar.html" class="icon-container">
        <!-- Metemos el icono de ir hacia atrás -->
        <i class="material-icons-outlined">arrow_back_ios</i>
    </a>
    <div>
        <h1>Insertar Disco</h1> <!-- Movemos el título aquí -->

        <form action="../PHP/insertarDiscos.php" method="post" enctype="multipart/form-data">
            <label for="imagen">Portada del disco:</label>
            <input type="file" name="imagen" id="imagen" aria-label="Archivo" onchange="updateFileName(this)">
            <label class="custom-file-upload" for="imagen"><span></span></label>
            <br>
            <label for="nombre">Nombre del disco:</label>
            <input type="text" name="nombre" id="nombre" required>
            <br><br>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" cols="30" rows="5" required></textarea>
            <br><br>
            <label for="precio">Precio:</label>
            <input type="text" name="precio" id="precio" pattern="\d+(\.\d{1,2})?" title="Debe ser un número decimal válido (p. ej., 10.99)" required>
            <br><br>
            <label for="existencias">Existencias:</label>
            <input type="number" name="existencias" id="existencias" required>
            <br><br>
            <label for="spotify">Link del álbum:</label>
            <input type="text" name="enlacespotify" id="enlace_spotify" placeholder="spotify:album:">
            <br><br>
            <!-- Agregamos el campo de selección de artistas -->
            <label for="artista">Artista:</label>
            <select name="artista" id="artista" required>
                <option value="" disabled selected>Selecciona un artista</option>
                <?php
                // Conexion a la BDD
                require('../../Mi-Proyecto/PHP/conexionBDD.php');

                // Consulta a la base de datos para obtener los artistas
                $sql = "SELECT * FROM artistas";
                $result = $conexion->query($sql);

                if ($result->num_rows > 0) {
                    // Mostrar los artistas en el campo de selección
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['ID'] . "'>" . $row["Nombre_Artistico"] . "</option>";
                    }
                }

                // Cerrar conexión
                $conexion->close();
                ?>
            </select>
            <br><br>
            <button type="submit">Subir</button>
        </form>
    </div>

    <!-- Script para cambiar el nombre de "Seleccciona tu archivo" al nombre del archivo -->
    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var label = input.nextElementSibling.querySelector('span');
            label.textContent = fileName;
            input.nextElementSibling.classList.add('file-selected');
        }
    </script>
</body>

</html>