<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/includes.css">
    <link rel="stylesheet" href="../../assets/css/create.css">
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
                <form action="">
                    <label for="">
                        <p>Numero do Quarto*</p>
                        <input class="form-input" type="number">
                    </label>
                    <label for="">
                        <p>Tipo*</p>
                        <input class="form-input" type="number">
                    </label>
                    <label for="">
                        <p>Preço por Noite*</p>
                        <input class="form-input" type="number">
                    </label>
                    <label for="">
                        <p>Descrição*</p>
                        <textarea class="form-input" id="description" rows="4" cols="50"></textarea>
                    </label>
                    <label for="available">
                        <input type="checkbox" id="available" class="form-check-input" name="available">
                        <span>Quarto Ativo</span>
                    </label>
                </form>
                <div class="buttons">
                    <button class="btn btn-primary">Cadastrar</button>
                    <button class="btn btn-secondary">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>