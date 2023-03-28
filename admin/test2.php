<!DOCTYPE html>
<html>

<head>
  <title>Menú con formularios</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      // Ocultar todos los formularios al cargar la página
      $('form').hide();

      // Mostrar el formulario correspondiente al ítem seleccionado
      $('#item1').click(function() {
        $('form').hide();
        $('#form1').show();
      });

      $('#item2').click(function() {
        $('form').hide();
        $('#form2').show();
      });

      $('#item3').click(function() {
        $('form').hide();
        $('#form3').show();
      });

      $('#item4').click(function() {
        $('form').hide();
        $('#form4').show();
      });
    });
  </script>
</head>

<body>
  <h1>Menú con formularios</h1>
  <ul>
    <li id="item1">Ítem 1</li>
    <li id="item2">Ítem 2</li>
    <li id="item3">Ítem 3</li>
    <li id="item4">Ítem 4</li>
  </ul>
  <form id="form1">
    <h2>Formulario 1</h2>
    <label>Nombre:</label>
    <input type="text" name="nombre">
    <label>Apellido:</label>
    <input type="text" name="apellido">
    <button type="submit">Enviar</button>
  </form>
  <form id="form2">
    <h2>Formulario 2</h2>
    <label>Email:</label>
    <input type="email" name="email">
    <label>Teléfono:</label>
    <input type="tel" name="telefono">
    <button type="submit">Enviar</button>
  </form>
  <form id="form3">
    <h2>Formulario 3</h2>
    <label>Edad:</label>
    <input type="number" name="edad">
    <label>Género:</label>
    <select name="genero">
      <option value="masculino">Masculino</option>
      <option value="femenino">Femenino</option>
      <option value="otro">Otro</option>
    </select>
    <button type="submit">Enviar</button>
  </form>
  <form id="form4">
    <h2>Formulario 4</h2>
    <label>País:</label>
    <input type="text" name="pais">
    <label>Ciudad:</label>
    <input type="text" name="ciudad">
    <button type="submit">Enviar</button>
  </form>
</body>

</html>