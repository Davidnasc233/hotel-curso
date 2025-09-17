<?php

require_once "./config/db.php";
require_once "./models/reserva.php";

$reserva = new Reserva($pdo);
$dados = $reserva->listar();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel | David Dias</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/regular/style.css" />
</head>

<body>

    <div class="page-wraper">
        <header class="header">
            <div class="container">
                <nav class="cabecalho">
                    <a class="logo" href="#inicio">
                        <img src="assets/images/logo-light.png" alt="logo">
                    </a>
                    <ul class="nav_bar" id="nav-links">
                        <li><a href="#inicio" id="home">HOME</a></li>
                        <li><a href="#">POST DETAIL</a></li>
                        <li><a href="#">PAGES</a></li>
                        <li><a href="#">PROJECTS</a></li>
                        <li><a href="#">SHORTCODES</a></li>
                    </ul>
                </nav>

            </div>
        </header>
        <div class="page-content" id="inicio">

            <div class="banner"></div>

            <div class="section-full">

                <div class="container-section">

                    <div class="reserva">

                        <h3 class="title">Reserva</h3>

                        <form class="formulario reservationsList" id="formReserva">

                            <label for="" class="in-out">
                                <p class="text">Entrada/Saída</p>
                                <div class="d-flex">
                                    <input type="date" class="input-date" placeholder="Entrada" id="check_in">
                                    <input type="date" class="input-date" placeholder="Saída" id="check_out">
                                </div>
                            </label>

                            <label for="" class="dados">
                                <p class="text">Quarto</p>
                                <select class="form-select-1" id="room_type" aria-label="Disabled select example">
                                    <option selected disabled>Quarto</option>
                                    <option value="1">Casal 01</option>
                                    <option value="2">Solteiro 01</option>
                                    <option value="3">Casal 02</option>
                                </select>
                            </label>

                            <label for="" class="dados">
                                <p class="text">Adulto</p>
                                <select name="text" id="guests" placeholder="Adulto" class="form-select-1">
                                    <option selected disabled>Adulto</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </label>

                            <label for="" class="dados">
                                <p class="text">Criança</p>
                                <select name="text" id="children" placeholder="Adulto" class="form-select-1">
                                    <option selected disabled>Criança</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </label>

                            <button type="submit" class="btn-form">Enviar</button>

                        </form>
                    </div>
                </div>
                <div class="main-content">
                    <div class="content">
                        <div class="titulo-container">
                            <h2 class="titulo">Sobre</h2>
                        </div>
                        <hr class="gold-line">
                        <div class="description">
                            <h4 class="d-title">
                                We will be so proud to be our guest.Lorem Ipsum is simply dummy text of the printing.
                            </h4>
                            <p class="d-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum <br>has been the typesetting industry's standard dummy text ever since the
                                when. Lorem <br> Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>
                        <div class="service-box">
                            <div class="box-1">
                                <div class="box" id="box-rest">
                                    <img src="assets/images/Container.png" alt="">
                                    <div class="service">
                                        <h4>Restaurante</h4> <br>
                                        <p>Lorem ipsum dolor sit piscing sed nonmy</p>
                                    </div>
                                </div>
                                <div class="box">
                                    <img src="assets/images/Icon.svg" alt="">
                                    <div class="service">
                                        <h4>Wellness & Spa</h4> <br>
                                        <p>Lorem ipsum dolor sit piscing sed nonmy</p>
                                    </div>
                                </div>
                            </div>
                            <div class="box-1">
                                <div class="box" id="box-wifi">
                                    <img src="assets/images/Icon (2).svg" alt="">
                                    <div class="service">
                                        <h4>Free Wifi</h4> <br>
                                        <p>Lorem ipsum dolor sit piscing sed nonmy</p>
                                    </div>
                                </div>
                                <div class="box">
                                    <img src="assets/images/Icon (1).svg" alt="">
                                    <div class="service">
                                        <h4>Espaço de jogos</h4> <br>
                                        <p>Lorem ipsum dolor sit piscing sed nonmy</p>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn-service">Saiba Mais<p class="p-line">-</p></button>

                        </div>
                    </div>

                    <div class="image-content">
                        <img src="assets/images/Background.png" alt="hotel" class="image-content">
                    </div>
                </div>
            </div>
            <div class="section-full-2">
                <div class="container-2">
                    <div class="titulo-container-2">
                        <h2 class="titulo-2">Acomodações</h2>
                    </div>
                    <hr class="gold-line-2">
                    <div class="list-suites">
                        <ul class="acomodacoes">
                            <li><a href="#" data-filter="todos" class="active">TODOS</a></li>
                            <li><a href="#" data-filter="casal">CASAL</a></li>
                            <li><a href="#" data-filter="solteiro">SOLTEIRO</a></li>
                            <li><a href="#" data-filter="suite">SUÍTE</a></li>
                        </ul>
                    </div>
                    <div class="container-room">
                        <div class="item casal filterable-item quarto-card">
                            <img src="assets/images/Group 1.png" class="center-img" alt="Quarto Casal 01">
                            <div class="conteudo-card">
                                <p class="preco">R$ 299,00/NOITE</p>
                                <div class="info">
                                    <p class="detalhes"><img
                                            src="assets/images/up-right-and-down-left-from-center-solid.svg"
                                            alt=""><strong>tamanho</strong> 30m²
                                    </p>
                                    <p class="detalhes" id="adult"><img src="assets/images/user-solid.svg"
                                            alt=""><strong> Adultos:</strong> 3</p>
                                    <button>SAIBA MAIS</button>
                                </div>
                            </div>
                        </div>
                        <div class="item solteiro filterable-item quarto-card">
                            <img src="assets/images/Group 2.png" class="center-img" alt="Quarto solteiro 01">
                            <div class="conteudo-card">
                                <p class="preco">R$ 199,00/NOITE</p>
                                <div class="info">
                                    <p class="detalhes"><img
                                            src="assets/images/up-right-and-down-left-from-center-solid.svg"
                                            alt=""><strong>tamanho</strong> 30m²
                                    </p>
                                    <p class="detalhes" id="adult"><img src="assets/images/user-solid.svg"
                                            alt=""><strong>Adultos:</strong> 3</p>
                                    <button>SAIBA MAIS</button>
                                </div>
                            </div>
                        </div>
                        <div class="item casal suite filterable-item quarto-card">
                            <img src="assets/images/Group 3.png" class="center-img" alt="Quarto Casal 01">
                            <div class="conteudo-card">
                                <p class="preco">R$ 299,00/NOITE</p>
                                <div class="info">
                                    <p class="detalhes"><img
                                            src="assets/images/up-right-and-down-left-from-center-solid.svg"
                                            alt=""><strong>tamanho</strong> 30m²
                                    </p>
                                    <p class="detalhes" id="adult"><img src="assets/images/user-solid.svg"
                                            alt="icon"><strong> Adultos:</strong> 3</p>
                                    <button>SAIBA MAIS</button>
                                </div>
                            </div>
                        </div>
                        <div id="modalRoom" class="modal">
                            <div class="modal-content" id="content-modal-room" style="position: relative;">
                                <span class="close" id="closeModalRoom"
                                    style="position: absolute; top: 30px; right: 50px; cursor: pointer;">&times;</span>
                                <img src="assets/images/logo-light.png" alt=""
                                    style="background-color: rgba(0, 0, 0, 0.3);">
                                <h2 id="modalTitle">Detalhes do Quarto</h2>
                                <p id="modalDescription">Descrição do quarto.</p>
                                <p id="modalPrice">Preço: <strong></strong></p>
                                <button class="btn-close-modal">Fechar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <footer>
            <div class="container-footer">
                <div class="social">
                    <div class="newsletter">
                        <div class="news">
                            <h4>NEWSLETTER</h4>
                            <p>Never Miss Anything From Construx By Signing Up To Our Newsletter.</p>
                        </div>
                        <div class="linha-vertical"></div>
                        <form class="submit" id="formEmail">
                            <label for="" class="d-flex">
                                <input type="email" id="newEmail" placeholder="DIGITE SEU EMAIL">
                                <button>ENVIAR <p class="p-line">-</p></button>
                            </label>
                            <p id="erro" class="new-p mt-2"></p>
                            <div id="meuModalSucesso" class="modal">
                                <div class="modal-content">
                                    <span class="close" id="closeSucesso">&times;</span>
                                    <h2>✅ Sucesso!</h2>
                                    <p>Inscrição realizada com sucesso!</p>
                                    <button class="ok-btn" id="ok-btn-sucesso">OK</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <hr>
                    <div class="media">
                        <div class="links">
                            <img src="assets/images/logo-light.png" alt="logo-light">
                            <p>Today we can tell you, thanks to your <br>
                                passion, hard work creativity, and <br>
                                expertise, you delivered us the most <br>
                                beautiful house great looks.</p>
                            <div class="social-media">
                                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#"><i class="fa-solid fa-rss"></i>
                                </a>
                                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="#"><i class="fa-brands fa-google-plus-g"></i></a>
                                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="links">
                            <h4>Links</h4>
                            <ul>
                                <li>ABOUT</li>
                                <li>GALLERY</li>
                                <li>BLOG</li>
                                <li>PORTFOLIO</li>
                                <li>CONTACT US</li>
                                <li>FAQ</li>
                            </ul>
                        </div>
                        <div class="links">
                            <h4>ACOMODAÇÕES</h4>
                            <ul>
                                <li>CLASSIC</li>
                                <li>SUPERIOR</li>
                                <li>DELUXE</li>
                                <li>MASTER</li>
                                <li>LUXURY</li>
                                <li>BANQUET HALLS</li>
                        </div>
                        <div class="contact">
                            <h4>FALE CONOSCO</h4>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa-regular fa-map"></i></a>
                                    92 Princess Road, parkvenue,<br>London, NW18JR, United Kingdom
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-envelope-open-text"></i></a>
                                    sharandemo@gmail.com
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-phone"></i></a>
                                    (+0091) 912-3456-073
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-print"></i></a>
                                    (+0091) 912-3456-084
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="company">
                <p class="c-teste">© 2024 Your Company. Designed By Teste.</p>
            </div>

        </footer>
    </div>
    <script src="./script/script.js"></script>
</body>



</html>