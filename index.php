<?php
include('./admin/conexion.php'); ?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title>Matrícula de Estudiantes</title>
</head>

<body>
  <div class="container"><br>
    <a class="btn btn-primary float-right" href="admin/login.php">Panel Administrativo</a>
    <h1 class="text-center">Sistema de Matrícula de Estudiantes</h1><br>

    <div class="row">
      <div class="col-md-4 offset-md-4">
        <form method="POST">
          <table class="text-center infotable">
            <tr>
              <th colspan="2">
                <p class="text-center">Información del Estudiante</p>
              </th>
            </tr>
            <tr>
              <td>
                <p><label for="roll">Número de Cédula</label></p>
              </td>
              <td>
                <input maxlength="10" placeholder="Cédula" onclick="validarCedula(this.value)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="cedula" type="text" class="form-control" id="cedula" required="">
              </td>
            </tr>
            <tr>
              <td colspan="2" class="text-center">
                <input class="btn btn-danger" type="submit" name="showinfo">
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <br>
    <?php if (isset($_POST['showinfo'])) {
      $cedula = $_POST['cedula'];
      if (!empty($cedula)) {
        $query = mysqli_query($conexion, "SELECT * FROM student_info WHERE cedula='$cedula'");
        if (!empty($row = mysqli_fetch_array($query))) {
          if ($row['cedula'] == $cedula) {
            $matricula = $row['matricula'];
            $stname = $row['name'] . " " . $row['last_name'];
            $grado_estudiantil = $row['grado_estudiantil'];
            $nacionalidad = $row['nacionalidad'];
            $photo = $row['photo'];
            $observaciones = $row['observaciones'];
            $direccion = $row['direccion'];
    ?>
            <div class="row">
              <div class="col-sm-7 offset-sm-2">
                <table class="table table-bordered">
                  <tr>
                    <td rowspan="5">
                      <h3>Información de Estudiante</h3><img class="img-thumbnail" src="admin/images/<?= isset($photo) ? $photo : ''; ?>" width="250px">
                    </td>
                    <td>Estudiante</td>
                    <td><?= isset($stname) ? $stname : ''; ?></td>
                  </tr>
                  <tr>
                    <td>Número de Matrícula</td>
                    <td><?= isset($matricula) ? $matricula : ''; ?></td>
                  </tr>
                  <tr>
                    <td>Grado estudiantil</td>
                    <td><?= isset($grado_estudiantil) ? $grado_estudiantil : ''; ?></td>
                  </tr>
                  <tr>
                    <td>Dirección</td>
                    <td><?= isset($direccion) ? $direccion : ''; ?></td>
                  </tr>
                  <tr>
                    <td>Observaciones</td>
                    <td><?= isset($observaciones) ? $observaciones : ''; ?></td>
                  </tr>
                </table>
              </div>
            </div>
        <?php
          } else {
            echo '<p style="color:red;">Por favor ingrese un número válido de matricula y grado</p>';
          }
        } else {
          echo '<p style="color:red;">Tu información ingresada no coincide</p>';
        }
      } else { ?>
        <script type="text/javascript">
          alert("Datos no encontrados");
        </script>
    <?php }
    }; ?>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="js/jquery-3.5.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</body>
<script>
  function validarCedula(cedula) {
    // Verificar que la cédula tiene 10 dígitos
    if (cedula.length !== 10) {
      return false;
    }

    // Verificar que la cédula está compuesta solo de dígitos
    if (!/^\d+$/.test(cedula)) {
      return false;
    }

    // Verificar el dígito verificador
    var digitoVerificador = parseInt(cedula.charAt(9));
    var suma = 0;
    var coeficientes = [2, 1, 2, 1, 2, 1, 2, 1, 2];
    for (var i = 0; i < 9; i++) {
      var digito = parseInt(cedula.charAt(i)) * coeficientes[i];
      if (digito > 9) {
        digito -= 9;
      }
      suma += digito;
    }
    var resultado = (suma % 10 === 0) ? 0 : 10 - (suma % 10);

    if (resultado === digitoVerificador) {} else {
      alert("Cedula No Valida");
    }
  }
</script>

</html>