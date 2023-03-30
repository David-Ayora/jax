<?php
include('./conexion.php');
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
    if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: index.php?page=' . $corepage[0]);
    }
}

?>

<h1 class="text-primary"><i class="fas fa-users"></i> Todos los Estudiantes<small class="text-warning"> Lista de Estudiantes</small></h1>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
        <li class="breadcrumb-item active" aria-current="page">Listado Estudiantes</li>
    </ol>
</nav>
<br>

<form method="post" id="form_reporte_curso">
    <div style="display: flex;">
        <div style="flex: 3;">
            <h4>Estudiantes por curso</h4>
            <p style="font-size: 12px;">Puedes crear un reporte de estudiante por curso.</p>
        </div>

        <div style="flex: 4;">

            <p>Selecciona un curso</p>

            <select style="width: 250px;" class="form-control" name="curso_reporte" id="curso_reporte">
                <option disabled>Selecciona</option>
                <option value="Primero">Primero</option>
                <option value="Segundo">Segundo</option>
                <option value="Tercero">Tercero</option>
                <option value="Cuarto">Cuarto</option>
                <option value="Quinto">Quinto</option>
                <option value="Sexto">Sexto</option>
                <option value="Septimo">Septimo</option>
                <option value="Octavo">Octavo</option>
                <option value="Noveno">Noveno</option>
                <option value="Decimo">Decimo</option>
                <option value="Primero BGU">Primero BGU</option>
                <option value="Segundo BGU">Segundo BGU</option>
                <option value="Tercero BGU">Tercero BGU</option>
            </select>
            </select>
        </div>

        <div style="flex: 1;">
        <i class="fas fa-print"></i><input type="submit" class="btn btn-danger" value="Crear PDF"></input>
        </div>
        <br>
</form>
</div>
<br>
<hr>





<div style="display: flex;">
    <div style="flex: 7;">
        <h4>Total de estudiantes</h4>
        <p style="font-size: 12px;">Crea un reporte general de la cantidad de estudiantes en la unidad educativa</p>
    </div>

    <div style="flex: 1;">
        <a type="submit" target="_blank" href="/admin/reporte_general.php" class="btn btn-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf-fill" viewBox="0 0 16 16">
                <path d="M5.523 12.424c.14-.082.293-.162.459-.238a7.878 7.878 0 0 1-.45.606c-.28.337-.498.516-.635.572a.266.266 0 0 1-.035.012.282.282 0 0 1-.026-.044c-.056-.11-.054-.216.04-.36.106-.165.319-.354.647-.548zm2.455-1.647c-.119.025-.237.05-.356.078a21.148 21.148 0 0 0 .5-1.05 12.045 12.045 0 0 0 .51.858c-.217.032-.436.07-.654.114zm2.525.939a3.881 3.881 0 0 1-.435-.41c.228.005.434.022.612.054.317.057.466.147.518.209a.095.095 0 0 1 .026.064.436.436 0 0 1-.06.2.307.307 0 0 1-.094.124.107.107 0 0 1-.069.015c-.09-.003-.258-.066-.498-.256zM8.278 6.97c-.04.244-.108.524-.2.829a4.86 4.86 0 0 1-.089-.346c-.076-.353-.087-.63-.046-.822.038-.177.11-.248.196-.283a.517.517 0 0 1 .145-.04c.013.03.028.092.032.198.005.122-.007.277-.038.465z" />
                <path fill-rule="evenodd" d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3zM4.165 13.668c.09.18.23.343.438.419.207.075.412.04.58-.03.318-.13.635-.436.926-.786.333-.401.683-.927 1.021-1.51a11.651 11.651 0 0 1 1.997-.406c.3.383.61.713.91.95.28.22.603.403.934.417a.856.856 0 0 0 .51-.138c.155-.101.27-.247.354-.416.09-.181.145-.37.138-.563a.844.844 0 0 0-.2-.518c-.226-.27-.596-.4-.96-.465a5.76 5.76 0 0 0-1.335-.05 10.954 10.954 0 0 1-.98-1.686c.25-.66.437-1.284.52-1.794.036-.218.055-.426.048-.614a1.238 1.238 0 0 0-.127-.538.7.7 0 0 0-.477-.365c-.202-.043-.41 0-.601.077-.377.15-.576.47-.651.823-.073.34-.04.736.046 1.136.088.406.238.848.43 1.295a19.697 19.697 0 0 1-1.062 2.227 7.662 7.662 0 0 0-1.482.645c-.37.22-.699.48-.897.787-.21.326-.275.714-.08 1.103z" />
            </svg> Crear PDF</a>
    </div>
</div>
<br>
<hr>