<?php
// Archivo: db_connection.php

// Datos de conexión a la base de datos
$host = 'localhost';
$port = '3306'; // Cambia este valor al puerto que estés utilizando
$dbname = 'misposts_db';
$username = 'root';
$password = 'root';

try {
    // Crear una nueva conexión PDO
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);

    // Configurar el modo de error de PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Manejar cualquier error de conexión
    die("Error de conexión: " . $e->getMessage());
}
?>
