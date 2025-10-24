<?php
require_once '../models/Quarto.php';
require_once '../config/conexao.php';

$quartoModel = new Quarto($pdo);

if (isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = $_POST['id'];
    $numero = $_POST['numero'];
    $tipo = $_POST['tipo'];
    $preco = $_POST['preco'];
    $ativo = $_POST['ativo'];
    // Adapte se tiver campo descricao
    $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';

    $result = $quartoModel->atualizar($id, $numero, $tipo, $preco, $descricao, $ativo);
    if ($result === true) {
        echo json_encode(['status' => 'ok']);
    } else {
        echo json_encode(['status' => 'erro', 'msg' => $result]);
    }
    exit();
}

if ($_POST['action'] === 'delete' && isset($_POST['id'])) {
    $quartoModel->excluir($_POST['id']);
    header('Location: /projeto-hotel/views/reservas/list-rooms.php');
    exit;
}