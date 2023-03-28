<!DOCTYPE html>
<html>

<head>
	<title>Botón para mostrar/ocultar un div</title>
	<style>
		.oculto {
			display: none;
		}
	</style>
</head>

<body>


		<h2>Título del div</h2>
		<input type="text" id="texto" placeholder="Escribe 'Hola Mundo' para mostrar el botón">
	</div>

	<button id="boton" class="oculto">Matricular</button>

</body>
<script>
	const boton = document.getElementById('boton');
	const texto = document.getElementById('texto');
	const contenedor = document.querySelector('.contenedor');

	texto.addEventListener('input', () => {
		if (texto.value === 'Hola Mundo') {
			boton.classList.remove('oculto');
		} else {
			boton.classList.add('oculto');
		}
	});

	boton.addEventListener('click', () => {
		contenedor.classList.toggle('oculto');
	});
</script>

</html>