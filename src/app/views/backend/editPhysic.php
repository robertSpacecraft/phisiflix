<?php
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
                <option value="MASCULINO"
                        <?php if ($physic->getGenero() === PhysicGenero::MASCULINO) {
                            echo "selected";
                        } ?>
                >Masculino
                </option>
                <option value="FEMENINO"
                        <?php if ($physic->getGenero() === PhysicGenero::FEMENINO) {
                            echo "selected";
                        } ?>
                >Femenino
                </option>
                <option value="NO_APLICA"
                        <?php if ($physic->getGenero() === PhysicGenero::NO_APLICA) {
                            echo "selected";
                        } ?>
                >No Aplica
                </option>
                <option value="NOT_DEFINED"
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
            <label for="inputLugarDef" class="form-label">Lugar de defunción</label>
            <input type="text" class="form-control" id="inputLugarDef" name="lugarDeDef" value="<?= $physic->getLugarDef() ?>">
        </div>
        <div class="mb-3">
            <label for="inputDescripcion" class="form-label">Descripción</label>
            <input type="text" class="form-control" id="inputDescripcion" name="descripcion" value="<?= $physic->getDescripcion() ?>">
        </div>
        <div class="mb-3">
            <label for="inputEtiquetas" class="form-label">Etiquetas</label>
            <input type="text" class="form-control" id="inputEtiquetas" name="etiquetas" value="<?= $physic->getEtiqueta() ?>">
        </div>
        <div class="mb-3">
            <label for="selectTipo" class="form-label">Tipo</label>
            <select class="form-select" id="selectTipo" name="SelectTipo">
                <option>Seleccione el tipo de entidad</option>
                <option value="PERSONA"
                        <?php if ($physic->getType() === PhysicType::PERSONA) {
                            echo "selected";
                        } ?>
                >Persona
                </option>
                <option value="INSTITUCION"
                        <?php if ($physic->getType() === PhysicType::INSTITUCION) {
                            echo "selected";
                        } ?>
                >Institución
                </option>
                <option value="INSTRUMENTO"
                        <?php if ($physic->getType() === PhysicType::INSTRUMENTO) {
                            echo "selected";
                        } ?>
                >Instrumento
                </option>
                <option value="EXPERIMENTO"
                        <?php if ($physic->getType() === PhysicType::EXPERIMENTO) {
                            echo "selected";
                        } ?>
                >Experimento
                </option>
                <option value="PUBLICACION"
                        <?php if ($physic->getType() === PhysicType::PUBLICACION) {
                            echo "selected";
                        } ?>
                >Publicación
                </option>
            </select>
        </div>
        <div class="mb-3">
            <label for="inputImagen" class="form-label">Nombre de la Imagen</label>
            <input type="text" class="form-control" id="inputImagen" name="nombreImagen" value="<?= $physic->getFoto()?>">
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
            const nombre = document.getElementById('inputNombre').value;
            const apellido = document.getElementById('inputApellido').value;
            const genero = document.getElementById('selectGenero').value;
            const nacionalidad = document.getElementById('inputNacionalidad').value;
            const lugar_def = document.getElementById('inputLugarDef').value;
            const descripcion = document.getElementById('inputDescripcion').value;
            const etiqueta = document.getElementById('inputEtiquetas').value;
            const type = document.getElementById('selectTipo').value;
            const foto = document.getElementById('inputImagen').value; // puede ir vacío

            const payload = {nombre, apellido, genero, nacionalidad, lugar_def, descripcion, etiqueta, type, foto};

            fetch("/physic/<?=htmlspecialchars($physic->getId(), ENT_QUOTES)?>", {
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
                            <span>Físico modificado correctamente.</span>
                            <a class="btn btn-sm btn-outline-dark" href="/physic/<?=htmlspecialchars($physic->getId(), ENT_QUOTES)?>">Volver</a>
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