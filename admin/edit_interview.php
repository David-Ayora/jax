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

// Ficha de al fila 
$id_ficha = base64_decode($_GET['id']);




if (isset($_POST['entrevista'])) {


	// DATOS GENERALES

	$ps_nombre = $_POST['ps_nombre'];
	$ps_apellido = $_POST['ps_apellido'];
	$ps_lugar_nacimiento = $_POST['ps_lugar_nacimiento'];
	$ps_fecha = $_POST['ps_fecha'] . date("MM-DD-YYYY");
	$ps_direccion = $_POST['ps_direccion'];
	$ps_año_aplica = $_POST['ps_año_aplica'];
	$ps_ist_procede = $_POST['ps_ist_procede'];
	$ps_promedio = $_POST['ps_promedio'];
	$ps_conducta = $_POST['ps_conducta'];
	$ps_razon = $_POST['ps_razon'];
	$ps_razon_cambio = $_POST['ps_razon_cambio'];
	$ps_altercado = $_POST['ps_altercado'];
	$ps_email = $_POST['ps_email'];
	$ps_celular = $_POST['ps_celular'];

	$query_select_entrevistado = "UPDATE entrevista_estudiante SET 
	ps_nombre = '$ps_nombre', 
	ps_apellido = '$ps_apellido', 
	ps_lugar_nacimiento = '$ps_lugar_nacimiento', 
	ps_fecha = '$ps_fecha',
	ps_direccion = '$ps_direccion', 
	ps_año_aplica = '$ps_año_aplica',
	ps_ist_procede = '$ps_ist_procede', 
	ps_promedio = '$ps_promedio', 
	ps_conducta = '$ps_conducta', 
	ps_razon = '$ps_razon', 
	ps_razon_cambio = '$ps_razon_cambio', 
	ps_altercado = '$ps_altercado', 
	ps_email = '$ps_email', 
	ps_celular = '$ps_celular' 
	WHERE id_ficha = $id_ficha;";


	// HISTORIA FAMILIAR

	$ps_nombre_representante = $_POST['ps_nombre_representante'];
	$ps_nombre_padre = $_POST['ps_nombre_padre'];
	$ps_ocupacion_padre = $_POST['ps_ocupacion_padre'];
	$ps_lugar_trabajo_padre = $_POST['ps_lugar_trabajo_padre'];
	$ps_nombre_madre = $_POST['ps_nombre_madre'];
	$ps_ocupacion_madre = $_POST['ps_ocupacion_madre'];
	$ps_lugar_trabajo_madre = $_POST['ps_lugar_trabajo_madre'];
	$ps_estado_civil_representante = $_POST['ps_estado_civil_representante'];
	$ps_relacion_familiar = $_POST['ps_relacion_familiar'];
	$ps_tiempo_con_estudiante = $_POST['ps_tiempo_con_estudiante'];
	$ps_futuro_para_estudiante = $_POST['ps_futuro_para_estudiante'];
	$ps_desarrollo_academico_estudiante = $_POST['ps_desarrollo_academico_estudiante'];
	$ps_gastos_familiar = $_POST['ps_gastos_familiar'];



	$query_update_familiar = "UPDATE entrevista_historia_familiar SET 
	ps_nombre_representante = '$ps_nombre_representante', 
	ps_nombre_padre = '$ps_nombre_padre',
	ps_ocupacion_padre = '$ps_ocupacion_padre',
	ps_lugar_trabajo_padre = '$ps_lugar_trabajo_padre',
	ps_nombre_madre = '$ps_nombre_madre',
	ps_ocupacion_madre = '$ps_ocupacion_madre',
	ps_lugar_trabajo_madre = '$ps_lugar_trabajo_madre',
	ps_estado_civil_representante = '$ps_estado_civil_representante',
	ps_relacion_familiar = '$ps_relacion_familiar',
	ps_tiempo_con_estudiante = '$ps_tiempo_con_estudiante', 
	ps_futuro_para_estudiante = '$ps_futuro_para_estudiante', 
	ps_desarrollo_academico_estudiante = '$ps_desarrollo_academico_estudiante', 
	ps_gastos_familiar = '$ps_gastos_familiar' WHERE id_ficha = $id_ficha;";

	if (mysqli_query($conexion, $query_update_familiar)) {
		if (mysqli_query($conexion, $query_select_entrevistado)) {
			$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Actualizado!</p>';
		} else {
			header('Location: index.php?page=dashboard&edit=success');
		}
	} else {

		header('Location: index.php?page=dashboard&edit=error');
	}
}
?>

