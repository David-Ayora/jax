<?php
include('./conexion.php');
include('./validar_cedula.php');

// control de estructura de endpoint en el navegador (URL) 
$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
	if ($corepage == $corepage) {
		$corepage = explode('.', $corepage);
		header('Location: index.php?page=' . $corepage[0]);
	}
}


// Añadir la matricula automaticamente
$query_matricula = mysqli_query($conexion, 'SELECT max(matricula)+1 as matricula FROM student_info;');
while ($result_matricula_n = mysqli_fetch_array($query_matricula)) {
	$result_matricula = $result_matricula_n["matricula"];
}
$matricula_new = $result_matricula;


// Añadir el año lectivo al formulario
$query_año_lectivo = mysqli_query($conexion, 'SELECT * FROM año_lectivo ORDER BY id DESC;');
$respuesta = mysqli_fetch_array($query_año_lectivo);
$año_inicial = date("Y", strtotime($respuesta['periodo_inicio']));
$año_final = date("Y", strtotime($respuesta['periodo_final']));
$id_lectivo = $respuesta['id'];


if (isset($_POST['addstudent'])) {


	// Informacion previa
	// $prev_periodo_academico = $_POST['prev_periodo_academico'];
	$prev_ci = $_POST['prev_ci'];
	$doc_senescyt = trim($_FILES['prev_doc_senescyt']['name']);
	$ruta_pdf_anterior = trim($_FILES['prev_doc_senescyt']['tmp_name']);
	$doc_senescyt = $prev_ci . date('Y-m-d-m-s') . '.' . $doc_senescyt;
	$ruta_pdf_nuevo = trim('documents/' . $doc_senescyt);

	$curso_matricular = $_POST['grado_estudiantil_prev'];


	// INFORMACIÓN DEL ESTUDIANTE 			
	$matricula = trim($_POST['matricula']);
	$photo = explode('.', $_FILES['photo']['name']);
	$photo = end($photo);
	$photo = $matricula . date('Y-m-d-m-s') . '.' . $photo;
	$tipo = trim($_POST['check_new_estudiante']);
	$last_name = trim($_POST['last_name']);
	$name = trim($_POST['name']);
	// $grado_estudiantil = trim($_POST['grado_estudiantil']);
	$birthdate = $_POST['birthdate'] . date("MM-DD-YYYY");
	$nacionalidad = trim($_POST['nacionalidad']);
	$sexo = trim($_POST['sexo']);
	$address = trim($_POST['address']);
	$sector = trim($_POST['sector']);
	$descuento = trim($_POST['descuento']);
	$observaciones = trim($_POST['observaciones']);

	$query_estudiante = "INSERT INTO `student_info` ( `matricula`, `tipo`, `last_name`, `name`, `grado_estudiantil`, `birthdate`, `nacionalidad`, `sexo`, `direccion`, `sector`, `photo`, `observaciones`, `descuento`) 
	VALUES ('$matricula', '$tipo', '$last_name', '$name', '$curso_matricular', '$birthdate', '$nacionalidad', '$sexo', '$address', '$sector', '$photo', '$observaciones', '$descuento');";


	// INFORMACIÓN DEL REPRESENTANTE

	$r_last_name = $_POST['r_last_name'];
	$r_name = $_POST['r_name'];
	$r_ci = $_POST['r_ci'];
	$r_telf = $_POST['r_telf'];
	$r_email = $_POST['r_email'];


	// INFORMACIÓN FAMILIAR

	// Informacion del padre 
	$f_apellido_padre = $_POST['f_apellido_padre'];
	$f_nombre_padre = $_POST['f_nombre_padre'];
	$f_edad_padre = $_POST['f_edad_padre'];
	$f_intruccion_padre = $_POST['f_intruccion_padre'];
	$f_profesion_padre = $_POST['f_profesion_padre'];
	$f_lugar_trabajo_padre = $_POST['f_lugar_trabajo_padre'];
	$f_direccion_padre = $_POST['f_direccion_padre'];
	$f_civil_padre = $_POST['f_civil_padre'];
	$f_ci_padre = $_POST['f_ci_padre'];
	$f_telf_padre = $_POST['f_telf_padre'];

	// Informacion de la madre 
	$f_apellido_madre = $_POST['f_apellido_madre'];
	$f_nombre_madre = $_POST['f_nombre_madre'];
	$f_edad_madre = $_POST['f_edad_madre'];
	$f_intruccion_madre = $_POST['f_intruccion_madre'];
	$f_profesion_madre = $_POST['f_profesion_madre'];
	$f_lugar_trabajo_madre = $_POST['f_lugar_trabajo_madre'];
	$f_direccion_madre = $_POST['f_direccion_madre'];
	$f_civil_madre = $_POST['f_civil_madre'];
	$f_ci_madre = $_POST['f_ci_madre'];
	$f_telf_madre = $_POST['f_telf_madre'];

	// Otra información
	$f_num_per_familia = $_POST['f_num_per_familia'];
	$f_economia = $_POST['f_economia'];
	$f_convive_estudiante = $_POST['f_convive_estudiante'];
	$f_convive_nombre = $_POST['f_convive_nombre'];
	$f_convive_apellido = $_POST['f_convive_apellido'];
	$f_convive_edad = $_POST['f_convive_edad'];
	$f_convive_parentesco = $_POST['f_convive_parentesco'];
	$f_tipo_vivienda = $_POST['f_tipo_vivienda'];
	$f_habitacion_niño = $_POST['f_habitacion_niño'];
	$f_nombre_habitacion_niño = $_POST['f_nombre_habitacion_niño'];
	$f_time_padres_niño = $_POST['f_time_padres_niño'];


	$sql_validacion = mysqli_query($conexion, 'SELECT matricula, grado_estudiantil FROM student_info ORDER BY id DESC;');
	$validacion;
	while ($id_results = mysqli_fetch_array($sql_validacion)) {


		if ($id_results['matricula'] != $matricula) {
			$validacion = true;
			break;
		} else {
			$validacion = false;
		}
	}

	if (!$validacion == true) {
		$datainsert['inserterror'] = '<p style="color: red;">Estudiante ya ha sido matriculado, revise la información de.</p>';
		mysqli_close($conexion);
	} else {

		$query_prev = "INSERT INTO student_info_prev (id_lectivo, cedula_estudiante, doc_senescyt, curso_matricular) 
		VALUES ('$id_lectivo', '$prev_ci', '$doc_senescyt', '$curso_matricular');";

		// Ejecuta la insercion de datos previos 
		if (mysqli_query($conexion, $query_prev)) {
			move_uploaded_file($ruta_pdf_anterior, $ruta_pdf_nuevo);


			if (mysqli_query($conexion, $query_estudiante)) {
				move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo);
				// Extae el id del estudiante recien agregado
				$query_id_student = mysqli_query($conexion, 'SELECT id as id_estudiante FROM `student_info` WHERE matricula = ' . $matricula . ';');
				while ($result = mysqli_fetch_array($query_id_student)) {
					$result_id = $result['id_estudiante'];
				}
				$id_estudiante = $result_id;

				$query_representante = "INSERT INTO `student_representante` ( `r_last_name`, `r_name`, `r_ci`, `r_telf`, `r_email`, `id_estudiante`) 
				VALUES ('$r_last_name', '$r_name', '$r_ci', '$r_telf', '$r_email', '$id_estudiante');";

				if (mysqli_query($conexion, $query_representante)) {
					$query_familiar = "INSERT INTO `student_family` (`id_student`,`f_apellido_padre`,`f_nombre_padre`,`f_edad_padre`,`f_intruccion_padre`,`f_profesion_padre`,`f_lugar_trabajo_padre`,`f_direccion_padre`,`f_civil_padre`,`f_ci_padre`,`f_telf_padre`,`f_apellido_madre`,`f_nombre_madre`,`f_edad_madre`,`f_intruccion_madre`,`f_profesion_madre`,`f_lugar_trabajo_madre`,`f_direccion_madre`,`f_civil_madre`,`f_ci_madre`,`f_telf_madre`,`f_num_per_familia`,`f_economia`,`f_convive_estudiante`,`f_convive_nombre`,`f_convive_apellido`,`f_convive_edad`,`f_convive_parentesco`,`f_tipo_vivienda`,`f_habitacion_niño`,`f_nombre_habitacion_niño`,`f_time_padres_niño`) VALUES 
					('$id_estudiante','$f_apellido_padre','$f_nombre_padre','$f_edad_padre','$f_intruccion_padre','$f_profesion_padre','$f_lugar_trabajo_padre','$f_direccion_padre','$f_civil_padre','$f_ci_padre','$f_telf_padre','$f_apellido_madre','$f_nombre_madre','$f_edad_madre','$f_intruccion_madre','$f_profesion_madre','$f_lugar_trabajo_madre','$f_direccion_madre','$f_civil_madre','$f_ci_madre','$f_telf_madre','$f_num_per_familia','$f_economia','$f_convive_estudiante','$f_convive_nombre','$f_convive_apellido','$f_convive_edad','$f_convive_parentesco','$f_tipo_vivienda','$f_habitacion_niño','$f_nombre_habitacion_niño','$f_time_padres_niño');";

					try {
						if (mysqli_query($conexion, $query_familiar)) {
							$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
						} else {
							$datainsert['inserterror'] = '<p style="color: red;">Estudiante no matriculado, revise la información de.</p>';
							mysqli_close($conexion);
						}
					} catch (Exception $th) {
						echo "<br>Mensaje de error: " . $th->getMessage();
					}
				} else {
					mysqli_close($conexion);
				}
			} else {
				mysqli_close($conexion);
			}
		} else {
			mysqli_close($conexion);
		}
	}
}


