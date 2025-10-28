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

    <div class="container-main">
        <div class="sign-room">
            <div class="title">
                <h1>Cadastrar Novo Quarto</h1>
            </div>
            <div class="container-form">
                <form action="../../routes/quarto-routes.php" href="./sucesso.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <label for="numero">
                        <p>Numero do Quarto*</p>
                        <input class="form-input" type="number" id="numero" name="numero" required>
                    </label>
                    <label for="tipo">
                        <p>Tipo*</p>
                        <input class="form-input" type="text" id="tipo" name="tipo" required>
                    </label>
                    <label for="preco">
                        <p>Preço por Noite*</p>
                        <input class="form-input" type="number" id="preco" name="preco" step="0.01" required>
                    </label>
                    <label for="descricao">
                        <p>Descrição*</p>
                        <textarea class="form-input" id="description" name="descricao" rows="4" cols="50"
                            required></textarea>
                    </label>
                    <label for="ativo">
                        <input type="checkbox" id="ativo" class="form-check-input" name="ativo">
                        <span>Quarto Ativo</span>
                    </label>
                    <div class="buttons">
                        <button class="btn btn-primary" type="submit">Cadastrar</button>
                        <a href="./list-rooms.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>