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
    <!-- <?php include '../reservas/create.php'; ?> -->
    <div class="container-main">
    <div class="sign-room">
        <div class="title">
            <h1>Cadastrar Novo Quarto</h1>
            <button class="btn btn-success">
                Novo Quarto
            </button>
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
                    <tr class="grid-row">
                        <td>1</td>
                        <td>101</td>
                        <td>standard</td>
                        <td>R$ 150,00</td>
                        <td>Ativo</td>
                        <td>
                            <button class="btn btn-primary action-button">Editar</button>
                            <button class="btn btn-danger action-button">Excluir</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>