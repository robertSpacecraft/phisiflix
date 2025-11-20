<?php
$titulo = "Administración de Physics";
$tituloSeccion = "Mostrando todos los Hitos";
$rutaAgregar = "/admin/hito/create";
$botonAgregar = "Agregar hito";
include_once DIRECTORIO_BACKEND."/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/main.header.admin.php";
?>

<div class="row">
<?php
    if ($hitos){
        foreach ($hitos as $hito) {


?>
    <div class="card m-1" style="width: 15rem;">
        <div class="card-body">
            <h2 class="card-title"><?=$hito->getTitulo()?></h2>
            <p class="card-text"><strong>Categoría: </strong><br><?=$hito->getCategory()?></p>
            <p class="card-text"><strong>Descripción: </strong><br><?=$hito->getSummary()?></p>
            <a href="/hito/<?=$hito->getId()?>" class="btn btn-primary">Más detalles</a>
        </div>
    </div>
        <?php }
    }else { ?>
        <div>
            <p>No hay físicos hitos</p>
        </div>
    <?php }
        ?>

</div>
<?php
include_once DIRECTORIO_BACKEND."/templates/partials/footer.admin.php";