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



$_SESSION['rol_login'];


if (isset($_SESSION['rol_login'])) {

  switch ($_SESSION['rol_login']) {

    case 'Administrador':
      # code...
      $datainsert['menu'] = '
      <a href="index.php?page=interview" class="list-group-item list-group-item-action"><i class="fa fa-question"></i> Entrevistar Estudiante</a>
      <a href="index.php?page=add-student" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i> Matricular Estudiante</a>
      <a href="index.php?page=all-student" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> Todos los Estudiantes</a>
      <a href="index.php?page=all-users" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> Todos los Usuarios</a>
      <a href="index.php?page=user-profile" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> Perfil de Usuario</a>
    ';
      break;
    case 'Secretaria':
      # code...
      $datainsert['menu'] = '
      <a href="index.php?page=add-student" class="list-group-item list-group-item-action"><i class="fa fa-user-plus"></i> Matricular Estudiante</a>
      <a href="index.php?page=all-student" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> Todos los Estudiantes</a>
      <a href="index.php?page=user-profile" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> Perfil de Usuario</a>
    ';
      break;
    case 'Psicologo':
      # code...
      $datainsert['menu'] = '
      <a href="index.php?page=interview" class="list-group-item list-group-item-action"><i class="fa fa-question"></i> Entrevistar Estudiante</a>
      <a href="index.php?page=all-student" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> Todos los Estudiantes</a>
      <a href="index.php?page=user-profile" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> Perfil de Usuario</a>
    ';
      break;
    case 'Otro':
      # code...

      $datainsert['menu'] = '
      <a href="index.php?page=all-student" class="list-group-item list-group-item-action"><i class="fa fa-users"></i> Todos los Estudiantes</a>
      <a href="index.php?page=user-profile" class="list-group-item list-group-item-action"><i class="fa fa-user"></i> Perfil de Usuario</a>
    ';
      break;

    default:
      # code...
      break;
  }
}






?>
<h1 class="text-primary"><i class="fas fa-users"></i> Todos los Usuario<small class="text-warning"> Lista de Usuarios</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
    <li class="breadcrumb-item active" aria-current="page">Todos los Usuarios</li>
  </ol>
</nav>

<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">N°</th>
      <th scope="col">Nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Usuario</th>
      <th scope="col">Estado</th>
      <th scope="col">X</th>


    </tr>
  </thead>
  <tbody>
    <?php
    $query = mysqli_query($conexion, 'SELECT * FROM `users` where rol != "administrador";');
    $i = 1;
    while ($result = mysqli_fetch_array($query)) { ?>
      <tr>
        <?php


        echo
        '<td>' . $i . '</td>
          <td>' . ucwords($result['name']) . '</td>
          <td>' . $result['email'] . '</td>
          <td>' . ucwords($result['username']) . '</td>
          <td class="estado"> ' . $result['status'] . '</td>
          <td>
 <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="index.php?page=delete&id=' . base64_encode($result['id']) . '&photo=' . base64_encode($result['photo']) . '">
             <i class="fas fa-trash-alt"></i></a></td>';
        ?>
      </tr>
    <?php $i++;
    } ?>

  </tbody>
</table>

<br><br>
<div class="form-group text-right" id="guardar-cambios-container">
</div>

<!-- ELIMINAR  -->
<script type="text/javascript">
  function confirmationDelete(anchor) {
    var conf = confirm('¿Está seguro de que desea eliminar este Usuario?');
    if (conf)
      window.location = anchor.attr("btn btn-danger");
  }
</script>

<!-- CAMBIAR ROL  -->
<script>
  const celdasEstado = document.querySelectorAll('.estado');
  const guardarCambiosContainer = document.getElementById('guardar-cambios-container');
  const select = document.createElement('select');
  const optionActivo = document.createElement('option');
  const optionInactivo = document.createElement('option');
  const botonGuardar = document.createElement('button');

  optionActivo.value = 'Activo';
  optionActivo.textContent = 'Activo';
  optionInactivo.value = 'Inactivo';
  optionInactivo.textContent = 'Inactivo';

  select.appendChild(optionActivo);
  select.appendChild(optionInactivo);

  botonGuardar.textContent = 'Guardar cambios';
  botonGuardar.addEventListener('click', () => {
    const celdasEditables = document.querySelectorAll('.editable');
    celdasEditables.forEach(celda => {
      const valorNuevo = celda.querySelector('select').value;
      celda.textContent = valorNuevo;
      celda.classList.remove('editable');
    });
    guardarCambiosContainer.removeChild(botonGuardar);
    guardarCambiosContainer.removeChild(select);
  });

  celdasEstado.forEach(celda => {
    celda.addEventListener('click', () => {
      if (celda.classList.contains('editable')) return;
      const valorActual = celda.textContent.trim();
      select.value = valorActual;
      celda.textContent = '';
      celda.appendChild(select.cloneNode(true));
      celda.classList.add('editable');
      guardarCambiosContainer.appendChild(botonGuardar);
      botonGuardar.className +="btn btn-danger";

    });
  });
</script>