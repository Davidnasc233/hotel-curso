<?php
// editar-quarto.php
include '../includes/db.php'; // ajuste conforme seu projeto

$id = $_POST['id'];
$numero = $_POST['numero'];
$tipo = $_POST['tipo'];
$preco = str_replace(',', '.', $_POST['preco']);
$ativo = $_POST['ativo'];

$stmt = $pdo->prepare("UPDATE quartos SET numero=?, tipo=?, preco=?, ativo=? WHERE id=?");
$sucesso = $stmt->execute([$numero, $tipo, $preco, $ativo, $id]);

echo json_encode(['sucesso' => $sucesso]);