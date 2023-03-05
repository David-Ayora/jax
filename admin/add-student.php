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
	$birthdate = $_POST['birthdate'] . date("d-m-Y");						//
	$nacionalidad = $_POST['nacionalidad'];					//
	$sexo = $_POST['sexo'];									//
	$address = $_POST['address'];							//
	$sector = $_POST['sector'];								//
	$descuento = $_POST['descuento'];						//
	$observaciones = $_POST['observaciones'];				//

	$query_estudiante = "INSERT INTO `student_info` ( `matricula`, `tipo`, `last_name`, `name`, `grado_estudiantil`, `birthdate`, `nacionalidad`, `sexo`, `direccion`, `sector`, `photo`, `observaciones`, `descuento`) 
	VALUES ('$matricula', '$tipo', '$last_name', '$name', '$grado_estudiantil', '$birthdate', '$nacionalidad', '$sexo', '$address', '$sector', '$photo', '$observaciones', '$descuento');";


	// $query_estudiantes = "INSERT INTO 'student_info' ( 'matricula', 'tipo', 'last_name', 'name', 'grado_estudiantil', 'birthdate', 'nacionalidad', 'sexo', 'direccion', 'sector', 'photo') VALUES ('234117', 'uepp', 'Cabrera', 'Jose', 'Primero BGU', '2003-05-03', 'ecuatoriana', 'Masculino', 'Azogues', 'Leg Abuga', '023545186.jpg');";


	// 	$query_student = "INSERT INTO student_info ('id', 'matricula', 'tipo', 'last_name', 'name', 'grado_estudiantil', 'birthdate', 'nacionalidad', 'sexo', 'direccion', 'sector', 'photo') VALUES
	//  ('', '22222', 'uepp', 'gallegos', 'Juan', 'Primero', '2023-02-02', 'Ecuatoriana', 'Masculino', 'Azogues', 'Bayas', '1486151848.jpg');";




	// INFORMACIÓN DEL REPRESENTANTE

	// $a = $_POST['nacionalidad'];
	// $a = $_POST['nacionalidad'];
	// $a = $_POST['nacionalidad'];
	// $a = $_POST['nacionalidad'];
	// $a = $_POST['nacionalidad'];
	// $a = $_POST['nacionalidad'];
	// $a = $_POST['nacionalidad'];
	// $a = $_POST['nacionalidad'];
	// $a = $_POST['nacionalidad'];


	// $pcontact = $_POST['pcontact'];
	// $class = $_POST['class'];



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
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Matricular Estudiante<small class="text-warning"> Nuevo Estudiante</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
		<li class="breadcrumb-item active" aria-current="page">Registrar estudiante</li>
	</ol>
