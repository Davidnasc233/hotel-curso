<?php
// Verificar se a variável existe, se não, buscar os dados
if (!isset($quartos)) {
    require_once '../../config/conexao.php';
    require_once '../../models/quarto.php';
    $quartoModel = new Quarto($pdo);
    $quartos = $quartoModel->listar();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/includes.css">
    <link rel="stylesheet" href="../../assets/css/reservations.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="container-main" style="justify-content: initial;">
        <div class="sign-room">
            <div class="title">
                <h1>Lista de Quartos</h1>
                <div class="buttons">
                    <a href="./list.php" class="btn btn-success">
                        Gerenciamento de Reservas
                    </a>
                    <a href="./create.php" class="btn btn-success">
                        Novo Quarto
                    </a>
                </div>
            </div>
            <div class="container-form">
                <table cellpadding="8" cellspacing="0">
                    <thead>
                        <tr class="grid-header-2">
                            <th>Id</th>
                            <th>Número</th>
                            <th>Tipo</th>
                            <th>Preço</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($quartos)): ?>
                            <tr>
                                <td colspan="6" style="text-align: center; padding: 20px;">
                                    Nenhum quarto cadastrado
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($quartos as $index => $quarto): ?>
                                <tr class="grid-row-2 <?= $index % 2 === 0 ? 'row-odd' : 'row-even' ?>"
                                    data-id="<?= $quarto['id'] ?>">
                                    <td><?= htmlspecialchars($quarto['id']) ?></td>
                                    <td data-field="numero"><?= htmlspecialchars($quarto['numero']) ?></td>
                                    <td data-field="tipo"><?= htmlspecialchars($quarto['tipo']) ?></td>
                                    <td data-field="preco">
                                        R$
                                        <?= isset($quarto['preco']) ? number_format($quarto['preco'], 2, ',', '.') : '0,00' ?>
                                    </td>
                                    <td data-field="ativo" data-value="<?= isset($quarto['ativo']) ? $quarto['ativo'] : 0 ?>">
                                        <?= (isset($quarto['ativo']) && $quarto['ativo']) ? 'Ativo' : 'Inativo' ?>
                                    </td>
                                    <td class="actions">
                                        <button type="button" class="btn btn-primary action-button btn-editar"
                                            data-id="<?= $quarto['id'] ?>"
                                            data-numero="<?= htmlspecialchars($quarto['numero']) ?>"
                                            data-tipo="<?= htmlspecialchars($quarto['tipo']) ?>"
                                            data-preco="<?= htmlspecialchars($quarto['preco']) ?>"
                                            data-ativo="<?= isset($quarto['ativo']) ? $quarto['ativo'] : 0 ?>">
                                            Editar
                                        </button>
                                        <form method="post" action="../../controllers/room-controller.php"
                                            class="delete-room-form" style="display:inline;">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $quarto['id'] ?>">
                                            <button type="button" class="btn btn-danger action-button btn-excluir"
                                                data-id="<?= $quarto['id'] ?>">Excluir</button>
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
                                                        Tem certeza que deseja excluir este quarto?
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
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal de sucesso ao editar -->
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
                    Quarto atualizado com sucesso!
                </div>
            </div>
        </div>
    </div>
    <div id="modalWidth"
        style="display:none;align-items:center;justify-content:center;position:fixed;z-index:1050;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.3);">
        <div id="editModal">
            <h3 class="title">Edite um Quarto</h3>
            <hr>
            <form id="editForm">
                <input type="hidden" name="id" id="edit-id">
                <p>Número:</p>
                <input type="text" name="numero" id="edit-numero"><br>
                <p>Tipo:</p>
                <input type="text" name="tipo" id="edit-tipo"><br>
                <p>Preço:</p>
                <input type="text" name="preco" id="edit-preco"><br>
                <p>Ativo:</p>
                <select name="ativo" id="edit-ativo">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                </select><br>
                <div class="buttons">
                    <button type="button" class="btn btn-outline-secondary"
                        onclick="document.getElementById('modalWidth').style.display='none'">Cancelar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script type="module" src="../../assets/js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="../../assets/js/modules/room-list.js"></script>
</body>

</html>