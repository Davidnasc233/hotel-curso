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
    <title>Criar Reserva</title>
</head>

<body>
    <?php include '../includes/header.php'; ?>
    <div class="container-main">
        <div class="sign-room">
            <div class="title">
                <h1>Criar Nova Reserva</h1>
            </div>
            <div class="container-form">
                <form action="../../controllers/reserva-controller.php" method="POST">
                    <input type="hidden" name="action" value="create">
                    <label for="quarto_id">
                        <p>Quarto*</p>
                        <select class="form-input" id="quarto_id" name="quarto_id" required>
                            <option value="">Selecione um quarto</option>
                            <?php
                            require_once '../../config/conexao.php';
                            require_once '../../models/quarto.php';
                            $quartoModel = new Quarto($pdo);
                            $quartos = $quartoModel->listar();
                            foreach ($quartos as $quarto) {
                                echo '<option value="' . $quarto['id'] . '">' . $quarto['numero'] . ' - ' . $quarto['tipo'] . '</option>';
                            }
                            ?>
                        </select>
                    </label>
                    <label for="nome_cliente">
                        <p>Nome do Cliente*</p>
                        <input class="form-input" type="text" id="nome_cliente" name="nome_cliente" required>
                    </label>
                    <label for="email">
                        <p>E-mail*</p>
                        <input class="form-input" type="email" id="email" name="email" required>
                    </label>
                    <label for="cpf">
                        <p>CPF*</p>
                        <input class="form-input" type="tel" id="cpf" name="cpf" required maxlength="14">
                    </label>
                    <label for="telefone">
                        <p>Telefone*</p>
                        <input class="form-input" type="tel" id="telefone" name="telefone" required maxlength="15">
                    </label>
                    <label for="data_checkin">
                        <p>Data de Check-in*</p>
                        <input class="form-input" type="date" id="data_checkin" name="data_checkin" required>
                    </label>
                    <label for="data_checkout">
                        <p>Data de Check-out*</p>
                        <input class="form-input" type="date" id="data_checkout" name="data_checkout" required>
                    </label>
                    <label for="guests">
                        <p>Hóspedes</p>
                        <select class="form-input" id="guests" name="guests">
                            <?php for ($i = 0; $i <= 3; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </label>
                    <label for="children">
                        <p>Crianças</p>
                        <select class="form-input" id="children" name="children">
                            <?php for ($i = 0; $i <= 3; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </label>
                    <div class="buttons">
                        <button class="btn btn-primary" type="submit">Reservar</button>
                        <a href="../../routes/reserva-routes.php?action=list" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include '../includes/footer.php'; ?>
    <script type="module" src="../../assets/js/modules/create-reservation-form.js"></script>
</body>

</html>