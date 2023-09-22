CREATE DATABASE IF NOT EXISTS dbArlock;

USE dbArlock;

CREATE TABLE usuarios (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    rm INT NULL UNIQUE,
    curso VARCHAR(100) NULL,
    type VARCHAR(20) NOT NULL,
    status BOOLEAN NOT NULL
);

-- INSERT INTO usuarios (nome, email, senha, rm, curso, type, status)
-- VALUES ('John', 'Jhon@Deo.com', 'Senha123.teste', 22777, 'Ciência da Computação', 'aluno', 1);
