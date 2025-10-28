<?php
require_once '../config/conexao.php';

try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS hotel");
    $pdo->exec("USE hotel");


    $sql = "CREATE TABLE IF NOT EXISTS reservas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        quarto_id INT NOT NULL,
        nome_cliente VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        cpf VARCHAR(20),
        telefone VARCHAR(20),
        data_checkin DATE NOT NULL,
        data_checkout DATE NOT NULL,
        status VARCHAR(20) DEFAULT 'pendente',
        guests INT DEFAULT 1,
        children INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (quarto_id) REFERENCES quartos(id)
    )";

    $pdo->exec($sql);

    $sql_quartos = "CREATE TABLE IF NOT EXISTS quartos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        numero VARCHAR(10) NOT NULL UNIQUE,
        tipo VARCHAR(50) NOT NULL,
        preco DECIMAL(10,2) NOT NULL,
        descricao TEXT,
        ativo TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql_quartos);

    $sql_usuarios = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(100) NOT NULL UNIQUE,
        senha VARCHAR(255) NOT NULL,
        nome VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql_usuarios);

    $adminEmail = 'admin@admin.com';
    $adminNome = 'Administrador';
    $adminSenha = password_hash('admin', PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
    $stmt->execute([$adminEmail]);
    if ($stmt->fetchColumn() == 0) {
        $stmt = $pdo->prepare("INSERT INTO usuarios (email, senha, nome) VALUES (?, ?, ?)");
        $stmt->execute([$adminEmail, $adminSenha, $adminNome]);
        echo "\nUsuário admin padrão criado: admin@admin.com / senha: admin";
    }

    echo "✅ Banco e tabelas criadas!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}