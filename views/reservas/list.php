<?php
require_once '../../config/conexao.php';
require_once '../../models/reserva.php';
require_once '../../models/quarto.php';

$reservaModel = new Reserva($pdo);
$reservas = $reservaModel->listar();
$quartoModel = new Quarto($pdo);
$quartos = $quartoModel->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">

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
                <div class="buttons">
                    <a href="./list-rooms.php" class="btn btn-success">
                        Gerenciamento de Quartos
                    </a>
                    <a href="./create-reservation-form.php" class="btn btn-success">
                        Nova Reserva
                    </a>
                </div>
            </div>
            <div class="container-form">
                <table cellpadding="8" cellspacing="0">
                    <thead>
                        <tr class="grid-header">
                            <th>ID</th>
                            <th>Quarto</th>
                            <th>Cliente</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>CPF</th>
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
                                <td><?= htmlspecialchars($r['email']) ?></td>
                                <td><?= htmlspecialchars($r['telefone']) ?></td>
                                <td><?= htmlspecialchars($r['cpf']) ?></td>
                                <td><?= date('d/m/Y', strtotime($r['data_checkin'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($r['data_checkout'])) ?></td>
                                <td>
                                    <button type="button" class="btn btn-primary action-button btn-edit"
                                        data-id="<?= $r['id'] ?>" data-ativo="<?= isset($r['ativo']) ? $r['ativo'] : 1 ?>"
                                        data-email="<?= htmlspecialchars($r['email']) ?>"
                                        data-telefone="<?= htmlspecialchars($r['telefone']) ?>"
                                        data-checkin="<?= htmlspecialchars($r['data_checkin']) ?>"
                                        data-checkout="<?= htmlspecialchars($r['data_checkout']) ?>"
                                        data-quarto="<?= $r['quarto_id'] ?>"
                                        data-nome="<?= htmlspecialchars($r['nome_cliente']) ?>"
                                        data-cpf="<?= htmlspecialchars($r['cpf']) ?>">Editar</button>
                                    <form method="post" action="../../controllers/reserva-controller.php"
                                        class="delete-reserva-form" style="display:inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                        <button type="button"
                                            class="btn btn-danger action-button btn-excluir-reserva">Excluir</button>
                                    </form>
                                    <!-- Modal de confirmação de exclusão (global, fora da tabela) -->
                                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1"
                                        aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content" style="max-width: 350px">
                                                <div class="modal-header">
                                                    <h5 class="modal-title d-flex align-items-center"
                                                        id="confirmDeleteLabel">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                            fill="#ffc107" class="bi bi-exclamation-triangle-fill me-2"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M8.982 1.566a1.13 1.13 0 0 0-1.964 0L.165 13.233c-.457.778.091 1.767.982 1.767h13.707c.89 0 1.438-.99.982-1.767L8.982 1.566zm-.982 4.905a.905.905 0 1 1 1.81 0l-.35 3.507a.552.552 0 0 1-1.11 0l-.35-3.507zm.002 6.002a1 1 0 1 1 2 0 1 1 0 0 1-2 0z" />
                                                        </svg>
                                                        Confirmar Exclusão
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Fechar"></button>
                                                </div>
                                                <div class="modal-body" id="deleteModalBody">
                                                    Tem certeza que deseja excluir esta reserva?
                                                </div>
                                                <div class="modal-footer d-flex">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="button" class="btn btn-danger"
                                                        id="confirmDeleteBtn">Excluir</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <!-- Modal de sucesso ao editar (fora do #modalWidth para garantir exibição correta) -->
    <div class="modal fade" id="successEditModal" tabindex="-1" aria-labelledby="successEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="max-width: 350px">
                <div class="modal-header">
                    <h5 class="modal-title d-flex align-items-center" id="successEditLabel">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#28a745"
                            class="bi bi-check-circle-fill me-2" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 9.439 6.03 7.97a.75.75 0 1 0-1.06 1.06l1.999 2z" />
                        </svg>
                        Sucesso
                    </h5>
                </div>
                <div class="modal-body">
                    Reserva atualizada com sucesso!
                </div>
            </div>
        </div>
    </div>
    <div id="modalWidth" style="display:none;">
        <div id="editModal">
            <h3 class="title">Edite uma Reserva</h3>
            <hr>
            <form id="editForm">
                <input type="hidden" name="id" id="edit-id">
                <p>Nome:</p>
                <input type="text" name="nome" id="edit-nome" value="" readonly><br>
                <p>Quarto:</p>
                <select name="quarto" id="edit-quarto">
                    <?php foreach ($quartos as $quarto): ?>
                        <option value="<?= $quarto['id'] ?>">
                            <?= htmlspecialchars($quarto['tipo']) ?> -
                            <?= htmlspecialchars($quarto['numero']) ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>
                <p>Email:</p>
                <input type="text" name="email" id="edit-email"><br>
                <p>Telefone:</p>
                <input type="tel" name="telefone" id="edit-telefone"><br>
                <p>Data entrada:</p>
                <input type="date" name="checkin" id="edit-checkin"><br>
                <p>Data saída:</p>
                <input type="date" name="checkout" id="edit-checkout"><br>
                <div class="buttons">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="document.getElementById('modalWidth').style.display='none'">Cancelar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/modules/reservation-list.js"></script>
</body>

</html>