
<?php
include('./conexion.php');
session_start();
if (isset($_SESSION['user_login'])) {
    $id = base64_decode($_GET['id']);
    // $photo = base64_decode($_GET['photo']);
    if (mysqli_query($conexion, "DELETE FROM `entrevista_estudiante` WHERE `id_ficha` = $id; ")) {
        header('Location: index.php?page=dashboard&delete_interview=success');


        if (mysqli_query($conexion, "DELETE FROM `entrevista_historia_familiar` WHERE `id_ficha` = $id;")) {
            header('Location: index.php?page=dashboard&delete_interview=success');


            if (mysqli_query($conexion, "DELETE FROM `entrevista_ficha` WHERE `id_ficha` = $id; ")) {
                header('Location: index.php?page=dashboard&delete_interview=success');
            }
        }
    } else {
        header('Location: index.php?page=dashboard&delete_interview=error');
    }
} else {
    header('Location: login.php');
}
