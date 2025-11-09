<?php
$titulo = "Administración de Physics";
$tituloSeccion = "Mostrando todos los usuarios";
$rutaAgregar = "/user/create";
$botonAgregar = "Agregar usuario";
include_once DIRECTORIO_BACKEND."/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/main.header.admin.php";
?>

<div class="row">
<?php
    if ($usuarios){
        foreach ($usuarios as $usuario) {


?>

    <div class="card m-1" style="width: 18rem;">
        <img src="<?=DIRECTORIO_IMG_BACKEND?>userGeneric.png" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?=$usuario->getUsername()?></h5>
            <p class="card-text"><?=$usuario->getEmail()?></p>
            <a href="/user/<?=$usuario->getId()?>" class="btn btn-primary">Más detalles</a>
        </div>
    </div>
        <?php }
    }else { ?>
        <div>
            <p>No hay usuarios disponibles</p>
        </div>
    <?php }
        ?>

</div>
<?php
include_once DIRECTORIO_BACKEND."/templates/partials/footer.admin.php";