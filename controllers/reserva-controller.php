<?php

require_once '../config/conexao.php';
require_once '../models/reserva.php';
require_once '../models/quarto.php';

if (!isset($pdo)) {
    http_response_code(500);
    echo json_encode(['status' => 'erro', 'msg' => 'Erro de configuração: Conexão com o banco de dados ausente.']);
    exit();
}

$reservaModel = new Reserva($pdo);
$quartoModel = new Quarto($pdo); // 0 = inativo

function redirect($url)
{
    header("Location: $url");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {


    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);

    if (!$input || empty($input['quarto_id']) || empty($input['nome_cliente']) || empty($input['email']) || empty($input['data_checkin']) || empty($input['data_checkout'])) {
        error_log('Dados JSON inválidos ou obrigatórios ausentes.');
        http_response_code(400);
        echo json_encode(['status' => 'erro', 'msg' => 'Dados obrigatórios ausentes (quarto, nome, email, datas).']);
        exit();
    }

    if (strtotime($input['data_checkin']) >= strtotime($input['data_checkout'])) {
        error_log('Erro de lógica de datas: check-out antes ou igual ao check-in.');
        http_response_code(400);
        echo json_encode(['status' => 'erro', 'msg' => 'Data de Check-out deve ser posterior à data de Check-in.']);
        exit();
    }


    $dados = [
        'quarto_id' => $input['quarto_id'],
        'nome_cliente' => $input['nome_cliente'],
        'email' => $input['email'],
        'cpf' => $input['cpf'] ?? null,
        'telefone' => $input['telefone'] ?? null,
        'data_checkin' => $input['data_checkin'],
        'data_checkout' => $input['data_checkout'],
        'status' => $input['status'] ?? 'pendente',
        'guests' => $input['guests'] ?? 1,
        'children' => $input['children'] ?? 0,
        'created_at' => date('Y-m-d H:i:s')
    ];

    try {
        $reservaModel->inserir($dados);
        $quartoModel->updateStatusRoom($dados['quarto_id'], 0);
        error_log('Reserva inserida com sucesso!');
        http_response_code(200);
        echo json_encode(['status' => 'ok', 'msg' => 'Reserva criada com sucesso']);
        exit();
    } catch (Exception $e) {
        error_log('Erro ao inserir reserva: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['status' => 'erro', 'msg' => 'Erro interno do servidor ao salvar reserva.']);
        exit();
    }
}

if ($_POST['action'] === 'delete' && isset($_POST['id'])) {
    $reservaModel->remover($_POST['id']);
    header('Location: /projeto-hotel/views/reservas/list.php');
    exit;
}

if (isset($_POST['action']) && $_POST['action'] === 'create') {
    $dados = [
        'quarto_id' => $_POST['quarto_id'] ?? null,
        'nome_cliente' => $_POST['nome_cliente'] ?? null,
        'data_checkout' => $_POST['data_checkout'] ?? null,
        'status' => $_POST['status'] ?? 'pendente',
        'guests' => $_POST['guests'] ?? null,
        'children' => $_POST['children'] ?? null,
        'created_at' => date('Y-m-d H:i:s')
    ];

    if ($dados['quarto_id'] && $dados['nome_cliente'] && $dados['email'] && $dados['cpf'] && $dados['telefone'] && $dados['data_checkin'] && $dados['data_checkout']) {
        $reservaModel->inserir($dados);
        redirect('../views/reservas/sucesso.php');
    } else {
        redirect('reserva-controller.php?action=create&error=1');
    }
} elseif (isset($_GET['action']) && $_GET['action'] === 'create') {
    chdir('../views/reservas');
    include 'create.php';
} else {
    chdir('../views/reservas');
    include 'list.php';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = $_POST['id'] ?? null;
    $quarto_id = $_POST['quarto'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $data_checkin = $_POST['checkin'] ?? null;
    $data_checkout = $_POST['checkout'] ?? null;
    if ($id && $quarto_id && $email && $telefone && $data_checkin && $data_checkout) {
        if (empty($quarto_id)) {
            echo 'erro: quarto vazio';
            exit;
        }
        // Buscar o quarto antigo antes de atualizar
        $reservaAntiga = $reservaModel->buscarPorId($id);
        $quartoAntigo = $reservaAntiga['quarto_id'] ?? null;

        // Se o quarto foi alterado, não passar $id_ignorar (pois não existe reserva com esse id/quarto)
        $conflito = false;
        if ($quartoAntigo == $quarto_id) {
            $conflito = $reservaModel->existeConflito($quarto_id, $data_checkin, $data_checkout, $id);
        } else {
            $conflito = $reservaModel->existeConflito($quarto_id, $data_checkin, $data_checkout);
        }
        if ($conflito) {
            echo 'erro: conflito';
            exit;
        }

        $dados = [
            'quarto_id' => $quarto_id,
            'email' => $email,
            'telefone' => $telefone,
            'data_checkin' => $data_checkin,
            'data_checkout' => $data_checkout,
            'status' => 'pendente',
            'guests' => 1,
            'children' => 0
        ];
        try {
            $reservaModel->atualizar($id, $dados);
        } catch (Exception $e) {
            echo 'erro: ' . $e->getMessage();
            exit;
        }

        // Marcar o novo quarto como inativo e o antigo como ativo (se mudou)
        if ($quartoAntigo && $quartoAntigo != $quarto_id) {
            $quartoModel->updateStatusRoom($quartoAntigo, 1); // Ativo
            $quartoModel->updateStatusRoom($quarto_id, 0);    // Inativo
        }

        echo 'ok';
    } else {
        echo 'erro';
    }
    exit;
}

