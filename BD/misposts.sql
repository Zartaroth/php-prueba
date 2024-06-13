 CREATE DATABASE misposts_db;
USE misposts_db;

USE misposts_db;

-- Crear la tabla usuario
CREATE TABLE usuario (
    iduser INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

-- Crear la tabla posts con eliminación en cascada
CREATE TABLE posts (
    idpost INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES usuario(iduser) ON DELETE CASCADE
);

-- Crear la tabla comments con eliminación en cascada
CREATE TABLE comments (
    idcomment INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL,
    idpost INT,
    FOREIGN KEY (idpost) REFERENCES posts(idpost) ON DELETE CASCADE
);
