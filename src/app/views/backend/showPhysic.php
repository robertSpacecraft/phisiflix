<?php
$titulo = "Administración de Physics";
$tituloSeccion = "Datos de: " . $physic->getNombre() . " " . $physic->getApellido();
$rutaAgregar = "/admin/physic/create";
$botonAgregar = "Agregar Físico";
include_once DIRECTORIO_BACKEND . "/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/main.header.admin.php";
?>

    <div class="row">
        <!-- Columna izquierda (lista de datos) -->
        <div class="col-md-8">
            <ul class="list-group">
                <li class="list-group-item"><strong>Nombre:</strong><br><?=$physic->getNombre()?></li>
                <li class="list-group-item"><strong>Apellido:</strong><br><?=$physic->getApellido()?></li>
                <li class="list-group-item"><strong>Género:</strong><br><?=$physic->getGenero()->name?></li>
                <li class="list-group-item"><strong>Nacionalidad:</strong><br><?=$physic->getNacionalidad()?></li>
                <li class="list-group-item"><strong>Lugar de defunción:</strong><br><?=$physic->getLugarDef()?></li>
                <li class="list-group-item"><strong>Descripción:</strong><br><?=$physic->getDescripcion()?></li>
                <li class="list-group-item"><strong>Etiquetas:</strong><br><?=$physic->getEtiqueta()?></li>
                <li class="list-group-item"><strong>Tipo:</strong><br><?=$physic->getType()->name?></li>
                <li class="list-group-item"><strong>Nombre de la imagen:</strong><br><?=$physic->getFoto()?></li>
            </ul>
        </div>
        <div class="col-md-4">
            <img src="<?=DIRECTORIO_IMG_PHYSICS?><?=$physic->getFoto()?>"
                 alt="<?=$physic->getNombre()?>"
                 class="img-fluid rounded"
                 style="max-width: 65%; height: auto;">
        </div>
    </div>

    <div class="mb-3">
        <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-outline-secondary" type="button" onclick="irAModificarPhysic()">Modificar Físico
            </button>
            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                    data-bs-target="#confirmacionBorrarModal">Borrar Físico
            </button>
            <div>
                <a href="/physic" class="btn-primary">Volver</a>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirmacionBorrarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Se borrará el físico</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-danger" onclick="peticionDelete()">Confirmar
                        Borrar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function irAModificarPhysic() {
            window.location.replace("http://localhost:8080/physic/<?=$physic->getId()?>/edit");
        }

        function irATodosLosUsuarios() {
            window.location.replace("http://localhost:8080/physic");
        }

        function peticionDelete() {
            const urlencoded = new URLSearchParams();

            const requestOptions = {
                method: "DELETE",
                body: urlencoded,
                redirect: "follow"
            };

            fetch("http://localhost:8080/physic/<?=$physic->getId()?>", requestOptions)
                .then((response) => response.text())
                .then((result) => irATodosLosPhysics())
                .catch((error) => console.error(error));
        }
    </script>
<?php
include_once DIRECTORIO_BACKEND . "/templates/partials/footer.admin.php";