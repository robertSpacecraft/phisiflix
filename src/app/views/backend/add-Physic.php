<?php
$titulo = "Administración de Physics";
$tituloSeccion = "Agregar un nuevo físico";
$rutaAgregar = "/admin/physic/create";
$botonAgregar = "Agregar físico";
include_once DIRECTORIO_BACKEND."/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/main.header.admin.php";
?>
    <form id="formAddPhysic" method="post" action="/physic" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formControlNombre" class="form-label">Nombre del físico:</label>
            <input type="text" class="form-control" id="formControlNombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="formControlApellido" class="form-label">Apellido:</label>
            <input type="text" class="form-control" id="formControlApellido" name="apellido">
        </div>

        <div class="mb-3">
            <label for="formControlGenero" class="form-label">Género:</label>
            <select id="formControlGenero" name="genero" class="form-select">
                <option value="MASCULINO">Masculino</option>
                <option value="FEMENINO">Femenino</option>
                <option value="NO_DEFINIDO">No definido</option>
                <option value="NO_APLICA" selected>No aplica</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="formControlNacionalidad" class="form-label">Nacionalidad:</label>
            <input type="text" class="form-control" id="formControlNacionalidad" name="nacionalidad">
        </div>

        <div class="mb-3">
            <label for="formControlLugar_def" class="form-label">Lugar de Defunción:</label>
            <input type="text" class="form-control" id="formControlLugar_def" name="lugar_def">
        </div>

        <div class="mb-3">
            <label for="formControlDescripcion" class="form-label">Descripción:</label>
            <textarea class="form-control" id="formControlDescripcion" name="descripcion" rows="4" cols="5"></textarea>
        </div>

        <div class="mb-3">
            <label for="formControlEtiquetas" class="form-label">Etiquetas relevantes:</label>
            <input type="text" class="form-control" id="formControlEtiquetas" name="etiqueta" placeholder="ej. relatividad, óptica, radiación...">
        </div>

        <div class="mb-3">
            <label for="formControlType" class="form-label">Tipo:</label>
            <select id="formControlType" name="type" class="form-select">
                <option value="PERSONA" selected>Persona</option>
                <option value="INSTITUCION">Institución</option>
                <option value="EXPERIMENTO">Experimento</option>
                <option value="PUBLICACION">Publicación</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="formControlFoto" class="form-label">Subir foto (.png):</label>
            <input type="file" class="form-control" name="foto" id="formControlFoto" accept="image/png">
        </div>

        <!-- Contenedores para errores y mensajes -->
        <div class="text-bg-danger" id="diverrores"></div>
        <div id="mensajes"></div>

        <button type="button" class="btn btn-primary" onclick="peticionPOST()">Crear Físico</button>
    </form>


    <script>
        function peticionPOST() {
            const form = document.getElementById('formAddPhysic');
            const formData = new FormData(form); // incluye texto + fichero

            const divMensajes = document.getElementById('mensajes');
            const divErrores  = document.getElementById('diverrores');
            divMensajes.innerHTML = "";
            divErrores.innerHTML  = "";

            fetch("/physic", {
                method: "POST",
                body: formData   // NO ponemos Content-Type, lo hace el navegador
            })
                .then(r => r.json())
                .then(result => {
                    // Limpiar estilos de error previos
                    form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

                    if (result && result.error === false) {
                        // ÉXITO: mostramos mensaje y botón para volver
                        divMensajes.innerHTML = `
                <div class="alert alert-success d-inline-flex align-items-center gap-2" role="alert" style="width:auto; display:inline-flex;">
                    <span>Físico agregado correctamente.</span>
                    <a class="btn btn-sm btn-outline-dark" href="/physic">Volver al listado</a>
                </div>
            `;
                        divMensajes.scrollIntoView({behavior: 'smooth', block: 'start'});
                    } else {
                        // ERRORES DE VALIDACIÓN
                        const data = (result && result.data) ? result.data : {error: 'No se pudo crear el físico'};

                        const box = document.createElement('div');
                        box.className = "p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3";

                        Object.keys(data).forEach(k => {
                            const p = document.createElement('p');
                            p.textContent = `${k}: ${data[k]}`;
                            box.appendChild(p);

                            // Marcar campo como inválido si existe un input con ese name
                            const campo = form.querySelector(`[name="${k}"]`);
                            if (campo) {
                                campo.classList.add('is-invalid');
                            }
                        });

                        divErrores.appendChild(box);
                        divErrores.scrollIntoView({behavior: 'smooth', block: 'start'});
                    }
                })
                .catch(err => {
                    divErrores.innerHTML = `
            <div class="p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3">
                Error de red: ${err}
            </div>
        `;
                });
        }
    </script>


<?php
include_once DIRECTORIO_BACKEND."/templates/partials/footer.admin.php";