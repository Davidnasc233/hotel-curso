<?php
// Login fica emsegundo plano, focar no crud
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/includes.css">
    <link rel="stylesheet" href="./login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sharan Hotel</title>
</head>

<body>

    <div class="container-main">
        <div class="container-form d-flex vh-100">
            <div class="login">
                <div class="div-form">
                    <div class="form-container">
                        <h2>Login</h2>
                        <form action="">
                            <label for="" class="email">
                                <span>Email*</span>
                                <input type="email">
                            </label>
                            <label for="" class="senha">
                                <span>Senha*</span>
                                <input type="password">
                            </label>
                            <button>Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="image">
                <img src="/projeto-hotel/assets/images/hotel-background-5jpqs0sw51owiprj.jpg" alt="imagem hotel">
            </div>
        </div>
    </div>
    <?php include './includes/footer.php'; ?>
</body>

</html>