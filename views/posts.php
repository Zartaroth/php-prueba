<?php
// posts.php

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    // Si no está autenticado, redirigirlo a la página de inicio de sesión
    header('Location: login.php');
    exit();
}

// Incluir configuración de la base de datos y modelo de usuario y posts
require_once('../config/config.php');
require_once('../models/User.php');
require_once('../models/Post.php');

// Obtener el ID del usuario logeado
$user_id = $_SESSION['user_id'];

// Obtener todas las publicaciones
$postModel = new Post($pdo);
$posts = $postModel->getAllPosts();

// HTML de la página
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Publicaciones</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container{
            max-width: 90%;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .container-posts {
            display: flex; /* Cambio a flexbox */
            flex-wrap: wrap; /* Permitir que los elementos fluyan a una nueva línea */
            gap: 30px; /* Espacio entre los elementos */
        }

        .buttons {
            position: fixed;
            top: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
        }

        .buttons button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .buttons button:hover {
            background-color: #0056b3;
        }

        .title {
            color: #fff;
            margin-top: 0;
        }

        .post {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1; /* Ocupar todo el espacio disponible */
            min-width: 300px; /* Ancho mínimo */
        }



        .post h2 {
            margin-top: 0;
        }

        .comments {
            display: none; 
            margin-top: 10px;
            padding-left: 20px;
            border-left: 2px solid #007bff;
        }

        .comment {
            margin-bottom: 10px;
        }

        @media screen and (max-width: 600px) {
            .post {
                min-width: 100%; /* Ancho completo en dispositivos pequeños */
            }
        }

        .post:hover .comments {
    display: block;
}


    </style>
    <script>
        function createPosts(amount, comments) {
            fetch('../create_posts.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ amount: amount, comments: comments })
            }).then(response => {
                if (response.ok) {
                    alert('Posts creados exitosamente');
                    location.reload();
                } else {
                    alert('Error al crear posts');
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="buttons">
            <button onclick="createPosts(50, 10)">Crear 50 posts con 10 comentarios</button>
            <button onclick="createPosts(100, 5)">Crear 100 posts con 5 comentarios</button>
            <button onclick="createPosts(500, 2)">Crear 500 posts con 2 comentarios</button>
        </div>
        <h1 class="title">Lista de Publicaciones</h1>
        <div class="container-posts">
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2><?php echo $post['title']; ?></h2>
                <p><strong>Creado por:</strong> <?php echo $post['user_name']; ?></p>
                <p><?php echo $post['description']; ?></p>
                <div class="comments">
                    <h3>Comentarios:</h3>
                    <?php foreach ($post['comments'] as $comment): ?>
                        <div class="comment">
                            <p><?php echo $comment['description']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
