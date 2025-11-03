<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cuenta Clon</title>
    <link rel="stylesheet" href="app/views/backend/templates/netflixPlantilla/css/cuenta.css" /><!-- Aplico css externo -->
    <link rel="shortcut icon" type="image/jpg" href="img/netflix-flavicon.png" />
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
        <img class="logo" src="/app/views/frontend/templates/PhotoFolio/assets/img/logo3SinFondo.png" alt="physiFlixLogo" />
    </nav>
    <form method="POST" action="/user">
    <div class="caja">
        <h2>Registrarse</h2>
        <div class="form">
            <label for="username" class="form">Nombre:</label>
            <input name="username" type="text" id="username" required/>
            <label for="apellido" class="form">Apellidos:</label>
            <input name="apellido" type="text" id="apellido" required />
            <label for="email" class="form">Email:</label>
            <input name="email" type="email" placeholder="example@email.com" id="email" required />
            <label for="password" class="form">Contraseña:</label>
            <input name="password" type="password" id="password" required />
            <label for="veryPassword" class="form">Repite la contraseña:</label>
            <input name="veryPassword" type="password" id="veryPassword" required />
            <label for="birthdate" class="form">Fecha de nacimiento:</label>
            <input name="birthdate" type="date" id="birthdate" required />
        </div>
        <button>Registrarse</button>
    </form>
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