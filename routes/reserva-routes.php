<?php
require_once '../config/conexao.php';
require_once '../models/reserva.php';
require_once '../models/quarto.php';

$reservaModel = new Reserva($pdo);
$quartoModel = new Quarto($pdo);

function redirect($url)
{
    header("Location: $url");
    exit();
}

// Listar reservas
if (isset($_GET['action']) && $_GET['action'] === 'list') {
    $reservas = $reservaModel->listar();
    $quartos = $quartoModel->listar();
    include '../views/reservas/list.php';
    exit;
}
// Exibir formulário de criação
elseif (isset($_GET['action']) && $_GET['action'] === 'create') {
    $quartos = $quartoModel->listar();
    include '../views/reservas/create-reservation-form.php';
    exit;
}
// Processar criação de reserva
elseif (isset($_POST['action']) && $_POST['action'] === 'create') {
    $dados = [
        'quarto_id' => $_POST['quarto_id'] ?? null,
        'nome_cliente' => $_POST['nome_cliente'] ?? null,
        'email' => $_POST['email'] ?? null,
        'cpf' => $_POST['cpf'] ?? null,
        'telefone' => $_POST['telefone'] ?? null,
        'data_checkin' => $_POST['data_checkin'] ?? null,
        'data_checkout' => $_POST['data_checkout'] ?? null,
        'status' => $_POST['status'] ?? 'pendente',
        'guests' => $_POST['guests'] ?? null,
        'children' => $_POST['children'] ?? null,
        'created_at' => date('Y-m-d H:i:s')
    ];
    if ($dados['quarto_id'] && $dados['nome_cliente'] && $dados['email'] && $dados['cpf'] && $dados['telefone'] && $dados['data_checkin'] && $dados['data_checkout']) {
        $reservaModel->inserir($dados);
        redirect('../views/reservas/sucesso-reserva.php');
    } else {
        redirect('reserva-routes.php?action=create&error=1');
    }
}
// Excluir reserva
elseif (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['id'])) {
    $reservaModel->remover($_POST['id']);
    redirect('reserva-routes.php?action=list');
}
// Página de sucesso
elseif (isset($_GET['action']) && $_GET['action'] === 'success') {
    include '../views/reservas/sucesso-reserva.php';
    exit;
}
// Fallback: listar reservas
else {
    $reservas = $reservaModel->listar();
    $quartos = $quartoModel->listar();
    include '../views/reservas/list.php';
    exit;
}
