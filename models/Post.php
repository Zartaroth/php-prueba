<?php
// Post.php
class Post
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllPosts()
    {
        $stmt = $this->pdo->query("SELECT posts.idpost, posts.title, posts.description, usuario.name AS user_name
                                   FROM posts
                                   INNER JOIN usuario ON posts.user_id = usuario.iduser");
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Obtener comentarios para cada publicación
        foreach ($posts as &$post) {
            $stmt = $this->pdo->prepare("SELECT description FROM comments WHERE idpost = :idpost");
            $stmt->bindParam(':idpost', $post['idpost']);
            $stmt->execute();
            $post['comments'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $posts;
    }
}
?>
