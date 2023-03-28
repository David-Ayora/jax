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


if (isset($_POST['entrevista'])) {
	$id_ficha = mysqli_query($conexion, 'SELECT if(max(id_ficha)>0, max(id_ficha)+1, 1) as id_ficha FROM entrevista_ficha;');
	while ($result = mysqli_fetch_array($id_ficha)) {
		$result_id = $result['id_ficha'];
	} 
	$id_ficha = $result_id;

	if (empty($id_ficha)) {

		echo intval($id_ficha) . "<br><br><br><br>";

		echo "<br><br>Algo Malo<br><br>";
		$id_ficha = 1;
		$datainsert['inserterror'] = '<p style="color: red;">Ups! Ha ocurrido un error con el primer registro de la base de datos.</p>';
	} else {
		// echo $id_ficha;


		// DATOS GENERALES

		$ps_nombre = trim($_POST['ps_nombre']);
		$ps_apellido = trim($_POST['ps_apellido']);
		$ps_lugar_nacimiento = trim($_POST['ps_lugar_nacimiento']);
		$ps_fecha = $_POST['ps_fecha'] ;
		// . date("Md-Y")
		$ps_direccion = trim($_POST['ps_direccion']);
		$ps_año_aplica = trim($_POST['ps_año_aplica']);
		$ps_ist_procede = trim($_POST['ps_ist_procede']);
		$ps_promedio = trim($_POST['ps_promedio']);
		$ps_conducta = trim($_POST['ps_conducta']);
		$ps_razon = trim($_POST['ps_razon']);
		$ps_razon_cambio = trim($_POST['ps_razon_cambio']);
		$ps_altercado = trim($_POST['ps_altercado']);
		$ps_email = trim($_POST['ps_email']);
		$ps_celular = trim($_POST['ps_celular']);
		$ps_cupo = trim($_POST['ps_cupo']);



		$query_entrevistado = "INSERT INTO entrevista_estudiante 
		(`id_ficha`, `ps_nombre`, `ps_apellido`, `ps_lugar_nacimiento`, `ps_fecha`, `ps_direccion`, `ps_año_aplica`, `ps_ist_procede`, 
		`ps_promedio`, `ps_conducta`, `ps_razon`, `ps_razon_cambio`, `ps_altercado`, `ps_email`, `ps_celular`, `ps_cupo`) VALUES 	
		('$id_ficha', '$ps_nombre', '$ps_apellido', '$ps_lugar_nacimiento', '$ps_fecha', '$ps_direccion', '$ps_año_aplica', '$ps_ist_procede','$ps_promedio', 
		'$ps_conducta', '$ps_razon', '$ps_razon_cambio', '$ps_altercado', '$ps_email', '$ps_celular', '$ps_cupo');";


		// HISTORIA FAMILIAR

		$ps_nombre_representante = trim($_POST['ps_nombre_representante']);
		$ps_nombre_padre = trim($_POST['ps_nombre_padre']);
		$ps_ocupacion_padre = trim($_POST['ps_ocupacion_padre']);
		$ps_lugar_trabajo_padre = trim($_POST['ps_lugar_trabajo_padre']);
		$ps_nombre_madre = trim($_POST['ps_nombre_madre']);
		$ps_ocupacion_madre = trim($_POST['ps_ocupacion_madre']);
		$ps_lugar_trabajo_madre = trim($_POST['ps_lugar_trabajo_madre']);
		$ps_estado_civil_representante = trim($_POST['ps_estado_civil_representante']);
		$ps_relacion_familiar = trim($_POST['ps_relacion_familiar']);
		$ps_tiempo_con_estudiante = trim($_POST['ps_tiempo_con_estudiante']);
		$ps_futuro_para_estudiante = trim($_POST['ps_futuro_para_estudiante']);
		$ps_desarrollo_academico_estudiante = trim($_POST['ps_desarrollo_academico_estudiante']);
		$ps_gastos_familiar = trim($_POST['ps_gastos_familiar']);

		$query_entrevistado_familiar = "INSERT INTO `entrevista_historia_familiar` 
	(`id_ficha`, `ps_nombre_representante`, `ps_nombre_padre`, `ps_ocupacion_padre`, `ps_lugar_trabajo_padre`, `ps_nombre_madre`, `ps_ocupacion_madre`, `ps_lugar_trabajo_madre`, `ps_estado_civil_representante`, `ps_relacion_familiar`, `ps_tiempo_con_estudiante`, `ps_futuro_para_estudiante`, `ps_desarrollo_academico_estudiante`, `ps_gastos_familiar`) VALUES
	 ( '$id_ficha', '$ps_nombre_representante', '$ps_nombre_padre', '$ps_ocupacion_padre', '$ps_lugar_trabajo_padre', '$ps_nombre_madre', '$ps_ocupacion_madre', '$ps_lugar_trabajo_madre', '$ps_estado_civil_representante', '$ps_relacion_familiar', '$ps_tiempo_con_estudiante', '$ps_futuro_para_estudiante', '$ps_desarrollo_academico_estudiante', '$ps_gastos_familiar') ";

		$query_ficha = "SELECT  if(max(id_ficha)>0, max(id_ficha), '1') as id_ficha FROM entrevista_ficha;";

		if (mysqli_query($conexion, $query_entrevistado)) {


			try {
				if (mysqli_query($conexion, $query_entrevistado_familiar)) {
					$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
					mysqli_close($conexion);
				} else {
					$datainsert['inserterror'] = '<p style="color: red;">Estudiante no ingresado, revise la información del representante.</p>';
					mysqli_close($conexion);
				}
			} catch (Exception $th) {
				echo "<br>Mensaje de error: " . $th->getMessage();
			}

			
		} else {
			$datainsert['inserterror'] = '<p style="color: red;">Estudiante no ingresado, revise la información de Datos Generales.</p>';
			mysqli_close($conexion);
		}
	}
}



