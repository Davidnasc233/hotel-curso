<?php
// Login fica emsegundo plano, focar no crud
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/includes.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sharan Hotel</title>
</head>

<body>

    <div class="container-main">
        <div class="container-form d-flex vh-100">
            <div class="login">
                <div class="div-form"
                    style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                    <div class="form-container"
                        style="width:100%;max-width:400px;background:#fff;padding:32px 28px 28px 28px;border-radius:12px;box-shadow:0 4px 24px rgba(0,0,0,0.13);">
                        <h2 class="mb-4 text-center" style="font-weight:600;letter-spacing:1px;">Área Administrativa
                        </h2>
                        <?php
                        session_start();
                        $erro = $_SESSION['login_erro'] ?? '';
                        unset($_SESSION['login_erro']);
                        $old_email = $_POST['email'] ?? '';
                        ?>
                        <form action="../controllers/login-controller.php" method="POST" autocomplete="on">
                            <?php if ($erro): ?>
                                <div class="alert alert-danger mb-3" style="font-size:1em;">
                                    <?= htmlspecialchars($erro) ?>
                                </div>
                            <?php endif; ?>
                            <div class="mb-3">
                                <label for="email" class="form-label" style="font-weight:500;">Email*</label>
                                <input type="email" name="email" id="email" class="form-control" required
                                    style="height:44px;font-size:1.1em;" value="<?= htmlspecialchars($old_email) ?>">
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label" style="font-weight:500;">Senha*</label>
                                <input type="password" name="senha" id="senha" class="form-control" required
                                    style="height:44px;font-size:1.1em;">
                            </div>
                            <button type="submit" class="btn btn-primary w-100"
                                style="height:44px;font-size:1.1em;font-weight:600;">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="image">
                <img src="/assets/images/hotel-background-5jpqs0sw51owiprj.jpg" alt="imagem hotel">
            </div>
        </div>
    </div>
    <?php include './includes/footer.php'; ?>
</body>

</html>