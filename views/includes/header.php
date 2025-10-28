<header class="header">
    <div class="container-header">
        <nav class="cabecalho">
            <a class="logo" href="#inicio">
                <img src="../../assets/images/logo-light.png" alt="logo">
            </a>
            <ul class="nav_bar" id="nav-links">
                <li><a href="#inicio" id="home">Home</a></li>
                <li><a href="#">Sobre</a></li>
                <li><a href="#">Contato</a></li>
                <?php
                if (session_status() === PHP_SESSION_NONE)
                    session_start();
                if (isset($_SESSION['usuario_id'])): ?>
                    <li>
                        <form action="../../controllers/logout.php" method="post" style="display:inline;">
                            <button type="submit" class="btn btn-danger" style="width: fit-content;">Sair</button>
                        </form>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    </div>
</header>