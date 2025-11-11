<?php
use App\Enum\UserType;

$titulo = "Administración de Physics";
$tituloSeccion = "Datos del usuario " .$usuario->getUsername();
$rutaAgregar = "/user/create";
$botonAgregar = "Agregar usuario";
include_once DIRECTORIO_BACKEND."/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/main.header.admin.php";

?>
    <form>
        <div class="mb-3">
            <label for="inputUsername" class="form-label">Nombre del Usuario</label>
            <input type="text" class="form-control" id="inputUsername"  name="username" value="<?=$usuario->getUsername()?>">
        </div>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="inputEmail" name="email" value="<?=$usuario->getEmail()?>">
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="inputPassword" value="<?=$usuario->getPassword()?>">
        </div>

        <div class="mb-3">
            <label for="inputBirthdate" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="inputBirthdate" name="birthdate" value="<?=$usuario->getBirthdate()->format('Y-m-d')?>">

        </div>
        <div class="mb-3">
            <select class="form-select" id="selectType" name="type">
                <option>Seleccione el tipo de usuario</option>
                <option value="admin"
                        <?php if ($usuario->getType()===UserType::ADMIN){echo "selected";}?>
                >Admin</option>
                <option value="editor"
                        <?php if ($usuario->getType()===UserType::EDITOR){echo "selected";}?>
                >Editor</option>
                <option value="regular"
                        <?php if ($usuario->getType()===UserType::REGULAR){echo "selected";}?>
                >Regular</option>
                <option value="advertising"
                        <?php if ($usuario->getType()===UserType::ADVERTISING){echo "selected";}?>
                >Advertising</option>
            </select>
        </div>
        <div class="text-bg-danger" id="diverrores">

        </div>

        <button type="submit" class="btn btn-primary" onclick="peticionPUT()">Modificar Usuario</button>
        <a href="/user/<?=$usuario->getId()?>" class="btn btn-primary"
           onclick="return confirm('Esta acción cancelará los cambios ¿deseas continuar?')">
            Cancelar
        </a>

    </form>
    <script>
        function peticionPUT(){
            let username = document.getElementById('inputUsername');
            let email = document.getElementById('inputEmail');
            let password = document.getElementById('inputPassword');
            let birthdate = document.getElementById('inputBirthdate');
            let type = document.getElementById('selectType');

            const myHeaders = new Headers();
            myHeaders.append("Content-Type", "application/json");

            const raw = JSON.stringify({
            "username": username.value,
            "email": email.value,
            "password": password.value,
            "birthdate": birthdate.value,
            "type": type.value
            });

            const requestOptions = {
                method: "PUT",
                headers: myHeaders,
                body: raw,
                redirect: "follow"
            };

            fetch("http://localhost:8080/user/<?=$usuario-getId()?>>", requestOptions)
                .then((response) => response.text())
                .then((result) => console.log(result))
                .catch((error) => console.error(error));
        }
        function redirecionarAInfoDeUsuario() {
            if ('id' in JSON.parse(resultado)){
                window.location.replace("http://localhost:8080/user/<?=$usuario->getId()?>");
            } else {
                const divErrores = document.getElementById('diverrores');
                let divError = document.createElement('div');
                divError.className="p-3 text-danger/emphasis bg-danger-subtle border border-danger-subtle rounded-3";
                divErrores.appendChild(divError);
                let error = document.createElement('p');
                let errores = JSON.parse(resultado);
                console.log(errores);
                Object.keys(errores).forEach(clave => {
                    error.textContent = `${clave}: ${errores[clave]}`;
                    divError.appendChild(error);
                });
            }

        }

    </script>
<?php
include_once DIRECTORIO_BACKEND."/templates/partials/footer.admin.php";