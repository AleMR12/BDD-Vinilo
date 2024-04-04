    <?php
    // Establecer la conexión con la base de datos
    $servername = "localhost"; // Cambia esto por el nombre de tu servidor de base de datos
    $username = "root"; // Cambia esto por tu nombre de usuario de la base de datos
    $password = ""; // Cambia esto por tu contraseña de la base de datos
    $dbname = "mundovinilo"; // Cambia esto por el nombre de tu base de datos

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Comprobar la conexión
    if ($conn->connect_error) {
        die("Error en la conexión: " . $conn->connect_error);
    }

    // Verifica si el formulario ha sido enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $contrasena = $_POST['contrasena'];

    // Consulta SQL para obtener la contraseña del usuario
    $sql = "SELECT Contraseña FROM usuarios WHERE Nombre = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener la contraseña de la base de datos
        $row = $result->fetch_assoc();
        $password_from_db = $row['Contraseña'];
        
        // Verificar si la contraseña proporcionada coincide con la contraseña en la base de datos
        if ($usuario == 'root' && $contrasena == 'root') {
            // Redirige a SeleccionaOpcion.html
            header("Location: ../HTML/SeleccionaOpcion.html");
            exit();
        } else {
            // Contraseña incorrecta, redirige a Index.html
            header("Location: ../HTML/Index.html");
            exit();
        }
    } else {
        // Usuario no encontrado en la base de datos, redirige a Index.html
        header("Location: ../HTML/Index.html");
        exit();
    }
    }

    // Cerrar conexión
    $conn->close();
    ?>
