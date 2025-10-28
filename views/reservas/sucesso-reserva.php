<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/includes.css">
    <link rel="stylesheet" href="../../assets/css/reservations.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Reserva Criada</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="container-main">
        <div class="central-modal">
            <div class="modal-sucess-room">
                <h2>Reserva criada com sucesso!</h2>
                <div class="btn-modal">
                    <a href="./list.php" class="btn btn-primary">Ver Reservas</a>
                    <a href="./create-reservation-form.php" class="btn btn-success">Nova Reserva</a>
                </div>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
</body>

</html>