<?php

// Entrevistado
if (isset($id_ficha)) {
	$query_select = "SELECT * FROM `entrevista_estudiante` WHERE `id_ficha`=$id_ficha";
	$result = mysqli_query($conexion, $query_select);
	$row = mysqli_fetch_array($result);
}

// Familiar
if (isset($id_ficha)) {
	$query_select_familiar = "SELECT * FROM `entrevista_historia_familiar` WHERE `id_ficha`=$id_ficha";
	$result_familiar = mysqli_query($conexion, $query_select_familiar);
	$row_f = mysqli_fetch_array($result_familiar);
}
?>

<h1 class="text-primary"><i class="fa fa-question"></i> Entrevista<small class="text-warning"> Asignación de cupo</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
		<li class="breadcrumb-item active" aria-current="page">Editar entrevistar</li>
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
		<?php
		if (isset($datainsert)) {
		?>
			<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="20000">
				<div class="toast-header">
					<strong class="mr-auto">Alerta de matriculación</strong>
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
		<?php
		}
		?>


		<form enctype="multipart/form-data" method="POST">


			<div class="form-group">
				<label for="ps_apellido">Apellidos</label>
				<input name="ps_apellido" type="text" class="form-control" id="ps_apellido" value="<?php echo $row['ps_apellido']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_nombre">Nombres</label>
				<input name="ps_nombre" type="text" class="form-control" id="ps_nombre" value="<?php echo $row['ps_nombre']; ?>" required="">
			</div>


			<div class="form-group">
				<label for="ps_lugar_nacimiento">Lugar de nacimiento</label>
				<input name="ps_lugar_nacimiento" type="text" class="form-control" id="ps_lugar_nacimiento" value="<?php echo $row['ps_lugar_nacimiento']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_fecha">Fecha de nacimiento</label>
				<input name="ps_fecha" type="date" class="form-control" id="ps_fecha" value="<?php echo $row['ps_fecha']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_direccion">Dirección</label>
				<input name="ps_direccion" type="text" value="<?php echo $row['ps_direccion']; ?>" class="form-control" id="ps_direccion" required="">
			</div>


			<div class="form-group">
				<label for="class">Año de educación que aplica</label>
				<select name="ps_año_aplica" class="form-control" id="ps_año_aplica" required="">
					<option>Selecciona</option>
					<option value="Primero" <?= $row['ps_año_aplica'] == 'Primero' ? 'selected' : '' ?>>Primero</option>
					<option value="Segundo" <?= $row['ps_año_aplica'] == 'Segundo' ? 'selected' : '' ?>>Segundo</option>
					<option value="Tercero" <?= $row['ps_año_aplica'] == 'Tercero' ? 'selected' : '' ?>>Tercero</option>
					<option value="Cuarto" <?= $row['ps_año_aplica'] == 'Cuarto' ? 'selected' : '' ?>>Cuarto</option>
					<option value="Quinto" <?= $row['ps_año_aplica'] == 'Quinto' ? 'selected' : '' ?>>Quinto</option>
					<option value="Sexto" <?= $row['ps_año_aplica'] == 'Sexto' ? 'selected' : '' ?>>Sexto</option>
					<option value="Septimo" <?= $row['ps_año_aplica'] == 'Septimo' ? 'selected' : '' ?>>Septimo</option>
					<option value="Octavo" <?= $row['ps_año_aplica'] == 'Octavo' ? 'selected' : '' ?>>Octavo</option>
					<option value="Noveno" <?= $row['ps_año_aplica'] == 'Noveno' ? 'selected' : '' ?>>Noveno</option>
					<option value="Decimo" <?= $row['ps_año_aplica'] == 'Decimo' ? 'selected' : '' ?>>Decimo</option>
					<option value="Primero BGU" <?= $row['ps_año_aplica'] == 'Primero BGU' ? 'selected' : '' ?>>Primero BGU</option>
					<option value="Segundo BGU" <?= $row['ps_año_aplica'] == 'Segundo BGU' ? 'selected' : '' ?>>Segundo BGU</option>
					<option value="Tercero BGU" <?= $row['ps_año_aplica'] == 'Tercero BGU' ? 'selected' : '' ?>>Tercero BGU</option>

				</select>
			</div>


			<div class="form-group">
				<label for="ps_ist_procede">Institución que procede</label>
				<input name="ps_ist_procede" type="text" class="form-control" id="ps_ist_procede" value="<?php echo $row['ps_ist_procede']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_promedio">Promedio general del período escolar anterior</label>
				<input name="ps_promedio" type="text" class="form-control" id="ps_promedio" value="<?php echo $row['ps_promedio']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_conducta">Conducta</label>
				<input name="ps_conducta" type="text" class="form-control" id="ps_conducta" value="<?php echo $row['ps_conducta']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_razon">Razón por la que busca ser parte de esta institución</label>
				<input name="ps_razon" type="text" class="form-control" id="ps_razon" value="<?php echo $row['ps_razon']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_razon_cambio">Razón del cambio de instituto</label>
				<input name="ps_razon_cambio" type="text" class="form-control" id="ps_razon_cambio" value="<?php echo $row['ps_razon_cambio']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_altercado">En la institución anterior, ¿Tuvo algún altercado?</label>
				<input name="ps_altercado" type="text" class="form-control" id="ps_altercado" value="<?php echo $row['ps_altercado']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_email">Correo electrónico</label>
				<input name="ps_email" type="text" class="form-control" id="ps_email" value="<?php echo $row['ps_email']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_celular">Celular</label>
				<input name="ps_celular" type="number" class="form-control" id="ps_celular" value="<?php echo $row['ps_celular']; ?>" required="">
			</div>


			<br><br><br><br>
			<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
				<h4>Historia Familiar</h4>
			</ol>
			<br><br>
			<div class="form-group">
				<label for="ps_nombre_representante">Nombre del respresentante o tutor</label>
				<input name="ps_nombre_representante" type="text" class="form-control" id="ps_nombre_representante" value="<?php echo $row_f['ps_nombre_representante']; ?>" required="">
			</div>
			<br><br>
			<Label style="font-size: 30px;">Información del Padre</Label>
			<div class="form-group">
				<label for="ps_nombre_padre">Nombre del padre</label>
				<input name="ps_nombre_padre" type="text" class="form-control" id="ps_nombre_padre" value="<?php echo $row_f['ps_nombre_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_ocupacion_padre">Ocupación</label>
				<input name="ps_ocupacion_padre" type="text" class="form-control" id="ps_ocupacion_padre" value="<?php echo $row_f['ps_ocupacion_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_lugar_trabajo_padre">Lugar de trabajo</label>
				<input name="ps_lugar_trabajo_padre" type="text" class="form-control" id="ps_lugar_trabajo_padre" value="<?php echo $row_f['ps_lugar_trabajo_padre']; ?>" required="">
			</div>
			<br><br>
			<Label style="font-size: 30px;">Información de la Madre</Label>
			<div class="form-group">
				<label for="ps_nombre_madre">Nombre de la madre</label>
				<input name="ps_nombre_madre" type="text" class="form-control" id="ps_nombre_madre" value="<?php echo $row_f['ps_nombre_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_ocupacion_madre">Ocupación</label>
				<input name="ps_ocupacion_madre" type="text" class="form-control" id="ps_ocupacion_madre" value="<?php echo $row_f['ps_ocupacion_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_lugar_trabajo_madre">Lugar de trabajo</label>
				<input name="ps_lugar_trabajo_madre" type="text" class="form-control" id="ps_lugar_trabajo_madre" value="<?php echo $row_f['ps_lugar_trabajo_madre']; ?>" required="">
			</div>
			<br>
			<label for="ps_estado_civil_representante">Estado Civil</label>
			<div style="display: flex; padding: 10px;">
				<label for="ps_estado_civil_representante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Soltero</label>
				<input name="ps_estado_civil_representante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Soltero" <?= $row_f['ps_estado_civil_representante'] == 'Soltero' ? 'checked' : '' ?> required="">


				<label for="ps_estado_civil_representante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Casado</label>
				<input name="ps_estado_civil_representante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Casado" <?= $row_f['ps_estado_civil_representante'] == 'Casado' ? 'checked' : '' ?> required="">


				<label for="ps_estado_civil_representante" style="width: 80px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Divorciado</label>
				<input name="ps_estado_civil_representante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Divorciado" <?= $row_f['ps_estado_civil_representante'] == 'Divorciado' ? 'checked' : '' ?> required="">


				<label for="ps_estado_civil_representante" style="width: 100px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Unión Libre</label>
				<input name="ps_estado_civil_representante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Unión Libre" <?= $row_f['ps_estado_civil_representante'] == 'Unión Libre' ? 'checked' : '' ?> required="">

			</div>


			<br>
			<label for="ps_relacion_familiar">Relacion de los miembros de la familia</label>
			<div style="display: flex; padding: 10px;">
				<label for="ps_relacion_familiar" style="width: 100px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Muy buena</label>
				<input name="ps_relacion_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Muy buena" <?= $row_f['ps_relacion_familiar'] == 'Muy buena' ? 'checked' : '' ?> required="">


				<label for="ps_relacion_familiar" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Buena</label>
				<input name="ps_relacion_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Buena" <?= $row_f['ps_relacion_familiar'] == 'Buena' ? 'checked' : '' ?> required="">


				<label for="ps_relacion_familiar" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Regular</label>
				<input name="ps_relacion_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Regular" <?= $row_f['ps_relacion_familiar'] == 'Regular' ? 'checked' : '' ?> required="">


				<label for="ps_relacion_familiar" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Mala</label>
				<input name="ps_relacion_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Mala" <?= $row_f['ps_relacion_familiar'] == 'Mala' ? 'checked' : '' ?> required="">

			</div>

			<div class="form-group">
				<label for="ps_tiempo_con_estudiante">¿Con quien pasa el estudiante en las mañanas?</label>
				<input name="ps_tiempo_con_estudiante" type="text" class="form-control" id="ps_tiempo_con_estudiante" value="<?php echo $row_f['ps_tiempo_con_estudiante']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_futuro_para_estudiante">¿Que planes de estudio tiene para el o para el estudiante en el futuro?</label>
				<input name="ps_futuro_para_estudiante" type="text" class="form-control" id="ps_futuro_para_estudiante" value="<?php echo $row_f['ps_futuro_para_estudiante']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_desarrollo_academico_estudiante">En la tareas para cada estudiante, ¿Cómo las desarrolla?</label>
				<input name="ps_desarrollo_academico_estudiante" type="text" class="form-control" id="ps_desarrollo_academico_estudiante" value="<?php echo $row_f['ps_desarrollo_academico_estudiante']; ?>" required="">
			</div>



			<br>
			<label for="ps_gastos_familiar">¿Quien sustenta los gastos de la familia?</label>
			<div style="display: flex; padding: 10px;">
				<label for="ps_gastos_familiar" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Madre</label>
				<input name="ps_gastos_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Madre" <?= $row_f['ps_gastos_familiar'] == 'Madre' ? 'checked' : '' ?> required="">


				<label for="ps_gastos_familiar" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Padre</label>
				<input name="ps_gastos_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Padre" <?= $row_f['ps_gastos_familiar'] == 'Padre' ? 'checked' : '' ?> required="">

			</div>

			<br>
			<br>
			<br>
			<!-- BOTON DE AGREGAR  -->
			<div class="form-group text-center">
				<input name="entrevista" value="Terminar Entrevista" type="submit" class="btn btn-danger">
			</div>

		</form>
	</div>

</div>