<?php
$titulo = "Administración de Physics";
$tituloSeccion = "Panel principal";
$rutaAgregar = "/user/create";
$botonAgregar = "Agregar usuario";
include_once DIRECTORIO_BACKEND."/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/main.header.admin.php";

$usuario = $_SESSION['user'] ?? null;
?>

    <div class="col-md-12">
        <h1 class="text-primary-emphasis">Bienvenido/a <?=$usuario->getUsername()?>,</h1>
        <p class="text-primary">
            Este es el panel de administración de la aplicación web PhysiFlix.
        </p>
        <p class="text-primary">
            Aquí podrás gestionar todo el contenido de la página.
        </p>
        <h2 class="text-primary-emphasis">Accesos rápidos</h2>
        <div class="btn">
            <a class="btn btn-primary" href="/user" role="button">Ver todos los usuarios</a>
            <a class="btn btn-primary" href="/user/create" role="button">Agregar un nuevo usuario</a>
        </div>
        <div class="btn">
            <a class="btn btn-primary" href="/admin/physics" role="button">Ver todos los físicos</a>
            <a class="btn btn-primary" href="/admin/physic/create" role="button">Agregar un nuevo físico</a>
        </div>
    </div>

<?php
include_once DIRECTORIO_BACKEND."/templates/partials/footer.admin.php";