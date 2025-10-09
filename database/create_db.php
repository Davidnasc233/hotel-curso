<?php 
require_once '../config/conexao.php';

try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS hotel");
    $pdo->exec("USE hotel");

    $sql = "CREATE TABLE IF NOT EXISTS reservas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        checkin DATE NOT NULL,
        checkout DATE NOT NULL,
        room VARCHAR(50) NOT NULL,
        guests VARCHAR(100) NOT NULL,
        children INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $pdo->exec($sql);
    
    // Criar tabela quartos
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
    echo "✅ Banco e tabelas criadas!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}