<?php
// create_posts.php

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, devolver un error
    http_response_code(403);
    echo json_encode(['error' => 'No autenticado']);
    exit();
}

require_once('config/config.php');

// Obtener el ID del usuario logeado
$user_id = $_SESSION['user_id'];

// Leer la entrada JSON
$input = json_decode(file_get_contents('php://input'), true);
$amount = $input['amount'];
$comments = $input['comments'];

// Crear posts y comentarios
try {
    $pdo->beginTransaction();

    for ($i = 1; $i <= $amount; $i++) {
        $stmt = $pdo->prepare("INSERT INTO posts (title, description, user_id) VALUES (:title, :description, :user_id)");
        $stmt->execute([
            ':title' => "Post $i",
            ':description' => "Descripción del post $i",
            ':user_id' => $user_id
        ]);

        $post_id = $pdo->lastInsertId();

        for ($j = 1; $j <= $comments; $j++) {
            $stmt = $pdo->prepare("INSERT INTO comments (description, idpost) VALUES (:description, :idpost)");
            $stmt->execute([
                ':description' => "Comentario $j para Post $i",
                ':idpost' => $post_id
            ]);
        }
    }

    $pdo->commit();
    http_response_code(200);
    echo json_encode(['message' => 'Posts creados exitosamente']);
} catch (Exception $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(['error' => 'Error al crear posts']);
}
?>
