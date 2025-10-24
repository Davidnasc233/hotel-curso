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
                <a href="./create.php" class="btn btn-success">
                    Novo Quarto
                </a>
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
                                            style="display:inline;"
                                            onsubmit="return confirm('Deseja realmente excluir este quarto?')">
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="id" value="<?= $quarto['id'] ?>">
                                            <button type="submit"
                                                class="btn btn-danger action-button btn-excluir">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="modalWidth">
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
                        onclick="document.getElementById('editModal').style.display='none'">Cancelar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script type="module" src="../../assets/js/script.js"></script>
</body>

</html>