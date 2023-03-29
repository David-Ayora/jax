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

<h1><a href="index.php"><i class="fas fa-tachometer-alt"></i> Panel de Control</a> <small>Vista General</small></h1>
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user" style="margin-right: 15px; margin-top:4px ;"></i> Escritorio</li>
  </ol>
</nav>
<div class="row student">
  <div class="col-sm-4">
    <div class="card text-white bg-primary mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-4">
            <i class="fa fa-users fa-3x"></i>
          </div>
          <div class="col-sm-8">
            <div class="float-sm-right">&nbsp;<span style="font-size: 30px">
                <?php $stu = mysqli_query($conexion, 'SELECT * FROM `student_info`');
                $stu = mysqli_num_rows($stu);
                echo $stu; ?></span></div>
            <div class="clearfix"></div>
            <div class="float-sm-right">Total de Estudiantes</div>
          </div>
        </div>
      </div>
      <div class="list-group-item-primary list-group-item list-group-item-action">
        <div class="row">
          <div class="col-sm-8">
            <p class="">Ver Estudiantes</p>
          </div>
          <div class="col-sm-4">
            <a href="all-student.php"><i class="fa fa-arrow-right float-sm-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card text-white bg-info mb-3">
      <div class="card-header">
        <div class="row">
          <div class="col-sm-4">
            <i class="fa fa-users fa-3x"></i>
          </div>
          <div class="col-sm-8">
            <div class="float-sm-right">&nbsp;
              <span style="font-size: 30px">
                <?php $tusers = mysqli_query($conexion, 'SELECT * FROM `users`');
                $tusers = mysqli_num_rows($tusers);
                echo $tusers; ?>
              </span>
            </div>
            <div class="clearfix"></div>
            <div class="float-sm-right">Total de Usuarios</div>
          </div>
        </div>
      </div>
      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="index.php?page=all-users">
          <div class="row">
            <div class="col-sm-8">
              <p class="">Ver Usuarios</p>
            </div>
            <div class="col-sm-4">
              <i class="fa fa-arrow-right float-sm-right"></i>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="col-sm-4">
    <div class="card text-white bg-warning mb-3">
      <div class="card-header">
        <div class="row">
          <?php $usernameshow = $_SESSION['user_login'];
          $userspro = mysqli_query($conexion, "SELECT * FROM `users` WHERE `username`='$usernameshow';");
          $userrow = mysqli_fetch_array($userspro); ?>
          <div class="col-sm-6">
            <img class="showimg" src="images/<?php echo $userrow['photo']; ?>">
            <div style="font-size: 20px"><?php echo ucwords($userrow['name']); ?></div>
          </div>
          <div class="col-sm-6">

            <div class="clearfix"></div>
            <div class="float-sm-right">Bienvenido</div>
          </div>
        </div>
      </div>
      <div class="list-group-item-primary list-group-item list-group-item-action">
        <a href="index.php?page=user-profile">
          <div class="row">
            <div class="col-sm-8">
              <p class="">Tu perfil</p>
            </div>
            <div class="col-sm-4">
              <i class="fa fa-arrow-right float-sm-right"></i>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<hr>

<h3>Reporte de Entrevistados</h3>
<table class="table  table-striped table-hover table-bordered" id="data">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Ficha</th>
      <th scope="col">Cédula</th>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Dirección</th>
      <th scope="col">Aplica</th>
      <th scope="col">Promedio</th>
      <th scope="col">Acción</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $query = mysqli_query($conexion, 'SELECT * FROM `entrevista_estudiante` WHERE `entrevista_estudiante`.`ps_cupo` = "Asignado" ORDER BY `entrevista_estudiante`.`id_ficha` ASC; ');

    while ($result = mysqli_fetch_array($query)) { 
      
      ?>

      <tr>
        <?php
        echo 
        '
        <td>' . $result['id_ficha'] . '</td>
        <td>' . $result['ps_cedula'] . '</td>
          <td>' . ucwords($result['ps_nombre']) . '</td>
          <td>' . ucwords($result['ps_apellido']) . '</td>
          <td>' . ucwords($result['ps_direccion']) . '</td>
          <td>' . ucwords($result['ps_año_aplica']) . '</td>
          <td>' . $result['ps_promedio'] . '</td>
          
          <td>
          <a class="btn btn-xs btn-success" href="index.php?page=add-student-dashboard&cedula=' . base64_encode($result['ps_cedula']) . '&grado=' . base64_encode($result['ps_año_aplica']) . '&nombre=' . base64_encode($result['ps_nombre'])  . '&apellido=' . base64_encode($result['ps_apellido'])  . '&fecha_nacimiento=' . base64_encode($result['ps_fecha'])  . '&direccion=' . base64_encode($result['ps_direccion'])  . '&descuento=' . base64_encode($result['ps_descuento']) . '">
          <i class="fa fa-save"></i></a>
          
          <a class="btn btn-xs btn-warning" href="index.php?page=edit_interview&id=' . base64_encode($result['id_ficha']) . '&name=' . base64_encode($result['ps_nombre']) . '">
          <i class="fa fa-edit"></i></a>
          

             &nbsp; <a class="btn btn-xs btn-danger" onclick="javascript:confirmationDelete($(this));return false;" href="index.php?page=delete_interview&id=' . base64_encode($result['id_ficha']) . '">
             <i class="fas fa-trash-alt"></i></a></td>'; ?>
      </tr>
    <?php
    } ?>

  </tbody>
</table>

<script type="text/javascript">
  function confirmationDelete(anchor) {
    var conf = confirm('Estás seguro que deseas eliminar este registro, esta opción es irreversible');
    if (conf)
      window.location = anchor.attr("href");
  }
</script>