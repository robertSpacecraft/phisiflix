<?php

use App\Enum\UserType;

$titulo = "Administración de Physics";
$tituloSeccion = "Datos del usuario " . $usuario->getUsername();
$rutaAgregar = "/user/create";
$botonAgregar = "Agregar usuario";
include_once DIRECTORIO_BACKEND . "/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/main.header.admin.php";
?>
    <form>
        <div class="mb-3">
            <label for="inputUsername" class="form-label">Nombre del Usuario</label>
            <input type="text" class="form-control" id="inputUsername" name="username"
                   value="<?= $usuario->getUsername() ?>">
        </div>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $usuario->getEmail() ?>">
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="inputPassword"
                   value="<?= $usuario->getPassword() ?>">
        </div>

        <div class="mb-3">
            <label for="inputBirthdate" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="inputBirthdate" name="birthdate"
                   value="<?= $usuario->getBirthdate()->format('Y-m-d') ?>">

        </div>
        <div class="mb-3">
            <select class="form-select" id="selectType" name="type">
                <option>Seleccione el tipo de usuario</option>
                <option value="admin"
                        <?php if ($usuario->getType() === UserType::ADMIN) {
                            echo "selected";
                        } ?>
                >Admin
                </option>
                <option value="editor"
                        <?php if ($usuario->getType() === UserType::EDITOR) {
                            echo "selected";
                        } ?>
                >Editor
                </option>
                <option value="regular"
                        <?php if ($usuario->getType() === UserType::REGULAR) {
                            echo "selected";
                        } ?>
                >Regular
                </option>
                <option value="advertising"
                        <?php if ($usuario->getType() === UserType::ADVERTISING) {
                            echo "selected";
                        } ?>
                >Advertising
                </option>
            </select>
        </div>
        <div class="text-bg-danger" id="diverrores">

        </div>
        <div id="mensajes"></div>

        <button type="button" class="btn btn-primary" onclick="peticionPUT()">Modificar Usuario</button>
        <a href="/user/<?= $usuario->getId() ?>" class="btn btn-primary"
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

            fetch("/user/<?=htmlspecialchars($usuario->getId(), ENT_QUOTES)?>", {
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
                            <a class="btn btn-sm btn-outline-dark" href="/user/<?=htmlspecialchars($usuario->getId(), ENT_QUOTES)?>">Volver</a>
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