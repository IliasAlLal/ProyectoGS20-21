<?php
header("Content-Type: text/html;charset=utf-8");
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "proyecto";

    // Creamos la conexion a la base de datos 
     $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // comprobamos la conexion de la base de datos 
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
sleep(1);
//comprueba si los dos campos de de contraseña son iguales 
if (isset($_POST)) {
    $contra1 = (string)$_POST['contrasena'];
    $contra2 = (string)$_POST['contrasenarep'];
 

 
    if ($contra1 != $contra2) {
        echo '<div class="alert alert-danger"><strong>Las contraseñas no coinciden</div>';
    } else {
        echo '';
    }
}