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
                <thead >
                    <tr class="grid-header">
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
                        <?php foreach($quartos as $index => $quarto): ?>
                        <tr class="grid-row <?= $index % 2 === 0 ? 'row-odd' : 'row-even' ?>">
                            <td><?= htmlspecialchars($quarto['id']) ?></td>
                            <td><?= htmlspecialchars($quarto['numero']) ?></td>
                            <td><?= htmlspecialchars($quarto['tipo']) ?></td>
                            <td>R$ <?= number_format($quarto['preco'], 2, ',', '.') ?></td>
                            <td><?= $quarto['ativo'] ? 'Ativo' : 'Inativo' ?></td>
                            <td>
                                <button class="btn btn-primary action-button">Editar</button>
                                <button class="btn btn-danger action-button">Excluir</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>