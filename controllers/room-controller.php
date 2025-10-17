<?php
require_once '../models/Quarto.php';
require_once '../config/conexao.php';

$quartoModel = new Quarto($pdo);

if ($_GET['action'] === 'edit' && isset($_GET['id'])) {
 
}

if ($_POST['action'] === 'delete' && isset($_POST['id'])) {
    $quartoModel->excluir($_POST['id']);
    header('Location: /views/list-rooms.php');
    exit;
}