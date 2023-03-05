<?php
include('./conexion.php');

// control de estructura de endpoint en el navegador (URL) 
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: index.php?page=' . $corepage[0]);
	}
}

if (isset($_POST['addstudent'])) {



	// INFORMACIÓN DEL ESTUDIANTE 

	$matricula = $_POST['matricula'];						//	
	$photo = explode('.', $_FILES['photo']['name']);		//
	$photo = end($photo);									//
	$photo = $matricula . date('Y-m-d-m-s') . '.' . $photo; //
	$tipo = $_POST['check_new_estudiante'];					//
	$last_name = $_POST['last_name'];						//
	$name = $_POST['name'];									//
	$grado_estudiantil = $_POST['grado_estudiantil'];		//
	$birthdate = $_POST['birthdate'];						//
	$nacionalidad = $_POST['nacionalidad'];					//
	$sexo = $_POST['sexo'];									//
	$address = $_POST['address'];							//
	$sector = $_POST['sector'];								//
	$descuento = $_POST['descuento'];						//
	$observaciones = $_POST['observaciones'];				//

	$query_estudiante = "INSERT INTO `student_info` ( `matricula`, `tipo`, `last_name`, `name`, `grado_estudiantil`, `birthdate`, `nacionalidad`, `sexo`, `direccion`, `sector`, `photo`, `observaciones`, `descuento`) 
	VALUES ('$matricula', '$tipo', '$last_name', '$name', '$grado_estudiantil', '$birthdate', '$nacionalidad', '$sexo', '$address', '$sector', '$photo', '$observaciones', '$descuento');";

	if (mysqli_query($conexion, $query_estudiante)) {
		move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo);
		$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
		mysqli_close($conexion);
	} else {
		$datainsert['inserterror'] = '<p style="color: red;">Estudiante no ingresado, revise la información diligenciada.</p>';
		mysqli_close($conexion);
	}
}
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Entrevista del Estudiante<small class="text-warning"> Nuevo Estudiante</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
		<li class="breadcrumb-item active" aria-current="page">Registrar estudiante</li>
	</ol>
</nav>
<br><br>
<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">

	<h5>ENTREVISTA PREVIA AL INGRESO DE NUEVOS ESTUDIANTES</h5>
	<hr>
	<h4>Datos Generales</h4>
</ol>
<br>


<div class="row">
	<div class="col-sm-12">
		<?php if (isset($datainsert)) { ?>
			<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="20000">
				<div class="toast-header">
					<strong class="mr-auto">Alerta de matriculación</strong>
					<small><?php echo date('d-M-Y'); ?></small>
					<button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="toast-body">
					<?php
					if (isset($datainsert['insertsucess'])) {
						echo $datainsert['insertsucess'];
					}
					if (isset($datainsert['inserterror'])) {
						echo $datainsert['inserterror'];
					}
					?>
				</div>
			</div>
		<?php } ?>


		<form enctype="multipart/form-data" method="POST">


			<div class="form-group">
				<label for="last_name">Apellidos</label>
				<input name="last_name" type="text" class="form-control" id="last_name" value="<?= isset($last_name) ? $last_name : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="name">Nombres</label>
				<input name="name" type="text" class="form-control" id="name" value="<?= isset($name) ? $name : ''; ?>" required="">
			</div>


			<div class="form-group">
				<label for="name">Lugar de nacimiento</label>
				<input name="name" type="text" class="form-control" id="name" value="<?= isset($name) ? $name : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="birthdate">Fecha de nacimiento</label>
				<input name="birthdate" type="date" class="form-control" id="birthdate" value="<?= isset($birthdate) ? $birthdate : '2000/01/01'; ?>" required="">
			</div>

			<div class="form-group">
				<label for="address">Dirección</label>
				<input name="address" type="text" value="<?= isset($address) ? $address : ''; ?>" class="form-control" id="address" required="">
			</div>


			<div class="form-group">
				<label for="class">Año de educación que aplica</label>
				<select name="grado_estudiantil" class="form-control" id="grado_estudiantil" required="">
					<option>Selecciona</option>
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
			</div>


			<div class="form-group">
				<label for="nacionalidad">Institución que procede</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="nacionalidad">Promedio general del período escolar anterior</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">Conducta</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">Razón por la que busca s}ser parte de esta institución</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">Razón del cambio de instituto</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">En la institución anterior, ¿Tuvo algún altercado?</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="nacionalidad">Correo electrónico</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="nacionalidad">Celular</label>
				<input name="nacionalidad" type="number" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>


			<br><br><br><br>
			<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
				<h4>Historia Familiar</h4>
			</ol>
			<br><br>
			<div class="form-group">
				<label for="nacionalidad">Nombre del respresentante o tutor</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">Nombre del padre</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">Ocupación</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">Lugar de trabajo</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">Nombre de la madre</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">Ocupación</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">Lugar de trabajo</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<br>
			<label for="nacionalidad">Estado Civil</label>
			<div style="display: flex; padding: 10px;">
				<label for="check_new_estudiante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Soltero</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('Nuevo')" style="height: 30px !important; width: 20px;" value="s" required="">


				<label for="check_new_estudiante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Casado</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('uepp')" style="height: 30px !important; width: 20px;" value="UEPP" required="">


				<label for="check_new_estudiante" style="width: 80px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Divorciado</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('Nuevo')" style="height: 30px !important; width: 20px;" value="s" required="">


				<label for="check_new_estudiante" style="width: 100px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Unión Libre</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('uepp')" style="height: 30px !important; width: 20px;" value="UEPP" required="">

			</div>


			<br>
			<label for="nacionalidad">Relacion de los miembros de la familia</label>
			<div style="display: flex; padding: 10px;">
				<label for="check_new_estudiante" style="width: 100px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Muy buena</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('Nuevo')" style="height: 30px !important; width: 20px;" value="s" required="">


				<label for="check_new_estudiante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Buena</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('uepp')" style="height: 30px !important; width: 20px;" value="UEPP" required="">


				<label for="check_new_estudiante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Regular</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('Nuevo')" style="height: 30px !important; width: 20px;" value="s" required="">


				<label for="check_new_estudiante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Mala</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('uepp')" style="height: 30px !important; width: 20px;" value="UEPP" required="">

			</div>

			<div class="form-group">
				<label for="nacionalidad">¿Con quien pasa el estudiante en las mañanas?</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="nacionalidad">¿Que planes de estudio tiene para el o para el estudiante en el futuro?</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="nacionalidad">En la tareas para cada estudiante, ¿Cómo las desarrolla?</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>



			<br>
			<label for="nacionalidad">¿Quien sustenta los gastos de la familia?</label>
			<div style="display: flex; padding: 10px;">
				<label for="check_new_estudiante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Madre</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('Nuevo')" style="height: 30px !important; width: 20px;" value="s" required="">


				<label for="check_new_estudiante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Padre</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('uepp')" style="height: 30px !important; width: 20px;" value="UEPP" required="">


				<label for="check_new_estudiante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Ambos</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('Nuevo')" style="height: 30px !important; width: 20px;" value="s" required="">


				<label for="check_new_estudiante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Otros</label>
				<input name="check_new_estudiante" type="radio" class="form-control" onchange="verifica_seleccion_estudiante('uepp')" style="height: 30px !important; width: 20px;" value="UEPP" required="">

			</div>



			<br>
			<br>
			<br>
			<!-- BOTON DE AGREGAR  -->
			<div class="form-group text-center">
				<input name="addstudent" value="Agregar Estudiante" type="submit" class="btn btn-danger">
			</div>






		</form>
	</div>

</div>