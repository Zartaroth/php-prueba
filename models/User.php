<?php
// User.php
class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function login($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email AND password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function register($name, $email, $password)
    {
        $stmt = $this->pdo->prepare("INSERT INTO usuario (name, email, password) VALUES (:name, :email, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        return $stmt->execute();
    }
}
?>