</nav>
<br><br>
<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
	<h5>INFORMACIÓN DEL/LA ESTUDIANTE</h5>
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

			<div class="form-group" style="display: flex;">
				<label for="matricula" style="width: 120px;">N° Matricula</label>
				<input name="matricula" style="width: 150px; padding: 0;" type="text" value="<?= isset($matricula) ? $matricula : ''; ?>" class="form-control" pattern="[0-9]{6}" id="matricula" required="">
			</div>
			<div>
				<label for="photo">Fotografía del Estudiante</label>
				<input name="photo" style="width: 400px;" type="file" class="form-control" id="photo" required="">
			</div>
			<div style="display: flex; padding: 10px;">
				<label for="check_new_estudiante" style="width: 150px;display: auto;">Nuevo postulante</label>
				<input name="check_new_estudiante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Nuevo" required="">


				<label for="check_new_estudiante" style="width: 170px;display: auto;margin-left: 50px;">Estudiante de la UEPP</label>
				<input name="check_new_estudiante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="UEPP" required="">
			</div>

			<div class="form-group">
				<label for="last_name">Apellidos</label>
				<input name="last_name" type="text" class="form-control" id="last_name" value="<?= isset($last_name) ? $last_name : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="name">Nombres</label>
				<input name="name" type="text" class="form-control" id="name" value="<?= isset($name) ? $name : ''; ?>" required="">
			</div>

			<div class="form-group">
				<label for="class">Grado Estudiantil</label>
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
				<label for="birthdate">Fecha de nacimiento</label>
				<input name="birthdate" type="date" class="form-control" id="birthdate" value="<?= isset($birthdate) ? $birthdate : '2000/01/01'; ?>" required="">
			</div>

			<div class="form-group">
				<label for="nacionalidad">Nacionalidad</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="sexo">Sexo</label>
				<div style="display: flex;">
					<label for="sexo" style="width: 100px;display: auto;">Masculino</label>
					<input name="sexo" type="radio" class="form-control" id="masculino" style="height: 30px !important; width: 20px; margin-right: 20px;" value="Masculino" required="">
					<label for="sexo" style="width: 100px;display: auto;">Femenino</label>
					<input name="sexo" type="radio" class="form-control" id="Femenino" style="height: 30px !important; width: 20px;" value="Femenino" required="">
				</div>


			</div>
			<div class="form-group">
				<label for="address">Dirección</label>
				<input name="address" type="text" value="<?= isset($address) ? $address : ''; ?>" class="form-control" id="address" required="">
			</div>

			<div class="form-group">
				<label for="sector">Barrio/Setor</label>
				<input name="sector" type="text" class="form-control" id="sector" value="<?= isset($sector) ? $sector : ''; ?>" required="">
			</div>


			<div class="form-group">
				<label for="descuento">Porcentaje de descuento</label>
				<input name="descuento" type="number" class="form-control" id="descuento" style="width: 100px;" value="<?= isset($descuento) ? $descuento : ''; ?>" required="">
			</div>


			<div style="display: flex; padding: 10px;">
				<label for="check_new_estudiante" style="width: 150px;display: auto;">Nuevo postulante</label>
				<input name="check_new_estudiante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Nuevo" required="">


				<label for="check_new_estudiante" style="width: 170px;display: auto;margin-left: 50px;">Estudiante de la UEPP</label>
				<input name="check_new_estudiante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="UEPP" required="">
			</div>

























			<!-- INFORMACION DEL REPRESENTANTE -->



			<br><br><br>
			<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
				<h5>INFORMACIÓN DEL REPRESENTANTE</h5>
			</ol>
			<br><br>
			<div class="form-group">
				<label for="r_last_name">Apellidos del representante</label>
				<input name="r_last_name" type="text" class="form-control" id="r_last_name" value="<?= isset($r_last_name) ? $r_last_name : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="r_name">Nombres del representante</label>
				<input name="r_name" type="text" class="form-control" id="r_name" value="<?= isset($r_name) ? $r_name : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="r_ci">C.I</label>
				<input name="r_ci" type="text" class="form-control" id="r_ci" value="<?= isset($r_ci) ? $r_ci : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="r_telf">Télefono a dónde ubicarlo</label>
				<input name="r_telf" type="number" value="<?= isset($r_telf) ? $r_telf : ''; ?>" class="form-control" id="r_telf" required="">
			</div>
			<div class="form-group">
				<label for="r_email">Email</label>
				<input name="r_email" type="email" class="form-control" id="r_email" value="<?= isset($r_email) ? $r_email : ''; ?>" required="">
			</div>






			<!-- INFORMACION FAMILIAR  -->




			<br><br><br>
			<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
				<h5>INFORMACIÓN FAMILIAR</h5>
			</ol>
			<br><br>
			<H1>Información del Padre</H1>
			<br>
			<div class="form-group">
				<label for="f_apellido_padre">Apellidos del Padre</label>
				<input name="f_apellido_padre" type="text" class="form-control" id="f_apellido_padre" value="<?= isset($f_apellido_padre) ? $f_apellido_padre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_nombre_padre ">Nombres del Padre</label>
				<input name="f_nombre_padre " type="text" class="form-control" id="f_nombre_padre " value="<?= isset($f_nombre_padre) ? $f_nombre_padre  : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_edad_padre">Edad</label>
				<input name="f_edad_padre" type="text" class="form-control" id="f_edad_padre" value="<?= isset($f_edad_padre) ? $f_edad_padre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_intruccion_padre">Nivel de instrucción</label>
				<input name="f_intruccion_padre" type="text" class="form-control" id="f_intruccion_padre" value="<?= isset($f_intruccion_padre) ? $f_intruccion_padre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_profesion_padre">Profesión</label>
				<input name="f_profesion_padre" type="text" class="form-control" id="f_profesion_padre" value="<?= isset($f_profesion_padre) ? $f_profesion_padre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_lugar_trabajo_padre">Lugar de trabajo</label>
				<input name="f_lugar_trabajo_padre" type="text" class="form-control" id="f_lugar_trabajo_padre" value="<?= isset($f_lugar_trabajo_padre) ? $f_lugar_trabajo_padre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_direccion_padre">Dirección</label>
				<input name="f_direccion_padre" type="text" class="form-control" id="f_direccion_padre" value="<?= isset($f_direccion_padre) ? $f_direccion_padre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_civil_padre">Estado civil</label>
				<input name="f_civil_padre" type="text" class="form-control" id="f_civil_padre" value="<?= isset($f_civil_padre) ? $f_civil_padre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_ci_padre">C.I</label>
				<input name="f_ci_padre" type="text" class="form-control" id="f_ci_padre" value="<?= isset($f_ci_padre) ? $f_ci_padre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_telf_padre">Teléfono</label>
				<input name="f_telf_padre" type="number" class="form-control" id="f_telf_padre" value="<?= isset($f_telf_padre) ? $f_telf_padre : ''; ?>" required="">
			</div>

			<br><br>
			<H1>Información de la Madre</H1>
			<br>
			<div class="form-group">
				<label for="f_apellido_madre">Apellidos de la Madre</label>
				<input name="f_apellido_madre" type="text" class="form-control" id="f_apellido_madre" value="<?= isset($f_apellido_madre) ? $f_apellido_madre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_nombre_madre ">Nombres de la Madre</label>
				<input name="f_nombre_madre " type="text" class="form-control" id="f_nombre_madre " value="<?= isset($f_nombre_madre) ? $f_nombre_madre  : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_edad_madre">Edad</label>
				<input name="f_edad_madre" type="text" class="form-control" id="f_edad_madre" value="<?= isset($f_edad_madre) ? $f_edad_madre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_intruccion_madre">Nivel de instrucción</label>
				<input name="f_intruccion_madre" type="text" class="form-control" id="f_intruccion_madre" value="<?= isset($f_intruccion_madre) ? $f_intruccion_madre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_profesion_madre">Profesión</label>
				<input name="f_profesion_madre" type="text" class="form-control" id="f_profesion_madre" value="<?= isset($f_profesion_madre) ? $f_profesion_madre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_lugar_trabajo_madre">Lugar de trabajo</label>
				<input name="f_lugar_trabajo_madre" type="text" class="form-control" id="f_lugar_trabajo_madre" value="<?= isset($f_lugar_trabajo_madre) ? $f_lugar_trabajo_madre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_direccion_madre">Dirección</label>
				<input name="f_direccion_madre" type="text" class="form-control" id="f_direccion_madre" value="<?= isset($f_direccion_madre) ? $f_direccion_madre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_civil_madre">Estado civil</label>
				<input name="f_civil_madre" type="text" class="form-control" id="f_civil_madre" value="<?= isset($f_civil_madre) ? $f_civil_madre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_ci_madre">C.I</label>
				<input name="f_ci_madre" type="text" class="form-control" id="f_ci_madre" value="<?= isset($f_ci_madre) ? $f_ci_madre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_telf_madre">Teléfono</label>
				<input name="f_telf_madre" type="number" class="form-control" id="f_telf_madre" value="<?= isset($f_telf_madre) ? $f_telf_madre : ''; ?>" required="">
			</div>

			<br><br><br><br>
			<H1>Otra Información</H1>
			<br>
			<div class="form-group">
				<label for="f_num_per_familia">Número de personas que conforman su familia</label>
				<input name="f_num_per_familia" type="text" class="form-control" id="f_num_per_familia" value="<?= isset($f_num_per_familia) ? $f_num_per_familia : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_economia">En que nivel de situación económica se encuentra</label>
				<select name="class" class="form-control" id="f_economia" required="">
					<option>Selecciona</option>
					<option value="Alta">Alta</option>
					<option value="Media">Media</option>
					<option value="Regular">Regular</option>
					<option value="Baja">Baja</option>
				</select>
			</div>
			<br>
			<div class="form-group">
				<label for="f_convive_estudiante">El/La estudiante vive con algún familiar a parte de sus padres</label>
				<select name="class" class="form-control" id="f_convive_estudiante" required="">
					<option>Selecciona</option>
					<option value="Si">Si</option>
					<option value="No">No</option>
				</select>
			</div>
			<div class="form-group">
				<label for="f_convive_nombre">Nombre de familiar</label>
				<input name="f_convive_nombre" type="text" class="form-control" id="f_convive_nombre" value="<?= isset($f_convive_nombre) ? $f_convive_nombre : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_convive_apellido">Apellido de familiar</label>
				<input name="f_convive_apellido" type="text" class="form-control" id="f_convive_apellido" value="<?= isset($f_convive_apellido) ? $f_convive_apellido : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_convive_edad">Edad</label>
				<input name="f_convive_apellido" type="text" class="form-control" id="f_convive_apellido" value="<?= isset($f_convive_apellido) ? $f_convive_apellido : ''; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_convive_parentesco">Parentesco</label>
				<input name="f_convive_parentesco" type="text" class="form-control" id="f_convive_parentesco" value="<?= isset($f_convive_parentesco) ? $f_convive_parentesco : ''; ?>" required="">
			</div>
			<br><br><br><br>

			<div class="form-group">
				<label for="f_tipo_vivienda">Tipo de vivienda</label>
				<select name="f_tipo_vivienda" class="form-control" id="f_tipo_vivienda" required="">
					<option>Selecciona</option>
					<option value="Propia">Propia</option>
					<option value="Arrendada">Arrendada</option>
					<option value="Prestada">Prestada</option>
				</select>
			</div>

			<div class="form-group">
				<label for="f_hambitacion_niño">Habitación del niño</label>
				<select name="f_hambitacion_niño" class="form-control" id="f_hambitacion_niño" required="">
					<option>Selecciona</option>
					<option value="Individual">Individual</option>
					<option value="Compartida">Compartida</option>
				</select>
				<br>
				<label for="">Si eligio la opción "Compartida" indique con quien</label>
				<input name="f_nombre_hambitacion_niño" type="text" class="form-control" id="f_nombre_hambitacion_niño" value="<?= isset($f_nombre_hambitacion_niño) ? $f_nombre_hambitacion_niño : ''; ?>" >


			</div>

			<label for="sexo">Tiempo que los padres pasan con los niños</label>
			<div style="display: flex;">
				<label for="sexo" style="width: 100px;display: auto;">Madre</label>
				<input name="sexo" type="radio" class="form-control" id="masculino" style="height: 30px !important; width: 20px; margin-right: 20px;" value="Masculino" required="">
				<label for="sexo" style="width: 100px;display: auto;">Padre</label>
				<input name="sexo" type="radio" class="form-control" id="Femenino" style="height: 30px !important; width: 20px;" value="Femenino" required="">
			</div>


	</div>



	<div class="form-group">
		<label for="observaciones">Observaciones</label>
		<input name="observaciones" type="text" class="form-control" id="observaciones" value="<?= isset($observaciones) ? $observaciones : ''; ?>" required="">
	</div>


















	</form>
</div>

</div>