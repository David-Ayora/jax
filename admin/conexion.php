<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "jax";

$conexion = new mysqli($servername, $username, $password, $database) or die('Error al conectar'. mysqli_errno($connect));
