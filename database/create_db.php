<?php 
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
    echo "✅ Banco e tabela criados!";
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}