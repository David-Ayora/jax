<?php
function validarCedula($cedula) {
    // Limpiamos la cédula de caracteres no numéricos
    $cedula = preg_replace('/[^0-9]/', '', $cedula);
  
    // Verificamos que la cédula tenga 10 dígitos
    if (strlen($cedula) != 10) {
      return false;
    }
  
    // Calculamos el dígito verificador
    $coeficientes = array(2, 1, 2, 1, 2, 1, 2, 1, 2);
    $suma = 0;
    for ($i = 0; $i < 9; $i++) {
      $valor = $cedula[$i] * $coeficientes[$i];
      if ($valor >= 10) {
        $valor -= 9;
      }
      $suma += $valor;
    }
    $verificador = 10 - ($suma % 10);
    if ($verificador == 10) {
      $verificador = 0;
    }
  
    // Comparamos el dígito verificador calculado con el de la cédula
    if ($cedula[9] == $verificador) {
      return true;
    } else {
      return false;
    }
  }
  