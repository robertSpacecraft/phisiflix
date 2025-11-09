<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?=$titulo?></title>
    <meta name="description" content="Plataforma para conocer la historia de la física a través de sus protagonistas">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?=DIRECTORIO_IMG_FRONTEND?>favicon.png" rel="icon">
    <link href="<?=DIRECTORIO_IMG_FRONTEND?>apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Cardo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?=DIRECTORIO_CSS_FRONTEND?>bootstrap.min.css" rel="stylesheet">
    <link href="<?=DIRECTORIO_CSS_FRONTEND?>bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=DIRECTORIO_CSS_FRONTEND?>aos/aos.css" rel="stylesheet">
    <link href="<?=DIRECTORIO_CSS_FRONTEND?>css_glightbox/glightbox.min.css" rel="stylesheet">
    <link href="<?=DIRECTORIO_CSS_FRONTEND?>swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?=DIRECTORIO_CSS_FRONTEND?>main.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: PhotoFolio
    * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
    * Updated: Aug 07 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body class="index-page">
<header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center me-auto me-xl-0">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <img src="<?=DIRECTORIO_IMG_FRONTEND?>logo3SinFondo.png" alt="">
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#" class="active">Home<br></a></li>
                <li><a href="#">Más sobre PhysiFlix</a></li>
                <li class="dropdown"><a href="#"><span>Descubre la historia</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                    <ul>
                        <li><a href="#">Personajes</a></li>
                        <li><a href="#">Hitos</a></li>
                        <li><a href="#">Experimentos</a></li>
                        <li><a href="#">Quiz</a></li>
                        <li><a href="#">Línea del tiempo</a></li>
                    </ul>
                </li>
                <li><a href="#">Aprende</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <div class="btn">
            <a href="/login" class="btn btn-outline-secondary">Iniciar sesión</a>
        </div>

        <div class="header-social-links">
            <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>

    </div>
</header>

<main id="main">