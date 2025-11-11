<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PhysiFlix</title>
    <link rel="stylesheet" href="<?=DIRECTORIO_CSS_BACKEND?>cuenta.css" /><!-- Aplico css externo -->
    <link rel="shortcut icon" type="image/jpg" href="<?=DIRECTORIO_IMG_FRONTEND?>favicon.png" />
    <meta name="keywords" content="html,css,clon netflix" />
    <meta name="description"
          content="Clon del login de usuario de Netflix España hecho con HTML y CSS para la asignatura de Lenguajes de Marcas del IES Fernando Wirtz" />
    <meta name="author" content="Cristina Correa" />
    <meta name="generator" content="VSCode" />
    <meta name="theme-color" content="#000" />

    <meta name="google" content="nositelinkssearchbox" />
    <meta name="google" content="notranslate" />
    <meta name="robots" content="index, nofollow" />


    <meta property="og:title" content="Clon de Netflix España con HTML y CSS">
    <meta property="og:description"
          content="Clon del login de usuario de Netflix España hecho con HTML y CSS para la asignatura de Lenguajes de Marcas del IES Fernando Wirtz">
</head>
<body>
<div class="contenido">
    <nav>
        <a href="/"><img class="logo" src="<?=DIRECTORIO_IMG_FRONTEND?>logo3SinFondo.png" alt="physiFlixLogo" /></a>
    </nav>
    <div class="caja">
        <h2>Iniciar sesión</h2>
        <form action="/user/login" method="post">
        <div class="form">
            <input
                type="text"
                placeholder="Nombre de usuario"
                required
                id="inputUsername" name="username"
            />
            <input type="password" placeholder="Contraseña" id="inputPassword" name="password" required />
        </div>
        <button type="submit">Iniciar sesión</button>
            <div class="alert-danger"><?php if (isset($error)) {echo $error;} ?></div>
        <div class="checkbox">
            <div class="recordar">
                <input type="checkbox" id="checkbox1"/>
                <label for="remember">Recuérdame</label>
            </div>
            <div>
                <p>¿Problemas para iniciar sesión?</p>
            </div>
        </div>
        </form>
        <div class="subscripcion">
            <p>¿No tienes cuenta? <span>Subscríbete ya.</span></p>
            <a href="/register">
            <button type="submit">Regístrarse</button>
            </a>
            <p><br/> <br/> La información recopilada por Google reCAPTCHA está sujeta a la <a href="https://policies.google.com/privacy">Política de Privacidad</a>
                y las <a href="https://policies.google.com/terms">Condiciones de servicio</a> de
                Google, y se utiliza para proporcionar, mantener y mejorar el servicio de reCAPTCHA, así como para fines generales de
                seguridad (Google no la utiliza para publicidad personalizada). </p>
        </div>
    </div>
</div>
</body>
<footer>
    <p>¿Preguntas? Llama al 900-759-106</p>
    <div class="links">
        <ul>
            <li><a href="#">Preguntas frecuentes</a></li>
            <li><a href="#">Centro de ayuda</a></li>
            <li><a href="/terminos-de-uso.html">Términos de uso</a></li>
            <li><a href="/privacidad.html">Privacidad</a></li>
            <li><a href="#">Preferencias de cookies</a></li>
            <li><a href="/info-corporativa.html">Información corporativa</a></li>
        </ul>
    </div>
</footer>
</html>