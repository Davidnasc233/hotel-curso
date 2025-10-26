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
                <a href="./create.php" class="btn btn-success">
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
                                        style="display:inline;" onsubmit="return confirm('Excluir reserva?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= $r['id'] ?>">
                                        <button type="submit" class="btn btn-danger action-button">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div id="modalWidth" style="display:none;">
        <div id="editModal">
            <h3 class="title">Edite uma Reserva</h3>
            <hr>
            <form id="editForm">
                <input type="hidden" name="id" id="edit-id">
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


    <script>
        // Abrir modal e preencher campos ao clicar em Editar
        document.querySelectorAll('.btn-edit').forEach(function (btn) {
            btn.addEventListener('click', function () {
                document.getElementById('modalWidth').style.display = 'block';
                document.getElementById('edit-id').value = this.dataset.id;
                document.getElementById('edit-email').value = this.dataset.email;
                document.getElementById('edit-telefone').value = this.dataset.telefone;
                document.getElementById('edit-checkin').value = this.dataset.checkin ? this.dataset.checkin.substring(0, 10) : '';
                document.getElementById('edit-checkout').value = this.dataset.checkout ? this.dataset.checkout.substring(0, 10) : '';
                // Selecionar o quarto correto na modal, se disponível
                if (this.dataset.quarto) {
                    document.getElementById('edit-quarto').value = this.dataset.quarto;
                }
            });
        });


        // Submit do formulário de edição com tratamento de resposta
        document.getElementById('editForm').addEventListener('submit', function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('action', 'edit');

            fetch('../../controllers/reserva-controller.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === 'ok') {
                        alert('Reserva atualizada com sucesso!');
                        location.reload();
                    } else if (data.trim() === 'erro: conflito') {
                        alert('Conflito: Este quarto já está reservado para o período selecionado.');
                    } else {
                        alert('Erro ao atualizar reserva.');
                    }
                })
                .catch(error => {
                    alert('Erro ao atualizar reserva.');
                    console.error(error);
                });
        });

    </script>
</body>

</html>