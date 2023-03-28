<?php

include('./validar_cedula.php');

$corepage = explode('/', $_SERVER['PHP_SELF']);
$corepage = end($corepage);
if ($corepage !== 'index.php') {
    if ($corepage == $corepage) {
        $corepage = explode('.', $corepage);
        header('Location: index.php?page=' . $corepage[0]);
    }
}

// if (isset($_POST['validar'])) {
//     $cedula = $_POST['cedula'];
//     $respuesta = validarCedula($cedula);
//     if ($respuesta == true) {
//         echo 'cedula validada';
//     } else {
//         echo 'cedula no validada';
//     }
// }


?>


<form method="post">
    <label for="cedula">Ingresar cedula</label>
    <input type="text" name="cedula" id="cedula" onblur="validarCedula(this.value)">
    <input name="validar" value="Validar cédula" type="submit" class="btn btn-danger">
</form>


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
        // return (resultado === digitoVerificador);
        // alert(resultado);
        if (resultado === digitoVerificador) {
            alert("Cedula Valida");
        } else {
            alert("Cedula NO Valida");
        }


    }
</script>