?>

<link rel="stylesheet" href="../css/form-add-estudiante.css">
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Matricular Estudiante<small class="text-warning"> Nuevo Estudiante</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
		<li class="breadcrumb-item active" aria-current="page">Matricular estudiante</li>
	</ol>
</nav>
<h2 style="text-align: center;" class="text-primary">Documentos previos a la matricula</h2><br><br>




<form enctype="multipart/form-data" method="POST" id="form_add_estudiante">
	<div style="display: flex; ">
		<div style="flex: 3;">
			<h4>Año lectivo<span class="asterisk"> *</span></h4>
		</div>
		<div style="flex: 3; text-align: left; ">
			<label id="prev_periodo_academico" style="text-align: left;width: 100%; height: auto;"> <?php echo  $año_inicial . " - " . $año_final ?></label>
		</div>
	</div>
	<hr>


	<div style="display: flex;">
		<div style="flex: 3;">
			<h4>Cedula del estudiante<span class="asterisk"> *</span></h4>
		</div>
		<div style="flex: 3;">
			<input maxlength="10" onclick="validarCedula(this.value)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="prev_ci" type="text" class="form-control" id="prev_ci" value="<?= isset($f_ci_madre) ? $f_ci_madre : ''; ?>" required="">
		</div>
	</div>
	<hr>


	<div style="display: flex;">
		<div style="flex: 1;">
			<h4>Documento de Senescyt<span class="asterisk"> *</h4>
			<p style="font-size: 12px;">Este documento valida el ingreso a la Unidad Educativa</p>
		</div>
		<div style="display: flex; flex: 1; justify-content: center; align-items: center;">
			<input name="prev_doc_senescyt" style="width: 100%; height: auto;" type="file" class="form-control" id="prev_doc_senescyt" accept="application/pdf" required="">
		</div>
	</div>
	<hr>


	<div style="display: flex;">
		<div style="flex: 3;">
			<h4>Curso a matricular<span class="asterisk"> *</h4>
		</div>
		<div style="flex: 3;">
			<select name="grado_estudiantil_prev" class="form-control" id="grado_estudiantil_prev" required="">
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
	</div><br><br>


	<div style="flex: 3; text-align: center;">
		<button class="btn btn-danger" id="prev_validar"> Validar</button>
	</div><br>

	<!-- Este div contenedor muetra el formulario -->
	<div style="display: none;" id="contenedor">


		<ul class="ul-add">
			<li class="li-add"><a href="#" data-tab="item1" class="a-add" id="menu1">Estudiante</a></li>
			<li class="li-add"><a href="#" data-tab="item2" class="a-add" id="menu2">Representante</a></li>
			<li class="li-add"><a href="#" data-tab="item3" class="a-add" id="menu3">Padre</a></li>
			<li class="li-add"><a href="#" data-tab="item4" class="a-add" id="menu4">Madre</a></li>
			<li class="li-add"><a href="#" data-tab="item5" class="a-add" id="menu5">Otros</a></li>
		</ul>

		<div class="tab-container">
			<div id="item1" class="tab">

				<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
					<h5>INFORMACIÓN DEL/LA ESTUDIANTE</h5>
				</ol>
				<div class="row">
					<div class="col-sm-12">
						<?php if (isset($datainsert)) {
						?>

							<div role="alert" aria-live="assertive" aria-atomic="true" class="toast fade" data-autohide="true" data-animation="true" data-delay="20000">
								<div class="toast-header">
									<strong class="mr-auto">Alerta de matriculación</strong>
									<small><?php echo date("d-M-Y"); ?></small>
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





						<div class="form-group" style="display: flex;">
							<label for="matricula" style="width: 120px;">N° Matricula<span class="asterisk"> *</span></label>
							<input onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="matricula" style="width: 150px; padding: 0;" type="text" value="<?php isset($matricula_new) ? print($matricula_new)  : ''; ?>" class="form-control" pattern="[0-9]{6}" id="matricula" required="">
						</div>
						<div>
							<label for="photo">Fotografía del Estudiante<span class="asterisk"> *</span></label>
							<input name="photo" style="width: 400px;" type="file" class="form-control" id="photo" required="">
						</div>
						<br>
						<label>Tipo de matricula <span class="asterisk"> *</span></label>
						<div style="display: flex; padding: 10px;">
							<label for="check_new_estudiante" style="width: 150px;display: auto;">Nuevo postulante</label>
							<input name="check_new_estudiante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Nuevo" required="">


							<label for="check_new_estudiante" style="width: 170px;display: auto;margin-left: 50px;">Estudiante de la UEPP</label>
							<input name="check_new_estudiante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="UEPP" required="">
						</div>

						<div class="form-group">
							<label for="last_name">Apellidos<span class="asterisk"> *</span></label>
							<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="last_name" type="text" class="form-control" id="last_name" value="<?= isset($last_name) ? $last_name : ''; ?>" required="">
						</div>
						<div class="form-group">
							<label for="name">Nombres<span class="asterisk"> *</span></label>
							<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="name" type="text" class="form-control" id="name" value="<?= isset($name) ? $name : ''; ?>" required="">
						</div>

						<div class="form-group">
							<label for="birthdate">Fecha de nacimiento<span class="asterisk"> *</span></label>
							<input onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="birthdate" type="date" class="form-control" id="birthdate" value="<?= isset($birthdate) ? $birthdate : ''; ?>" required="">
						</div>

						<div class="form-group">
							<label for="nacionalidad">Nacionalidad<span class="asterisk"> *</span></label>
							<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?= isset($nacionalidad) ? $nacionalidad : ''; ?>" required="">
						</div>
						<div class="form-group">
							<label for="sexo">Sexo<span class="asterisk"> *</span></label>
							<div style="display: flex;">
								<label for="sexo" style="width: 100px;display: auto;">Masculino</label>
								<input name="sexo" type="radio" class="form-control" id="masculino" style="height: 30px !important; width: 20px; margin-right: 20px;" value="Masculino" required="">
								<label for="sexo" style="width: 100px;display: auto;">Femenino</label>
								<input name="sexo" type="radio" class="form-control" id="Femenino" style="height: 30px !important; width: 20px;" value="Femenino" required="">
							</div>


						</div>
						<div class="form-group">
							<label for="address">Dirección<span class="asterisk"> *</span></label>
							<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="address" type="text" value="<?= isset($address) ? $address : ''; ?>" class="form-control" id="address" required="">
						</div>

						<div class="form-group">
							<label for="sector">Barrio/Setor<span class="asterisk"> *</span></label>
							<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="sector" type="text" class="form-control" id="sector" value="<?= isset($sector) ? $sector : ''; ?>" required="">
						</div>


						<div class="form-group">
							<label for="descuento">Porcentaje de descuento<span class="asterisk"> *</span></label>
							<input maxlength="3" min="0" max="100" pattern="^([1-9]|[1-9][0-9]|100)$" title="Por favor ingrese solo 3 números del 0 al 100" step="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="descuento" type="text" class="form-control" id="descuento" style="width: 100px;" value="<?= isset($descuento) ? $descuento : ''; ?>" required="">
						</div>

					</div>
				</div>
			</div>
			<div id="item2" class="tab">
				<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
					<h5>INFORMACIÓN DEL REPRESENTANTE</h5>
				</ol>
				<div class="form-group">
					<label for="r_last_name">Apellidos del representante<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="r_last_name" type="text" class="form-control" id="r_last_name" value="<?= isset($r_last_name) ? $r_last_name : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="r_name">Nombres del representante<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="r_name" type="text" class="form-control" id="r_name" value="<?= isset($r_name) ? $r_name : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="r_ci">C.I<span class="asterisk"> *</span></label>
					<input maxlength="10" onblur="validarCedula(this.value)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="r_ci" type="text" class="form-control" id="r_ci" value="<?= isset($r_ci) ? $r_ci : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="r_telf">Télefono a dónde ubicarlo<span class="asterisk"> *</span></label>
					<input maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="r_telf" type="telf" value="<?= isset($r_telf) ? $r_telf : ''; ?>" class="form-control" id="r_telf" required="">
				</div>
				<div class="form-group">
					<label for="r_email">Email<span class="asterisk"> *</span></label>
					<input name="r_email" type="email" class="form-control" id="r_email" value="<?= isset($r_email) ? $r_email : ''; ?>" required>
				</div>
			</div>


			<div id="item3" class="tab">
				<!-- INFORMACION FAMILIAR  -->

				<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
					<h5>INFORMACIÓN DEL PADRE</h5>
				</ol>
				<div class="form-group">
					<label for="f_apellido_padre">Apellidos del Padre<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_apellido_padre" type="text" class="form-control" id="f_apellido_padre" value="<?= isset($f_apellido_padre) ? $f_apellido_padre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_nombre_padre">Nombres del Padre<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_nombre_padre" type="text" class="form-control" id="f_nombre_padre" value="<?= isset($f_nombre_padre) ? $f_nombre_padre  : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_edad_padre">Edad<span class="asterisk"> *</span></label>
					<input maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_edad_padre" type="text" class="form-control" id="f_edad_padre" value="<?= isset($f_edad_padre) ? $f_edad_padre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_intruccion_padre">Nivel de instrucción<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_intruccion_padre" type="text" class="form-control" id="f_intruccion_padre" value="<?= isset($f_intruccion_padre) ? $f_intruccion_padre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_profesion_padre">Profesión<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_profesion_padre" type="text" class="form-control" id="f_profesion_padre" value="<?= isset($f_profesion_padre) ? $f_profesion_padre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_lugar_trabajo_padre">Lugar de trabajo<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_lugar_trabajo_padre" type="text" class="form-control" id="f_lugar_trabajo_padre" value="<?= isset($f_lugar_trabajo_padre) ? $f_lugar_trabajo_padre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_direccion_padre">Dirección<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_direccion_padre" type="text" class="form-control" id="f_direccion_padre" value="<?= isset($f_direccion_padre) ? $f_direccion_padre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_civil_padre">Estado civil<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_civil_padre" type="text" class="form-control" id="f_civil_padre" value="<?= isset($f_civil_padre) ? $f_civil_padre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_ci_padre">C.I<span class="asterisk"> *</span></label>
					<input maxlength="10" onblur="validarCedula(this.value)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_ci_padre" type="text" class="form-control" id="f_ci_padre" value="<?= isset($f_ci_padre) ? $f_ci_padre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_telf_padre">Teléfono<span class="asterisk"> *</span></label>
					<input maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_telf_padre" type="text" class="form-control" id="f_telf_padre" value="<?= isset($f_telf_padre) ? $f_telf_padre : ''; ?>" required="">
				</div>

			</div>
			<div id="item4" class="tab">
				<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
					<h5>INFORMACIÓN DE LA MADRE</h5>
				</ol>
				<div class="form-group">
					<label for="f_apellido_madre">Apellidos de la Madre<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_apellido_madre" type="text" class="form-control" id="f_apellido_madre" value="<?= isset($f_apellido_madre) ? $f_apellido_madre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_nombre_madre">Nombres de la Madre<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_nombre_madre" type="text" class="form-control" id="f_nombre_madre" value="<?= isset($f_nombre_madre) ? $f_nombre_madre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_edad_madre">Edad<span class="asterisk"> *</span></label>
					<input maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_edad_madre" type="text" class="form-control" id="f_edad_madre" value="<?= isset($f_edad_madre) ? $f_edad_madre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_intruccion_madre">Nivel de instrucción<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_intruccion_madre" type="text" class="form-control" id="f_intruccion_madre" value="<?= isset($f_intruccion_madre) ? $f_intruccion_madre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_profesion_madre">Profesión<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_profesion_madre" type="text" class="form-control" id="f_profesion_madre" value="<?= isset($f_profesion_madre) ? $f_profesion_madre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_lugar_trabajo_madre">Lugar de trabajo<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_lugar_trabajo_madre" type="text" class="form-control" id="f_lugar_trabajo_madre" value="<?= isset($f_lugar_trabajo_madre) ? $f_lugar_trabajo_madre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_direccion_madre">Dirección<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_direccion_madre" type="text" class="form-control" id="f_direccion_madre" value="<?= isset($f_direccion_madre) ? $f_direccion_madre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_civil_madre">Estado civil<span class="asterisk"> *</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_civil_madre" type="text" class="form-control" id="f_civil_madre" value="<?= isset($f_civil_madre) ? $f_civil_madre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_ci_madre">C.I<span class="asterisk"> *</span></label>
					<input maxlength="10" onblur="validarCedula(this.value)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_ci_madre" type="text" class="form-control" id="f_ci_madre" value="<?= isset($f_ci_madre) ? $f_ci_madre : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_telf_madre">Teléfono<span class="asterisk"> *</span></label>
					<input maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_telf_madre" type="text" class="form-control" id="f_telf_madre" value="<?= isset($f_telf_madre) ? $f_telf_madre : ''; ?>" required="">
				</div>

			</div>
			<div id="item5" class="tab">
				<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
					<h5>OTRA INFORMACIÓN</h5>
				</ol>
				<div class="form-group">
					<label for="f_num_per_familia">Número de personas que conforman su familia<span class="asterisk"> *</span></label>
					<input maxlength="2" min="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_num_per_familia" type="text" class="form-control" id="f_num_per_familia" value="<?= isset($f_num_per_familia) ? $f_num_per_familia : ''; ?>" required="">
				</div>
				<div class="form-group">
					<label for="f_economia">En que nivel de situación económica se encuentra<span class="asterisk"> *</span></label>
					<select name="f_economia" class="form-control" id="f_economia" required="">
						<option>Selecciona</option>
						<option value="Alta">Alta</option>
						<option value="Media">Media</option>
						<option value="Regular">Regular</option>
						<option value="Baja">Baja</option>
					</select>
				</div>
				<br>
				<div class="form-group">
					<label for="f_convive_estudiante">El/La estudiante vive con algún familiar a parte de sus padres<span class="asterisk"> *</span></label>
					<select name="f_convive_estudiante" class="form-control" id="f_convive_estudiante" required="">
						<option>Selecciona</option>
						<option value="Si">Si</option>
						<option value="No">No</option>
					</select>
				</div>
				<div class="form-group">
					<label for="f_convive_nombre">Nombre de familiar<span class="optional"> (Opcional)</label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_convive_nombre" type="text" class="form-control" id="f_convive_nombre" value="<?= isset($f_convive_nombre) ? $f_convive_nombre : ''; ?>">
				</div>
				<div class="form-group">
					<label for="f_convive_apellido">Apellido de familiar<span class="optional"> (Opcional)</label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_convive_apellido" type="text" class="form-control" id="f_convive_apellido" value="<?= isset($f_convive_apellido) ? $f_convive_apellido : ''; ?>">
				</div>
				<div class="form-group">
					<label for="f_convive_edad">Edad<span class="optional"> (Opcional)</label>
					<input maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_convive_edad" type="text" class="form-control" id="f_convive_edad" value="<?= isset($f_convive_edad) ? $f_convive_edad : ''; ?>">
				</div>
				<div class="form-group">
					<label for="f_convive_parentesco">Parentesco <span class="optional"> (Opcional)</label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_convive_parentesco" type="text" class="form-control" id="f_convive_parentesco" value="<?= isset($f_convive_parentesco) ? $f_convive_parentesco : ''; ?>">
				</div>
				<br><br><br><br>

				<div class="form-group">
					<label for="f_tipo_vivienda">Tipo de vivienda<span class="asterisk"> *</span></label>
					<select name="f_tipo_vivienda" class="form-control" id="f_tipo_vivienda" required="">
						<option>Selecciona</option>
						<option value="Propia">Propia</option>
						<option value="Arrendada">Arrendada</option>
						<option value="Prestada">Prestada</option>
					</select>
				</div>

				<div class="form-group">
					<label for="f_habitacion_niño">Habitación del niño<span class="asterisk"> *</span></label>
					<select name="f_habitacion_niño" class="form-control" id="f_habitacion_niño" required="">
						<option>Selecciona</option>
						<option value="Individual">Individual</option>
						<option value="Compartida">Compartida</option>
					</select>
					<br>
					<label for="f_nombre_habitacion_niño">Si eligio la opción "Compartida" indique con quien <span class="optional"> (Opcional)</span></label>
					<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_nombre_habitacion_niño" type="text" class="form-control" id="f_nombre_habitacion_niño" value="<?= isset($f_nombre_habitacion_niño) ? $f_nombre_habitacion_niño : ''; ?>">


				</div>

				<label for="f_time_padres_niño">Tiempo que los padres pasan con los niños<span class="asterisk"> *</span></label>
				<div style="display: flex;">
					<label for="f_time_padres_niño" style="width: 100px;display: auto;">Madre</label>
					<input name="f_time_padres_niño" type="radio" class="form-control" id="Madre" style="height: 30px !important; width: 20px; margin-right: 20px;" value="Madre" required="">
					<label for="f_time_padres_niño" style="width: 100px;display: auto;">Padre</label>
					<input name="f_time_padres_niño" type="radio" class="form-control" id="Padre" style="height: 30px !important; width: 20px;" value="Padre" required="">
				</div>
				<br>
				<!-- Observaciones se inserta en la tabla de student_info -->
				<div class="form-group">
					<label for="observaciones">Observaciones <span class="optional"> (Opcional)</label>
					<input pattern="[A-Za-z0-9\s\-\.\,\;\:\!\@\#\$\%\^\&\*\(\)\_\+\=\{\}\[\]\|\\\/\?]*" name="observaciones" type="text" class="form-control" id="observaciones" value="<?= isset($observaciones) ? $observaciones : ''; ?>">
				</div>


				<div class="form-group text-center">
					<input name="addstudent" value="Matricular Estudiante" type="submit" class="btn btn-danger">
				</div>

			</div>

</form>
</div>

</div>
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

	// DOCUMENTOS PREVIOS A VALIDAR
	const archivo = document.getElementById("prev_doc_senescyt");
	const ci = document.getElementById("prev_ci");
	const grado = document.getElementById("grado_estudiantil_prev");

	// FORMULARIO OCULTAR/APARECER
	const formulario = document.getElementById("contenedor");

	// BOTON DE VALIDACION DE DOCUMENTOS PREVIOS
	const boton = document.getElementById("prev_validar");


	boton.addEventListener("click", function() {
		if (archivo.value && ci.value && grado.value) {
			formulario.style.display = "block";
		} else {
			alert("Debe completar el archivo y cédula antes de continuar.");
		}
	});

	const tabs = document.querySelectorAll('.tab');
	const links = document.querySelectorAll('a#menu1, a#menu2, a#menu3, a#menu4, a#menu5');

	for (const link of links) {
		link.addEventListener('click', (event) => {
			event.preventDefault();
			const tabId = event.target.getAttribute('data-tab');
			for (const tab of tabs) {
				tab.classList.remove('active');
				if (tab.getAttribute('id') === tabId) {
					tab.classList.add('active');
				}
			}
		});
	}
</script>