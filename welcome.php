<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigirlo a la página de inicio de sesión
    header('Location: views/login.php');
    exit();
}

// Obtener los datos del usuario de la sesión
$user_id = $_SESSION['user_id'];
// Aquí podrías cargar más datos del usuario desde la base de datos si es necesario

// Puedes usar estos datos para personalizar la página de bienvenida, por ejemplo, mostrar el nombre de usuario
// Si estás utilizando algún sistema de plantillas como Smarty, puedes asignar estos datos a las variables de la plantilla

// Cerrar la sesión (opcional)
// session_destroy();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <!-- Agrega aquí tus estilos CSS, enlaces a bibliotecas, etc. -->
</head>
<body>
    <h1>Bienvenido, Usuario</h1>
    <!-- Aquí puedes agregar más contenido para la página de bienvenida -->
    <a href="logout.php">Cerrar sesión</a> <!-- Enlace para cerrar sesión -->
</body>
</html>