?>

<h1 class="text-primary"><i class="fa fa-question"></i> Entrevista<small class="text-warning"> Asignación de cupo</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
		<li class="breadcrumb-item active" aria-current="page">Entrevistar estudiante</li>
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
					<small>
						<?php
						echo date('d-M-Y');
						?>
					</small>
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
				<input name="ps_apellido" type="text" class="form-control" id="ps_apellido" value="<?= isset($ps_apellido) ? $ps_apellido : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_nombre">Nombres</label>
				<input name="ps_nombre" type="text" class="form-control" id="ps_nombre" value="<?= isset($ps_nombre) ? $ps_nombre : ''; ?>" required="">
			</div>


			<div class="form-group">
				<label for="ps_lugar_nacimiento">Lugar de nacimiento</label>
				<input name="ps_lugar_nacimiento" type="text" class="form-control" id="ps_lugar_nacimiento" value="<?= isset($ps_lugar_nacimiento) ? $ps_lugar_nacimiento : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_fecha">Fecha de nacimiento</label>
				<input name="ps_fecha" type="date" class="form-control" id="ps_fecha" value="<?= isset($ps_fecha) ? $ps_fecha : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_direccion">Dirección</label>
				<input name="ps_direccion" type="text" value="<?= isset($ps_direccion) ? $ps_direccion : ''; ?>" class="form-control" id="ps_direccion" required="">
			</div>


			<div class="form-group">
				<label for="class">Año de educación que aplica</label>
				<select name="ps_año_aplica" class="form-control" id="ps_año_aplica" required="">
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
				<label for="ps_ist_procede">Institución que procede</label>
				<input name="ps_ist_procede" type="text" class="form-control" id="ps_ist_procede" value="<?= isset($ps_ist_procede) ? $ps_ist_procede : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_promedio">Promedio general del período escolar anterior</label>
				<input name="ps_promedio" type="text" class="form-control" id="ps_promedio" value="<?= isset($ps_promedio) ? $ps_promedio : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_conducta">Conducta</label>
				<input name="ps_conducta" type="text" class="form-control" id="ps_conducta" value="<?= isset($ps_conducta) ? $ps_conducta : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_razon">Razón por la que busca ser parte de esta institución</label>
				<input name="ps_razon" type="text" class="form-control" id="ps_razon" value="<?= isset($ps_razon) ? $ps_razon : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_razon_cambio">Razón del cambio de instituto</label>
				<input name="ps_razon_cambio" type="text" class="form-control" id="ps_razon_cambio" value="<?= isset($ps_razon_cambio) ? $ps_razon_cambio : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_altercado">En la institución anterior, ¿Tuvo algún altercado?</label>
				<input name="ps_altercado" type="text" class="form-control" id="ps_altercado" value="<?= isset($ps_altercado) ? $ps_altercado : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_email">Correo electrónico</label>
				<input name="ps_email" type="text" class="form-control" id="ps_email" value="<?= isset($ps_email) ? $ps_email : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_celular">Celular</label>
				<input name="ps_celular" type="number" class="form-control" id="ps_celular" value="<?= isset($ps_celular) ? $ps_celular : ''; ?>" required="">
			</div>


			<br><br><br><br>
			<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
				<h4>Historia Familiar</h4>
			</ol>
			<br><br>
			<div class="form-group">
				<label for="ps_nombre_representante">Nombre del respresentante o tutor</label>
				<input name="ps_nombre_representante" type="text" class="form-control" id="ps_nombre_representante" value="<?= isset($ps_nombre_representante) ? $ps_nombre_representante : ''; ?>" required="">
			</div>
			<br><br>
			<Label style="font-size: 30px;">Información del Padre</Label>
			<div class="form-group">
				<label for="ps_nombre_padre">Nombre del padre</label>
				<input name="ps_nombre_padre" type="text" class="form-control" id="ps_nombre_padre" value="<?= isset($ps_nombre_padre) ? $ps_nombre_padre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_ocupacion_padre">Ocupación</label>
				<input name="ps_ocupacion_padre" type="text" class="form-control" id="ps_ocupacion_padre" value="<?= isset($ps_ocupacion_padre) ? $ps_ocupacion_padre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_lugar_trabajo_padre">Lugar de trabajo</label>
				<input name="ps_lugar_trabajo_padre" type="text" class="form-control" id="ps_lugar_trabajo_padre" value="<?= isset($ps_lugar_trabajo_padre) ? $ps_lugar_trabajo_padre : ''; ?>" required="">
			</div>
			<br><br>
			<Label style="font-size: 30px;">Información de la Madre</Label>
			<div class="form-group">
				<label for="ps_nombre_madre">Nombre de la madre</label>
				<input name="ps_nombre_madre" type="text" class="form-control" id="ps_nombre_madre" value="<?= isset($ps_nombre_madre) ? $ps_nombre_madre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_ocupacion_madre">Ocupación</label>
				<input name="ps_ocupacion_madre" type="text" class="form-control" id="ps_ocupacion_madre" value="<?= isset($ps_ocupacion_madre) ? $ps_ocupacion_madre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_lugar_trabajo_madre">Lugar de trabajo</label>
				<input name="ps_lugar_trabajo_madre" type="text" class="form-control" id="ps_lugar_trabajo_madre" value="<?= isset($ps_lugar_trabajo_madre) ? $ps_lugar_trabajo_madre : ''; ?>" required="">
			</div>
			<br>
			<label for="ps_estado_civil_representante">Estado Civil</label>
			<div style="display: flex; padding: 10px;">
				<label for="ps_estado_civil_representante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Soltero</label>
				<input name="ps_estado_civil_representante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Soltero" required="">


				<label for="ps_estado_civil_representante" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Casado</label>
				<input name="ps_estado_civil_representante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Casado" required="">


				<label for="ps_estado_civil_representante" style="width: 80px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Divorciado</label>
				<input name="ps_estado_civil_representante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Divorciado" required="">


				<label for="ps_estado_civil_representante" style="width: 100px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Unión Libre</label>
				<input name="ps_estado_civil_representante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Unión Libre" required="">

			</div>


			<br>
			<label for="ps_relacion_familiar">Relacion de los miembros de la familia</label>
			<div style="display: flex; padding: 10px;">
				<label for="ps_relacion_familiar" style="width: 100px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Muy buena</label>
				<input name="ps_relacion_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Muy buena" required="">


				<label for="ps_relacion_familiar" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Buena</label>
				<input name="ps_relacion_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Buena" required="">


				<label for="ps_relacion_familiar" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Regular</label>
				<input name="ps_relacion_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Regular" required="">


				<label for="ps_relacion_familiar" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Mala</label>
				<input name="ps_relacion_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Mala" required="">

			</div>

			<div class="form-group">
				<label for="ps_tiempo_con_estudiante">¿Con quien pasa el estudiante en las mañanas?</label>
				<input name="ps_tiempo_con_estudiante" type="text" class="form-control" id="ps_tiempo_con_estudiante" value="<?= isset($ps_tiempo_con_estudiante) ? $ps_tiempo_con_estudiante : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="ps_futuro_para_estudiante">¿Que planes de estudio tiene para el o para el estudiante en el futuro?</label>
				<input name="ps_futuro_para_estudiante" type="text" class="form-control" id="ps_futuro_para_estudiante" value="<?= isset($ps_futuro_para_estudiante) ? $ps_futuro_para_estudiante : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="ps_desarrollo_academico_estudiante">En la tareas para cada estudiante, ¿Cómo las desarrolla?</label>
				<input name="ps_desarrollo_academico_estudiante" type="text" class="form-control" id="ps_desarrollo_academico_estudiante" value="<?= isset($ps_desarrollo_academico_estudiante) ? $ps_desarrollo_academico_estudiante : ''; ?>" required="">
			</div>



			<br>
			<label for="ps_gastos_familiar">¿Quien sustenta los gastos de la familia?</label>
			<div style="display: flex; padding: 10px;">
				<label for="ps_gastos_familiar" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Madre</label>
				<input name="ps_gastos_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Madre" required="">


				<label for="ps_gastos_familiar" style="width: 70px;display: auto;margin-left: 50px;margin-right: 10px; text-align: right;">Padre</label>
				<input name="ps_gastos_familiar" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Padre" required="">

			</div>

			<div class="form-group">
				<label for="class">Asignación de cupo</label>
				<select name="ps_cupo" class="form-control" id="ps_cupo" required="">
					<option>Selecciona</option>
					<option value="Asignado">Asignado</option>
					<option value="No asignado">No asignado</option>
				</select>
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