<?php
$titulo = "Administración de Physics";
$tituloSeccion = "Mostrando todos los Physics";
$rutaAgregar = "/admin/physic/create";
$botonAgregar = "Agregar físico";
include_once DIRECTORIO_BACKEND."/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/main.header.admin.php";
?>

<div class="row">
<?php
    if ($physics){
        foreach ($physics as $physic) {


?>
    <div class="card m-1" style="width: 15rem;">
        <img src="<?=DIRECTORIO_IMG_PHYSICS?><?=$physic->getFoto()?>" class="card-img-top" alt="<?=$physic->getNombre()?>">
        <div class="card-body">
            <h5 class="card-title"><?=$physic->getNombre()?></h5>
            <p class="card-text"><?=$physic->getApellido()?></p>
            <p class="card-text"><?=$physic->getGenero()->name?></p>
            <p class="card-text"><?=$physic->getNacionalidad()?></p>
            <p class="card-text"><?=$physic->getLugarDef()?></p>
            <p class="card-text"><?=$physic->getDescripcion()?></p>
            <p class="card-text"><?=$physic->getEtiqueta()?></p>
            <p class="card-text"><?=$physic->getType()->name?></p>
            <a href="/physic/<?=$physic->getId()?>" class="btn btn-primary">Más detalles</a>
        </div>
    </div>
        <?php }
    }else { ?>
        <div>
            <p>No hay físicos disponibles</p>
        </div>
    <?php }
        ?>

</div>
<?php
include_once DIRECTORIO_BACKEND."/templates/partials/footer.admin.php";