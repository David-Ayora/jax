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

$id = base64_decode($_GET['id']);
$oldPhoto = base64_decode($_GET['photo']);


if (isset($_POST['updatestudent'])) {
	$matricula = trim($_POST['matricula']);
	$tipo = trim($_POST['check_new_estudiante']);
	$last_name = trim($_POST['last_name']);
	$name = trim($_POST['name']);
	$grado_estudiantil = trim($_POST['grado_estudiantil']);
	$birthdate = trim($_POST['birthdate']);
	$nacionalidad = trim($_POST['nacionalidad']);
	$sexo = trim($_POST['sexo']);
	$address = trim($_POST['address']);
	$sector = trim($_POST['sector']);
	$descuento = trim($_POST['descuento']);
	$observaciones = trim($_POST['observaciones']);


	// INFORMACIÓN DEL REPRESENTANTE

	$r_last_name = trim($_POST['r_last_name']);
	$r_name = trim($_POST['r_name']);
	$r_ci = trim($_POST['r_ci']);
	$r_telf = trim($_POST['r_telf']);
	$r_email = trim($_POST['r_email']);


	// INFORMACIÓN FAMILIAR

	// Informacion del padre 
	$f_apellido_padre = trim($_POST['f_apellido_padre']);
	$f_nombre_padre = trim($_POST['f_nombre_padre']);
	$f_edad_padre = trim($_POST['f_edad_padre']);
	$f_intruccion_padre = trim($_POST['f_intruccion_padre']);
	$f_profesion_padre = trim($_POST['f_profesion_padre']);
	$f_lugar_trabajo_padre = trim($_POST['f_lugar_trabajo_padre']);
	$f_direccion_padre = trim($_POST['f_direccion_padre']);
	$f_civil_padre = trim($_POST['f_civil_padre']);
	$f_ci_padre = trim($_POST['f_ci_padre']);
	$f_telf_padre = trim($_POST['f_telf_padre']);

	// Informacion de la madre 
	$f_apellido_madre = trim($_POST['f_apellido_madre']);
	$f_nombre_madre = trim($_POST['f_nombre_madre']);
	$f_edad_madre = trim($_POST['f_edad_madre']);
	$f_intruccion_madre = trim($_POST['f_intruccion_madre']);
	$f_profesion_madre = trim($_POST['f_profesion_madre']);
	$f_lugar_trabajo_madre = trim($_POST['f_lugar_trabajo_madre']);
	$f_direccion_madre = trim($_POST['f_direccion_madre']);
	$f_civil_madre = trim($_POST['f_civil_madre']);
	$f_ci_madre = trim($_POST['f_ci_madre']);
	$f_telf_madre = trim($_POST['f_telf_madre']);

	// Otra información
	$f_num_per_familia = trim($_POST['f_num_per_familia']);
	$f_economia = trim($_POST['f_economia']);
	$f_convive_estudiante = trim($_POST['f_convive_estudiante']);
	$f_convive_nombre = trim($_POST['f_convive_nombre']);
	$f_convive_apellido = trim($_POST['f_convive_apellido']);
	$f_convive_edad = trim($_POST['f_convive_edad']);
	$f_convive_parentesco = trim($_POST['f_convive_parentesco']);
	$f_tipo_vivienda = trim($_POST['f_tipo_vivienda']);
	$f_habitacion_niño = trim($_POST['f_habitacion_niño']);
	$f_nombre_habitacion_niño = trim($_POST['f_nombre_habitacion_niño']);
	$f_time_padres_niño = trim($_POST['f_time_padres_niño']);




	if (!empty($_FILES['photo']['name'])) {
		$photo = $_FILES['photo']['name'];
		$photo = explode('.', $photo);
		$photo = end($photo);
		$photo = $matricula . date('Y-m-d-m-s') . '.' . $photo;
	} else {
		$photo = $oldPhoto;
	}


	$query_update_estudiante = "UPDATE student_info SET 
	matricula = '$matricula', 
	tipo = '$tipo', 
	last_name = '$last_name', 
	`name` = '$name', 
	grado_estudiantil = '$grado_estudiantil', 
	birthdate = '$birthdate', 
	nacionalidad = '$nacionalidad', 
	sexo = '$sexo',
	direccion = '$address', 
	sector = '$sector', 
	photo = '$photo', 
	observaciones = '$observaciones', 
	descuento = '$descuento'
	WHERE id = $id;";

	$query_update_representante = "UPDATE student_representante SET
	r_last_name = '$r_last_name', 
	r_name = '$r_name', 
	r_ci = '$r_ci', 
	r_telf = '$r_telf', 
	r_email = '$r_email'
	WHERE id_estudiante = $id;";




	$query_update_familiar = "UPDATE student_family SET
	f_apellido_padre = '$f_apellido_padre', 
	f_nombre_padre = '$f_nombre_padre', 
	f_edad_padre = '$f_edad_padre', 
	f_intruccion_padre = '$f_intruccion_padre', 
	f_profesion_padre = '$f_profesion_padre', 
	f_lugar_trabajo_padre = '$f_lugar_trabajo_padre', 
	f_direccion_padre = '$f_direccion_padre', 
	f_civil_padre = '$f_civil_padre', 
	f_ci_padre = '$f_ci_padre', 
	f_telf_padre = '$f_telf_padre', 
	f_apellido_madre = '$f_apellido_madre', 
	f_nombre_madre = '$f_nombre_madre', 
	f_edad_madre = '$f_edad_madre', 
	f_intruccion_madre = '$f_intruccion_madre', 
	f_profesion_madre = '$f_profesion_madre', 
	f_lugar_trabajo_madre = '$f_lugar_trabajo_madre', 
	f_direccion_madre = '$f_direccion_madre', 
	f_civil_madre = '$f_civil_madre', 
	f_ci_madre = '$f_ci_madre', 
	f_telf_madre = '$f_telf_madre', 
	f_num_per_familia = '$f_num_per_familia', 
	f_economia = '$f_economia', 
	f_convive_estudiante = '$f_convive_estudiante', 
	f_convive_nombre = '$f_convive_nombre', 
	f_convive_apellido = '$f_convive_apellido', 
	f_convive_edad = '$f_convive_edad', 
	f_convive_parentesco = '$f_convive_parentesco', 
	f_tipo_vivienda = '$f_tipo_vivienda', 
	f_habitacion_niño = '$f_habitacion_niño', 
	f_nombre_habitacion_niño = '$f_nombre_habitacion_niño', 
	f_time_padres_niño = '$f_time_padres_niño' 
	WHERE id_student = $id;";


	if (mysqli_query($conexion, $query_update_estudiante)) {

		if (!empty($_FILES['photo']['name'])) {
			move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo);
			unlink('images/' . $oldPhoto);
		}

		if (mysqli_query($conexion, $query_update_representante)) {
			# code...
			if (mysqli_query($conexion, $query_update_familiar)) {
				$datainsert['insertsucess'] = '<p style="color: green;">¡Estudiante Actualizado!</p>';
				header('Location: index.php?page=all-student&edit=success');
			} else {
				echo "<br>Error de ingreso de familia<br>";
			}
		} else {
			echo "<br>Error de ingreso de representante<br>";
		}
	} else {
		echo "<br>Error de ingreso de estudiante<br>";
		header('Location: index.php?page=all-student&edit=error');
	}
}
?>
<h1 class="text-primary"><i class="fas fa-user-plus"></i> Editar Información de Estudiante<small class="text-warning"> Editar</small></h1>
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page"><a href="index.php">Panel de Control </a></li>
		<li class="breadcrumb-item" aria-current="page"><a href="index.php?page=all-student">Todos los Estudiantes </a></li>
		<li class="breadcrumb-item active" aria-current="page">Editar Estudiante</li>
	</ol>
