<?php
require_once '../config/conexao.php';
require_once '../models/quarto.php';

$quartoModel = new Quarto($pdo);

function redirect($url)
{
    header("Location: $url");
    exit();
}

// Rota para listar quartos
if (isset($_GET['action']) && $_GET['action'] === 'list') {
    try {
        $quartos = $quartoModel->listar();
        include 'list-rooms.php';

    } catch (Exception $e) {
        echo "Erro ao listar quartos: " . $e->getMessage();
    }
}

// Rota para exibir formulário de criação
elseif (isset($_GET['action']) && $_GET['action'] === 'create') {
    chdir('../views/reservas');
    include 'create.php';
}

// Rota para página de sucesso
elseif (isset($_GET['action']) && $_GET['action'] === 'success') {
    chdir('../views/reservas');
    include 'sucesso.php';
}

// Rota para processar criação de quarto
elseif (isset($_POST['action']) && $_POST['action'] === 'create') {
    $numero = $_POST['numero'] ?? null;
    $tipo = $_POST['tipo'] ?? null;
    $preco = $_POST['preco'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $ativo = isset($_POST['ativo']) ? 1 : 0;

    if ($numero && $tipo && $preco && $descricao) {
        $result = $quartoModel->create($numero, $tipo, $preco, $descricao, $ativo);

        if ($result === true) {
            redirect('../views/reservas/sucesso.php');
        } else {
            echo "Erro ao criar quarto: " . $result;
        }
    } else {
        redirect('quarto-routes.php?action=create&error=1');
    }
}

else {
    redirect('/views/reservas/list.php');
}
?>