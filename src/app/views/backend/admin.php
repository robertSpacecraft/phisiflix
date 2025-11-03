<?php
$titulo = "Administración de Physics";
$tituloSeccion = "Resumen";
include_once "./app/views/backend/templates/partials/head.admin.php";
include_once "./app/views/backend/templates/partials/header.admin.php";
include_once "./app/views/backend/templates/partials/aside.admin.php";
include_once "./app/views/backend/templates/partials/main.header.admin.php";
?>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td>John</td>
            <td>Doe</td>
            <td>@social</td>
        </tr>
        </tbody>
    </table>

<?php
include_once "./app/views/backend/templates/partials/footer.admin.php";