</nav>
<br>
<?php
if (isset($id)) {

	// Información del estudiante
	$query_select = "SELECT * FROM `student_info` WHERE `id`=$id";
	$result = mysqli_query($conexion, $query_select);
	$row = mysqli_fetch_array($result);

	// Información del representante
	$query_select_representante = "SELECT * FROM `student_representante` WHERE `id_estudiante`=$id";
	$result_r = mysqli_query($conexion, $query_select_representante);
	$row_r = mysqli_fetch_array($result_r);

	// Información familiar
	$query_select_familiar = "SELECT * FROM `student_family` WHERE `id_student`=$id";
	$result_f = mysqli_query($conexion, $query_select_familiar);
	$row_f = mysqli_fetch_array($result_f);
}

?>
<div class="row">
	<div class="col-sm-12">
		<form enctype="multipart/form-data" method="POST" action="">
			<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
				<h5>INFORMACIÓN DEL ESTUDIANTE</h5>
			</ol>
			<br><br>
			<div class="form-group" style="display: flex;">
				<label for="matricula" style="width: 120px;">N° Matricula<span class="asterisk"> *</span></label>
				<input name="matricula" style="width: 150px; padding: 0;" type="text" value="<?php echo $row['matricula']; ?>" class="form-control" pattern="[0-9]{6}" id="matricula" required="">
			</div>
			<div>
				<label for="photo">Fotografía del Estudiante<span class="asterisk"> *</span></label>
				<input name="photo" style="width: 400px;" type="file" class="form-control" id="photo" value="<?php echo $row['photo']; ?>">
			</div>
			<div style="display: flex; padding: 10px;">
				<label for="check_new_estudiante" style="width: 150px;display: auto;">Nuevo postulante</label>
				<input name="check_new_estudiante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Nuevo" <?= $row['tipo'] == 'Nuevo' ? 'checked' : '' ?> required="">


				<label for="check_new_estudiante" style="width: 170px;display: auto;margin-left: 50px;">Estudiante de la UEPP</label>
				<input name="check_new_estudiante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="UEPP" <?= $row['tipo'] == 'UEPP' ? 'checked' : '' ?> required="">

			</div>

			<div class="form-group">
				<label for="last_name">Apellidos<span class="asterisk"> *</span></label>
				<input name="last_name" type="text" class="form-control" id="last_name" value="<?php echo $row['last_name']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="name">Nombres<span class="asterisk"> *</span></label>
				<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="class">Grado Estudiantil<span class="asterisk"> *</span></label>
				<select name="grado_estudiantil" class="form-control" id="grado_estudiantil" required="">
					<option>Selecciona</option>
					<option value="Primero" <?= $row['grado_estudiantil'] == 'Primero' ? 'selected' : '' ?>>Primero</option>
					<option value="Segundo" <?= $row['grado_estudiantil'] == 'Segundo' ? 'selected' : '' ?>>Segundo</option>
					<option value="Tercero" <?= $row['grado_estudiantil'] == 'Tercero' ? 'selected' : '' ?>>Tercero</option>
					<option value="Cuarto" <?= $row['grado_estudiantil'] == 'Cuarto' ? 'selected' : '' ?>>Cuarto</option>
					<option value="Quinto" <?= $row['grado_estudiantil'] == 'Quinto' ? 'selected' : '' ?>>Quinto</option>
					<option value="Sexto" <?= $row['grado_estudiantil'] == 'Sexto' ? 'selected' : '' ?>>Sexto</option>
					<option value="Septimo" <?= $row['grado_estudiantil'] == 'Septimo' ? 'selected' : '' ?>>Septimo</option>
					<option value="Octavo" <?= $row['grado_estudiantil'] == 'Octavo' ? 'selected' : '' ?>>Octavo</option>
					<option value="Noveno" <?= $row['grado_estudiantil'] == 'Noveno' ? 'selected' : '' ?>>Noveno</option>
					<option value="Decimo" <?= $row['grado_estudiantil'] == 'Decimo' ? 'selected' : '' ?>>Decimo</option>
					<option value="Primero BGU" <?= $row['grado_estudiantil'] == 'Primero BGU' ? 'selected' : '' ?>>Primero BGU</option>
					<option value="Segundo BGU" <?= $row['grado_estudiantil'] == 'Segundo BGU' ? 'selected' : '' ?>>Segundo BGU</option>
					<option value="Tercero BGU" <?= $row['grado_estudiantil'] == 'Tercero BGU' ? 'selected' : '' ?>>Tercero BGU</option>

				</select>
			</div>
			<div class="form-group">
				<label for="birthdate">Fecha de nacimiento<span class="asterisk"> *</span></label>
				<input name="birthdate" type="date" class="form-control" id="birthdate" value="<?php echo $row['birthdate']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="nacionalidad">Nacionalidad<span class="asterisk"> *</span></label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?php echo $row['nacionalidad']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="sexo">Sexo<span class="asterisk"> *</span></label>
				<div style="display: flex;">
					<label for="sexo" style="width: 100px;display: auto;">Masculino</label>
					<input name="sexo" type="radio" class="form-control" id="masculino" style="height: 30px !important; width: 20px; margin-right: 20px;" value="Masculino" <?= $row['sexo'] == 'Masculino' ? 'checked' : '' ?> required="">
					<label for="sexo" style="width: 100px;display: auto;">Femenino</label>
					<input name="sexo" type="radio" class="form-control" id="Femenino" style="height: 30px !important; width: 20px;" value="Femenino" <?= $row['sexo'] == 'Femenino' ? 'checked' : '' ?> required="">
				</div>


			</div>
			<div class="form-group">
				<label for="address">Dirección<span class="asterisk"> *</span></label>
				<input name="address" type="text" value="<?php echo $row['direccion']; ?>" class="form-control" id="address" required="">
			</div>

			<div class="form-group">
				<label for="sector">Barrio/Setor<span class="asterisk"> *</span></label>
				<input name="sector" type="text" class="form-control" id="sector" value="<?php echo $row['sector']; ?>" required="">
			</div>


			<div class="form-group">
				<label for="descuento">Porcentaje de descuento<span class="asterisk"> *</span></label>
				<input name="descuento" type="number" class="form-control" id="descuento" style="width: 100px;" value="<?php echo $row['descuento']; ?>" required="">
			</div>






			<!-- INFORMACION DEL REPRESENTANTE -->

			<br><br><br>
			<ol style="text-align: center !important; padding: 15px; background-color: #e9ecef;">
				<h5>INFORMACIÓN DEL REPRESENTANTE</h5>
			</ol>
			<br><br>
			<div class="form-group">
				<label for="r_last_name">Apellidos del representante<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="r_last_name" type="text" class="form-control" id="r_last_name" value="<?php echo $row_r['r_last_name']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="r_name">Nombres del representante<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="r_name" type="text" class="form-control" id="r_name" value="<?php echo $row_r['r_name']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="r_ci">C.I<span class="asterisk"> *</span></label>
				<input maxlength="10" onblur="validarCedula(this.value)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="r_ci" type="text" class="form-control" id="" value="<?php echo $row_r['r_ci']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="r_telf">Télefono a dónde ubicarlo<span class="asterisk"> *</span></label>
				<input maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="r_telf" type="telf" value="<?php echo $row_r['r_telf']; ?>" class="form-control" id="r_telf" required="">
			</div>
			<div class="form-group">
				<label for="r_email">Email<span class="asterisk"> *</span></label>
				<input name="r_email" type="email" class="form-control" id="r_email" value="<?php echo $row_r['r_email']; ?>" required>
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
				<label for="f_apellido_padre">Apellidos del Padre<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_apellido_padre" type="text" class="form-control" id="f_apellido_padre" value="<?php echo $row_f['f_apellido_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_nombre_padre">Nombres del Padre<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_nombre_padre" type="text" class="form-control" id="f_nombre_padre" value="<?php echo $row_f['f_nombre_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_edad_padre">Edad<span class="asterisk"> *</span></label>
				<input maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_edad_padre" type="text" class="form-control" id="f_edad_padre" value="<?php echo $row_f['f_edad_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_intruccion_padre">Nivel de instrucción<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_intruccion_padre" type="text" class="form-control" id="f_intruccion_padre" value="<?php echo $row_f['f_intruccion_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_profesion_padre">Profesión<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_profesion_padre" type="text" class="form-control" id="f_profesion_padre" value="<?php echo $row_f['f_profesion_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_lugar_trabajo_padre">Lugar de trabajo<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_lugar_trabajo_padre" type="text" class="form-control" id="f_lugar_trabajo_padre" value="<?php echo $row_f['f_lugar_trabajo_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_direccion_padre">Dirección<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_direccion_padre" type="text" class="form-control" id="f_direccion_padre" value="<?php echo $row_f['f_direccion_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_civil_padre">Estado civil<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_civil_padre" type="text" class="form-control" id="f_civil_padre" value="<?php echo $row_f['f_civil_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_ci_padre">C.I<span class="asterisk"> *</span></label>
				<input maxlength="10" onblur="validarCedula(this.value)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_ci_padre" type="text" class="form-control" id="f_ci_padre" value="<?php echo $row_f['f_ci_padre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_telf_padre">Teléfono<span class="asterisk"> *</span></label>
				<input maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_telf_padre" type="text" class="form-control" id="f_telf_padre" value="<?php echo $row_f['f_telf_padre']; ?>" required="">
			</div>

			<br><br>
			<H1>Información de la Madre</H1>
			<br>
			<div class="form-group">
				<label for="f_apellido_madre">Apellidos de la Madre<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_apellido_madre" type="text" class="form-control" id="f_apellido_madre" value="<?php echo $row_f['f_apellido_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_nombre_madre">Nombres de la Madre<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_nombre_madre" type="text" class="form-control" id="f_nombre_madre" value="<?php echo $row_f['f_nombre_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_edad_madre">Edad<span class="asterisk"> *</span></label>
				<input maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_edad_madre" type="text" class="form-control" id="f_edad_madre" value="<?php echo $row_f['f_edad_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_intruccion_madre">Nivel de instrucción<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_intruccion_madre" type="text" class="form-control" id="f_intruccion_madre" value="<?php echo $row_f['f_intruccion_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_profesion_madre">Profesión<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_profesion_madre" type="text" class="form-control" id="f_profesion_madre" value="<?php echo $row_f['f_profesion_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_lugar_trabajo_madre">Lugar de trabajo<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_lugar_trabajo_madre" type="text" class="form-control" id="f_lugar_trabajo_madre" value="<?php echo $row_f['f_lugar_trabajo_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_direccion_madre">Dirección<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_direccion_madre" type="text" class="form-control" id="f_direccion_madre" value="<?php echo $row_f['f_direccion_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_civil_madre">Estado civil<span class="asterisk"> *</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_civil_madre" type="text" class="form-control" id="f_civil_madre" value="<?php echo $row_f['f_civil_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_ci_madre">C.I<span class="asterisk"> *</span></label>
				<input maxlength="10" onblur="validarCedula(this.value)" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_ci_madre" type="text" class="form-control" id="f_ci_madre" value="<?php echo $row_f['f_ci_madre']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_telf_madre">Teléfono<span class="asterisk"> *</span></label>
				<input maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_telf_madre" type="text" class="form-control" id="f_telf_madre" value="<?php echo $row_f['f_telf_madre']; ?>" required="">
			</div>

			<br><br><br><br>
			<H1>Otra Información</H1>
			<br>
			<div class="form-group">
				<label for="f_num_per_familia">Número de personas que conforman su familia<span class="asterisk"> *</span></label>
				<input maxlength="2" min="1" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_num_per_familia" type="text" class="form-control" id="f_num_per_familia" value="<?php echo $row_f['f_num_per_familia']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="f_economia">En que nivel de situación económica se encuentra<span class="asterisk"> *</span></label>
				<select name="f_economia" class="form-control" id="f_economia" required="">
					<option>Selecciona</option>
					<option value="Alta" <?= $row_f['f_economia'] == 'Alta' ? 'selected' : '' ?>>Alta</option>
					<option value="Media" <?= $row_f['f_economia'] == 'Media' ? 'selected' : '' ?>>Media</option>
					<option value="Regular" <?= $row_f['f_economia'] == 'Regular' ? 'selected' : '' ?>>Regular</option>
					<option value="Baja" <?= $row_f['f_economia'] == 'Baja' ? 'selected' : '' ?>>Baja</option>
				</select>
			</div>
			<br>
			<div class="form-group">
				<label for="f_convive_estudiante">El/La estudiante vive con algún familiar a parte de sus padres<span class="asterisk"> *</span></label>
				<select name="f_convive_estudiante" class="form-control" id="f_convive_estudiante" required="">
					<option>Selecciona</option>
					<option value="Si" <?= $row_f['f_convive_estudiante'] == 'Si' ? 'selected' : '' ?>>Si</option>
					<option value="No" <?= $row_f['f_convive_estudiante'] == 'No' ? 'selected' : '' ?>>No</option>
				</select>
			</div>
			<div class="form-group">
				<label for="f_convive_nombre">Nombre de familiar<span class="optional"> (Opcional)</label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_convive_nombre" type="text" class="form-control" id="f_convive_nombre" value="<?php echo $row_f['f_convive_nombre']; ?>">
			</div>
			<div class="form-group">
				<label for="f_convive_apellido">Apellido de familiar<span class="optional"> (Opcional)</label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_convive_apellido" type="text" class="form-control" id="f_convive_apellido" value="<?php echo $row_f['f_convive_apellido']; ?>">
			</div>
			<div class="form-group">
				<label for="f_convive_edad">Edad<span class="optional"> (Opcional)</label>
				<input maxlength="2" onkeypress="return event.charCode >= 48 && event.charCode <= 57" title="Por favor, introduce solo números del teclado" name="f_convive_edad" type="text" class="form-control" id="f_convive_edad" value="<?php echo $row_f['f_convive_edad']; ?>">
			</div>
			<div class="form-group">
				<label for="f_convive_parentesco">Parentesco <span class="optional"> (Opcional)</label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_convive_parentesco" type="text" class="form-control" id="f_convive_parentesco" value="<?php echo $row_f['f_convive_parentesco']; ?>">
			</div>

			<div class="form-group">
				<label for="f_tipo_vivienda">Tipo de vivienda<span class="asterisk"> *</span></label>
				<select name="f_tipo_vivienda" class="form-control" id="f_tipo_vivienda" required="">
					<option>Selecciona</option>
					<option value="Propia" <?= $row_f['f_tipo_vivienda'] == 'Propia' ? 'selected' : '' ?>>Propia</option>
					<option value="Arrendada" <?= $row_f['f_tipo_vivienda'] == 'Arrendada' ? 'selected' : '' ?>>Arrendada</option>
					<option value="Prestada" <?= $row_f['f_tipo_vivienda'] == 'Prestada' ? 'selected' : '' ?>>Prestada</option>
				</select>
			</div>

			<div class="form-group">
				<label for="f_habitacion_niño">Habitación del niño<span class="asterisk"> *</span></label>
				<select name="f_habitacion_niño" class="form-control" id="f_habitacion_niño" required="">
					<option>Selecciona</option>
					<option value="Individual" <?= $row_f['f_habitacion_niño'] == 'Individual' ? 'selected' : '' ?>>Individual</option>
					<option value="Compartida" <?= $row_f['f_habitacion_niño'] == 'Compartida' ? 'selected' : '' ?>>Compartida</option>
				</select>
				<br>
				<label for="f_nombre_habitacion_niño">Si eligio la opción "Compartida" indique con quien <span class="optional"> (Opcional)</span></label>
				<input onkeypress="return /^[a-zA-Z\s]*$/.test(event.key)" name="f_nombre_habitacion_niño" type="text" class="form-control" id="f_nombre_habitacion_niño" value="<?php echo $row_f['f_nombre_habitacion_niño']; ?>">
			</div>

			<label for="f_time_padres_niño">Tiempo que los padres pasan con los niños<span class="asterisk"> *</span></label>
			<div style="display: flex;">
				<label for="f_time_padres_niño" style="width: 100px;display: auto;">Madre</label>
				<input name="f_time_padres_niño" type="radio" class="form-control" id="Madre" style="height: 30px !important; width: 20px; margin-right: 20px;" value="Madre" <?= $row_f['f_time_padres_niño'] == 'Madre' ? 'checked' : '' ?> required="">
				<label for="f_time_padres_niño" style="width: 100px;display: auto;">Padre</label>
				<input name="f_time_padres_niño" type="radio" class="form-control" id="Padre" style="height: 30px !important; width: 20px;" value="Padre" <?= $row_f['f_time_padres_niño'] == 'Padre' ? 'checked' : '' ?> required="">
			</div>
			<br>


			<!-- Observaciones se inserta en la tabla de student_info -->

			<div class="form-group">
				<label for="observaciones">Observaciones</label>
				<input name="observaciones" type="text" class="form-control" id="observaciones" value="<?php echo $row['observaciones']; ?>">
			</div>

			<!-- BOTON DE AGREGAR  -->
			<div class="form-group text-center">
				<input name="updatestudent" value="Editar Estudiante" type="submit" class="btn btn-danger">
			</div>

			<!-- INFORMACION DEL REPRESENTANTE -->

		</form>
	</div>
</div>