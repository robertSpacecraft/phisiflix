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
    <form method="post" action="/physic" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="formControlNombre" class="form-label">Nombre del físico:</label>
            <input type="text" class="form-control" id="formControlNombre" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="formControlApellido" class="form-label">Apellido:</label>
            <input type="text" class="form-control" id="formControlApellido" name="apellido">
        </div>
        <div class="mb-3">
            <label for="fromControlGenero" class="form-label">Género:</label>
            <select id="formControlGenero" name="genero" class="form-select">
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="no_aplica" selected>No aplica</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="formControlLugar_nac" class="form-label">Lugar de Nacimiento:</label>
            <input type="text" class="form-control" id="formControlLugar_nac" name="lugar_nac">
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
            <input type="text" class="form-control" id="formControlEtiquetas" name="etiquetas" placeholder="ej. relatividad, óptica, radiación...">
        </div>
        <div class="mb-3">
            <label for="formControlFoto" class="form-label">Subir foto:</label>
            <input type="file" class="form-control" name="foto" id="formControlFoto" accept="image/*">
        </div>

        <!--Faltaría definir este campo correctamente -->
        <div class="mb-3">
            <label for="formControlHito" class="form-label">Hitos:</label>
            <input type="text" class="form-control" id="formControlHito">
        </div>

        <button type="submit" class="btn btn-primary">Crear Físico</button>
    </form>


<?php
include_once DIRECTORIO_BACKEND."/templates/partials/footer.admin.php";