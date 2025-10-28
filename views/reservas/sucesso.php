<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit;
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
    <div class="container-main">
        <div class="central-modal">
            <div class="modal-sucess-room">
                <h2>Quarto cadastrado com sucesso!</h2>
                <div class="btn-modal">
                    <a href="./list-rooms.php" class="btn btn-primary">Ver Quartos</a>
                    <a href="./create.php" class="btn btn-success">Cadastrar Novo</a>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>