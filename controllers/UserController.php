<?php
// UserController.php

require_once('../models/User.php');
require_once('../config/config.php');

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'login') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User($pdo);
        $result = $user->login($email, $password);

        if ($result) {
            session_start();
            $_SESSION['user_id'] = $result['iduser']; // Guardar el ID del usuario en la sesión
            header('Location: ../views/posts.php'); // Redireccionar a la página de bienvenida
            exit();
        } else {
            echo "Error: Correo electrónico o contraseña incorrectos.";
        }
    } elseif ($action == 'register') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User($pdo);
        $result = $user->register($name, $email, $password);

        if ($result) {
            header('Location: ../views/login.php');
        } else {
            echo "Error al registrar.";
        }
    }
}
?>
