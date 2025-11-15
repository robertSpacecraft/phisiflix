<?php






//ESTO ES LA COPIA DE EDITUSER FALTA MODIFICAR EL SCRIPT DE JAVASCRIPT





use App\Enum\PhysicGenero;
use App\Enum\PhysicType;

$titulo = "Administración de Physics";
$tituloSeccion = "Datos del físico " . $physic->getNombre(). " " . $physic->getApellido();
$rutaAgregar = "/user/create";
$botonAgregar = "Agregar usuario";
include_once DIRECTORIO_BACKEND . "/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/main.header.admin.php";
?>
    <form>
        <div class="mb-3">
            <label for="inputNombre" class="form-label">Nombre del físico</label>
            <input type="text" class="form-control" id="inputNombre" name="nombre"
                   value="<?= $physic->getNombre() ?>">
        </div>
        <div class="mb-3">
            <label for="inputApellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="inputApellido" name="apellido" value="<?= $physic->getApellido() ?>">
        </div>
        <div class="mb-3">
            <label for="selectGenero" class="form-label">Género</label>
            <select class="form-select" id="selectGenero" name="genero">
                <option>Seleccione el género</option>
                <option value="masculino"
                        <?php if ($physic->getGenero() === PhysicGenero::MASCULINO) {
                            echo "selected";
                        } ?>
                >Masculino
                </option>
                <option value="femenino"
                        <?php if ($physic->getGenero() === PhysicGenero::FEMENINO) {
                            echo "selected";
                        } ?>
                >Femenino
                </option>
                <option value="noAplica"
                        <?php if ($physic->getGenero() === PhysicGenero::NO_APLICA) {
                            echo "selected";
                        } ?>
                >No Aplica
                </option>
                <option value="notDefined"
                        <?php if ($physic->getGenero() === PhysicGenero::NOT_DEFINED) {
                            echo "selected";
                        } ?>
                >Not Defined
                </option>
            </select>
        </div>

        <div class="mb-3">
            <label for="inputNacionalidad" class="form-label">Nacionalidad</label>
            <input type="text" class="form-control" id="inputNacionalidad" name="nacionalidad" value="<?= $physic->getNacionalidad() ?>">
        </div>
        <div class="mb-3">
            <label for="inputLugDef" class="form-label">Lugar de defunción</label>
            <input type="text" class="form-control" id="inputLugDef" name="lugarDeDefuncion" value="<?= $physic->getLugDefuncion() ?>">
        </div>
        <div class="mb-3">
            <label for="inputDescripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="inputDescripcion" name="descripcion" value="<?= $physic->getDescripcion() ?>">
        </div>
        <div class="mb-3">
            <label for="inputEtiquetas" class="form-label">Etiquetas</label>
            <input type="text" class="form-control" id="inputEtiquetas" name="etiquetas" value="<?= $physic->getEtiquetas() ?>">
        </div>
        <div class="mb-3">
            <label for="selectTipo" class="form-label">Tipo</label>
            <select class="form-select" id="selectTipo" name="SelectTipo">
                <option>Seleccione el tipo de entidad</option>
                <option value="admin"
                        <?php if ($physic->getType() === PhysicType::PERSONA) {
                            echo "selected";
                        } ?>
                >Persona
                </option>
                <option value="editor"
                        <?php if ($physic->getType() === PhysicType::INSTITUCION) {
                            echo "selected";
                        } ?>
                >Institución
                </option>
                <option value="regular"
                        <?php if ($physic->getType() === PhysicType::INSTRUMENTO) {
                            echo "selected";
                        } ?>
                >Instrumento
                </option>
                <option value="advertising"
                        <?php if ($physic->getType() === PhysicType::PUBLICACION) {
                            echo "selected";
                        } ?>
                >Publicación
                </option>
            </select>
        </div>
        <div class="mb-3">
            <label for="inputImagen" class="form-label">Nombre de la Imagen</label>
            <input type="text" class="form-control" id="inputImagen" name="nombreImagen" value="<?= $physic->getImagen()?>">
        </div>

        <div class="text-bg-danger" id="diverrores">

        </div>
        <div id="mensajes"></div>

        <button type="button" class="btn btn-primary" onclick="peticionPUT()">Modificar Físico</button>
        <a href="/physic/<?= $physic->getId() ?>" class="btn btn-primary"
           onclick="return confirm('Esta acción cancelará los cambios ¿deseas continuar?')">
            Cancelar
        </a>

    </form>





    <script>
        function peticionPUT() {
            const username = document.getElementById('inputUsername').value;
            const email = document.getElementById('inputEmail').value;
            const password = document.getElementById('inputPassword').value; // puede ir vacío
            const birthdate = document.getElementById('inputBirthdate').value;
            const type = document.getElementById('selectType').value;

            const payload = {username, email, birthdate, type};
            if (password.trim() !== "") payload.password = password;

            fetch("/user/<?=htmlspecialchars($physic->getId(), ENT_QUOTES)?>", {
                method: "PUT",
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify(payload)
            })
                .then(r => r.json())
                .then(result => {
                    const divMensajes = document.getElementById('mensajes');
                    const divErrores = document.getElementById('diverrores');
                    divErrores.innerHTML = ""; //Limpia errores anteriores

                    if (result && result.error === false) {
                        //Genera el div con el mensaje de éxito y el botón volver
                        divMensajes.innerHTML = `
                            <div class="alert alert-success d-inline-flex align-items-center gap-2" role="alert" style="width:auto; display:inline-flex;">
                            <span>Usuario modificado correctamente.</span>
                            <a class="btn btn-sm btn-outline-dark" href="/user/<?=htmlspecialchars($physic->getId(), ENT_QUOTES)?>">Volver</a>
                            </div>
                            `;
                        //Resalta el mensaje.
                        divMensajes.scrollIntoView({behavior: 'smooth', block: 'start'});
                    } else {
                        //Para los errores en la validación
                        const data = (result && result.data) ? result.data : {error: 'No se pudo actualizar'};
                        const box = document.createElement('div');
                        box.className = "p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3";
                        Object.keys(data).forEach(k => {
                            const p = document.createElement('p');
                            p.textContent = `${k}: ${data[k]}`;
                            box.appendChild(p);
                        });
                        divErrores.appendChild(box);
                    }
                })
                .catch(err => {
                    const divErrores = document.getElementById('diverrores');
                    divErrores.innerHTML = `<div class="p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3">
                          Error de red: ${err}
                        </div>`;
                });
        }
    </script>

<?php
include_once DIRECTORIO_BACKEND . "/templates/partials/footer.admin.php";