<?php
$titulo = "Administración de Physics";
$tituloSeccion = "Datos del físico" .$physic->getNombre();
$rutaAgregar = "/physic/create";
$botonAgregar = "Agregar Físico";
include_once DIRECTORIO_BACKEND."/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/main.header.admin.php";
?>

    <div class="mb-3">
        <ul class="list-group">
            <li class="list-group-item"><?=$physic->getFoto()?></li>
            <li class="list-group-item"><?=$physic->getNombre()?></li>
            <li class="list-group-item"><?=$physic->getApellido()?></li>
            <li class="list-group-item"><?=$physic->getGenero()->name?></li>
            <li class="list-group-item"><?=$physic->getNacionalidad()?></li>
            <li class="list-group-item"><?=$physic->getLugarDef()?></li>
            <li class="list-group-item"><?=$physic->getDescripcion()?></li>
            <li class="list-group-item"><?=$physic->getEtiqueta()?></li>
            <li class="list-group-item"><?=$physic->getType()->name?></li>
        </ul>
    </div>
    <div class="mb-3">
        <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-outline-secondary" type="button" onclick="irAModificarPhysic()">Modificar Físico</button>
            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmacionBorrarModal">Borrar Físico</button>
            <div>
                <a href="/physic" class="btn-primary">Volver</a>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="confirmacionBorrarModal" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Se borrará el Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-danger" onclick="peticionDelete()">Confirmar Borrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function irAModificarPhysic(){
            window.location.replace("http://localhost:8080/user/<?=$physic->getId()?>/edit");
        }

        function irATodosLosUsuarios(){
            window.location.replace("http://localhost:8080/physic");
        }

        function peticionDelete(){
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
include_once DIRECTORIO_BACKEND."/templates/partials/footer.admin.php";