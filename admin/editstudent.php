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

echo "<H1>" . $id . "</H1>";





// if (mysqli_query($conexion, $query_estudiante)) {
// 	move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo);
// 	$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Ingresado Exitosamente</p>';
// 	mysqli_close($conexion);
// } else {
// 	$datainsert['inserterror'] = '<p style="color: red;">Estudiante no ingresado, revise la información diligenciada.</p>';
// 	mysqli_close($conexion);
// }






if (isset($_POST['updatestudent'])) {


	$matricula = $_POST['matricula'];						//
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



	if (!empty($_FILES['photo']['name'])) {
		$photo = $_FILES['photo']['name'];
		$photo = explode('.', $photo);
		$photo = end($photo);
		$photo = $roll . date('Y-m-d-m-s') . '.' . $photo;
	} else {
		$photo = $oldPhoto;
	}


	$query_update = "UPDATE `student_info` SET `matricula`='$matricula', `tipo`='$tipo', `last_name`='$last_name', `grado_estudiantil`='$grado_estudiantil', `birthdate`='$birthdate', `nacionalidad`='$nacionalidad', `sexo`='$sexo', `address`='$address', `sector`='$sector', `descuento`='$descuento', `observaciones`='$observaciones', `photo`='$photo' WHERE `id`= $id";
	if (mysqli_query($conexion, $query_update)) {
		$datainsert['insertsucess'] = '<p style="color: green;">Estudiante Actualizado!</p>';
		if (!empty($_FILES['photo']['name'])) {
			move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo);
			unlink('images/' . $oldPhoto);
		}
		header('Location: index.php?page=all-student&edit=success');
	} else {
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

<?php
if (isset($id)) {
	$query_select = "SELECT `id`, `matricula`, `tipo`, `last_name`, `name`,  `grado_estudiantil`, `birthdate`, `nacionalidad`, `sexo`, `direccion`, `sector`, `descuento`, `observaciones`, `photo` FROM `student_info` WHERE `id`=$id";
	$result = mysqli_query($conexion, $query_select);
	$row = mysqli_fetch_array($result);
}
?>
<div class="row">
	<div class="col-sm-6">
		<form enctype="multipart/form-data" method="POST" action="">

		<?php echo $row['birthdate']; ?>

			<div class="form-group" style="display: flex;">
				<label for="matricula" style="width: 120px;">N° Matricula</label>
				<input name="matricula" style="width: 150px; padding: 0;" type="text" value="<?php echo $row['matricula']; ?>" class="form-control" pattern="[0-9]{6}" id="matricula" required="">
			</div>
			<div>
				<label for="photo">Fotografía del Estudiante</label>
				<input name="photo" style="width: 400px;" type="file" class="form-control" id="photo" required="">
			</div>
			<div style="display: flex; padding: 10px;">
				<label for="check_new_estudiante" style="width: 150px;display: auto;">Nuevo postulante</label>
				<input name="check_new_estudiante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="Nuevo" <?= $row['tipo'] == 'Nuevo' ? 'checked' : '' ?> required="">


				<label for="check_new_estudiante" style="width: 170px;display: auto;margin-left: 50px;">Estudiante de la UEPP</label>
				<input name="check_new_estudiante" type="radio" class="form-control" style="height: 30px !important; width: 20px;" value="UEPP" <?= $row['tipo'] == 'UEPP' ? 'checked' : '' ?> required="">

			</div>

			<div class="form-group">
				<label for="last_name">Apellidos</label>
				<input name="last_name" type="text" class="form-control" id="last_name" value="<?php echo $row['last_name']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="name">Nombres</label>
				<input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="class">Grado Estudiantil</label>
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
				<label for="birthdate">Fecha de nacimiento</label>
				<input name="birthdate" type="date" class="form-control" id="birthdate" value=" <?php echo $row['birthdate']; ?> " required="">
			</div>

			<div class="form-group">
				<label for="nacionalidad">Nacionalidad</label>
				<input name="nacionalidad" type="text" class="form-control" id="nacionalidad" value="<?php echo $row['nacionalidad']; ?>" required="">
			</div>
			<div class="form-group">
				<label for="sexo">Sexo</label>
				<div style="display: flex;">
					<label for="sexo" style="width: 100px;display: auto;">Masculino</label>
					<input name="sexo" type="radio" class="form-control" id="masculino" style="height: 30px !important; width: 20px; margin-right: 20px;" value="Masculino"  <?= $row['sexo'] == 'Masculino' ? 'checked' : '' ?> required="">
					<label for="sexo" style="width: 100px;display: auto;">Femenino</label>
					<input name="sexo" type="radio" class="form-control" id="Femenino" style="height: 30px !important; width: 20px;" value="Femenino"  <?= $row['sexo'] == 'Femenino' ? 'checked' : '' ?>  required="">
				</div>


			</div>
			<div class="form-group">
				<label for="address">Dirección</label>
				<input name="address" type="text" value="<?php echo $row['direccion']; ?>" class="form-control" id="address" required="">
			</div>

			<div class="form-group">
				<label for="sector">Barrio/Setor</label>
				<input name="sector" type="text" class="form-control" id="sector" value="<?php echo $row['sector']; ?>" required="">
			</div>


			<div class="form-group">
				<label for="descuento">Porcentaje de descuento</label>
				<input name="descuento" type="number" class="form-control" id="descuento" style="width: 100px;" value="<?php echo $row['descuento']; ?>" required="">
			</div>

			<div class="form-group">
				<label for="observaciones">Observaciones</label>
				<input name="observaciones" type="text" class="form-control" id="observaciones" value="<?php echo $row['observaciones']; ?>" required="">
			</div>







			<!-- BOTON DE AGREGAR  -->
			<div class="form-group text-center">
				<input name="updatestudent" value="Editar Estudiante" type="submit" class="btn btn-danger">
			</div>

			<!-- INFORMACION DEL REPRESENTANTE -->

		</form>
	</div>
</div>