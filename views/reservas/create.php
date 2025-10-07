<?php
require_once '../../config/conexao.php';
require_once '../../models/quarto.php';

$quartoModel = new Quarto($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar os dados do formulário
    $numero = $_POST['numero'] ?? null;
    $tipo = $_POST['tipo'] ?? null;
    $preco = $_POST['preco'] ?? null;
    $descricao = $_POST['descricao'] ?? null;
    $ativo = isset($_POST['ativo']) ? 1 : 0; // Checkbox retorna 1 se marcado, 0 se não

    // Validar os dados (opcional, mas recomendado)
    if ($numero && $tipo && $preco && $descricao) {
        try {
            // Inserir os dados no banco
            $stmt = $pdo->prepare("INSERT INTO quartos (numero, tipo, preco, descricao, ativo) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$numero, $tipo, $preco, $descricao, $ativo]);

            echo "<p>✅ Quarto cadastrado com sucesso!</p>";
        } catch (PDOException $e) {
            echo "<p>❌ Erro ao cadastrar o quarto: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<p>❌ Por favor, preencha todos os campos obrigatórios.</p>";
    }
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
            <div class="sign-room">
                <div class="title">
                    <h1>Cadastrar Novo Quarto</h1>
                </div>
                <div class="container-form">
                    <form action="create.php" method="POST">
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
                            <textarea class="form-input" id="description" name="descricao" rows="4" cols="50" required></textarea>
                        </label>
                        <label for="ativo">
                            <input type="checkbox" id="ativo" class="form-check-input" name="ativo">
                            <span>Quarto Ativo</span>
                        </label>
                        <div class="buttons">
                            <button class="btn btn-primary" type="submit">Cadastrar</button>
                            <button class="btn btn-secondary" type="reset">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php include '../includes/footer.php'; ?>
</body>

</html>

