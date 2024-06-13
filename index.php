<?php
session_start();

// Si el usuario está autenticado, redirigirlo a la página de publicaciones
if (isset($_SESSION['user_id'])) {
    header('Location: views/posts.php');
    exit();
}

// Si no está autenticado, redirigirlo a la página de inicio de sesión
header('Location: views/login.php');
exit();
?>
