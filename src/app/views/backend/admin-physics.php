<?php
$titulo = "Administración de Physics";
$tituloSeccion = "Resumen";
include_once DIRECTORIO_BACKEND."/templates/partials/head.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/header.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/aside.admin.php";
include_once DIRECTORIO_BACKEND."/templates/partials/main.header.admin.php";
$physics = [
        [
                'nombre' => 'Isaac',
                'apellido' => 'Newton',
                'genero' => 'Masculino',
                'nacionalidad' => 'Británica',
                'Descripción' => 'Formuló las leyes del movimiento y la gravitación universal, fundamentos de la física clásica.'
        ],
        [
                'nombre' => 'Albert',
                'apellido' => 'Einstein',
                'genero' => 'Masculino',
                'nacionalidad' => 'Alemana',
                'Descripción' => 'Desarrolló la teoría de la relatividad, revolucionando la comprensión del espacio y el tiempo.'
        ],
        [
                'nombre' => 'Max',
                'apellido' => 'Planck',
                'genero' => 'Masculino',
                'nacionalidad' => 'Alemana',
                'Descripción' => 'Fundador de la teoría cuántica, introdujo el concepto de cuanto de energía.'
        ],
        [
                'nombre' => 'Erwin',
                'apellido' => 'Schrödinger',
                'genero' => 'Masculino',
                'nacionalidad' => 'Austriaca',
                'Descripción' => 'Desarrolló la ecuación de onda de Schrödinger, base de la mecánica cuántica moderna.'
        ]
];

?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Género</th>
            <th scope="col">Nacionalidad</th>
            <th scope="col">Descripción</th>
        </tr>
        </thead>
        <tbody>
        <?php
            for ($i = 0; $i < count($physics); $i++) {
                echo "<tr><th scope='row'>" . $i + 1 . "</th>";
                echo "<td>" . $physics[$i]['nombre'] . "</td>";
                echo "<td>" . $physics[$i]['apellido'] . "</td>";
                echo "<td>" . $physics[$i]['genero'] . "</td>";
                echo "<td>" . $physics[$i]['nacionalidad'] . "</td>";
                echo "<td>" . $physics[$i]['Descripción'] . "</td>";
                echo "</tr>";
            }
        ?>
        </tbody>
    </table>

<?php
include_once DIRECTORIO_BACKEND."/templates/partials/footer.admin.php";