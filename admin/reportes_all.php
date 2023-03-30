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

<form method="post" target="_blank" id="form_reporte">
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
        </i><input type="submit" class="btn btn-danger" value="Crear PDF"></input>
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
        <a type="submit" target="_blank" href="/admin/reporte_general.php" class="btn btn-danger">Crear PDF</a>
    </div>
</div>
<br>
<hr>
<script>
  const form = document.querySelector('#form_reporte');
  form.addEventListener('submit', (event) => {
    event.preventDefault();
    const opciones = document.querySelector('#curso_reporte');
    const seleccion = opciones.options[opciones.selectedIndex].value;
    window.open(`reporte_curso.php?seleccion=${seleccion}`, '_blank');
  });
</script>