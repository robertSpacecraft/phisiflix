<?php
$titulo = "Administración de Physics";
$tituloSeccion = "Creación de usuarios";
$rutaAgregar = "/user/create";
$botonAgregar = "Agregar usuario";
include_once DIRECTORIO_BACKEND . "/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND . "/templates/partials/main.header.admin.php";
?>
    <form method="post" action="/user"> <!--me lleva al método store-->
        <div class="mb-3">
            <label for="inputUsername" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" id="inputUsername" name="username"
                <?php if (isset($resultado)){echo "value='".$_POST['username']."'";}?>
            >
        </div>
        <div class="mb-3">
            <label for="inputEmail" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="inputEmail" name="email"
                    <?php if (isset($resultado)){echo "value='".$_POST['email']."'";}?>
            >
        </div>
        <div class="mb-3">
            <label for="inputPassword" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="password" id="inputPassword"
                    <?php if (isset($resultado)){echo "value='".$_POST['password']."'";}?>
            >
        </div>
        <div class="mb-3">
            <label for="inputBirthdate" class="form-label">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="inputBirthdate" name="birthdate"
                    <?php if (isset($resultado)){echo "value='".$_POST['birthdate']."'";}?>
            >
        </div>
        <div class="mb-3">
            <select class="form-select" id="selectType" name="type">
                <option selected>Seleccione el tipo de usuario</option>
                <option value="admin"
                        <?php if (isset($resultado) && $_POST['type']=='admin'){echo "selected";}?>
                >Admin</option>
                <option value="editor"
                        <?php if (isset($resultado) && $_POST['type']=='editor'){echo "selected";}?>
                >Editor</option>
                <option value="regular"
                        <?php if (isset($resultado) && $_POST['type']=='regular'){echo "selected";}?>
                >Regular</option>
                <option value="advertising"
                        <?php if (isset($resultado) && $_POST['type']=='advertising'){echo "selected";}?>
                >Advertising</option>
            </select>
        </div>
        <?php if (isset($resultado)) { ?>
            <div class="mb-3">
                <div class="p-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3">
                    <?php foreach ($resultado as $error) {echo $error."</br>";}?>
                </div>
            </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>

<?php
include_once DIRECTORIO_BACKEND . "/templates/partials/footer.admin.php";