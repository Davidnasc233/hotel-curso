<?php
require_once '../../config/conexao.php';
require_once '../../models/reserva.php';
require_once '../../models/quarto.php';

$reservaModel = new Reserva($pdo);
$reservas = $reservaModel->listar();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/includes.css">
    <link rel="stylesheet" href="../../assets/css/reservations.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include '../includes/header.php'; ?>

    <div class="container-main">
        <div class="sign-room">
            <div class="title">
                <h2>Reservas Cadastradas</h2>
                <a href="./create.php" class="btn btn-success p-0">
                    Novo Quarto
                </a>
            </div>
            <div class="container-form">
                <table cellpadding="8" cellspacing="0">
                    <thead>
                        <tr class="grid-header">
                            <th>ID</th>
                            <th>Quarto</th>
                            <th>Cliente</th>
                            <th>Entrada</th>
                            <th>Saída</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas as $index => $r): ?>
                            <tr class="grid-row <?= $index % 2 === 0 ? 'row-odd' : 'row-even' ?>">
                                <td><?= $r['id'] ?></td>
                                <td>Quarto <?= $r['numero_quarto'] ?> (<?= $r['tipo'] ?>)</td>
                                <td><?= htmlspecialchars($r['nome_cliente']) ?></td>
                                <td><?= date('d/m/Y', strtotime($r['data_checkin'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($r['data_checkout'])) ?></td>
                                <td>
                                    <button class="btn btn-primary action-button"
                                        href="edit.php?id=<?= $r['id'] ?>">Editar</button>
                                    <button class="btn btn-danger action-button" href="delete.php?id=<?= $r['id'] ?>"
                                        onclick="return confirm('Excluir reserva?')">Excluir</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <?php include '../includes/footer.php'; ?>

</body>

</html>