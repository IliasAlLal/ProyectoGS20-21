<?php
header("Content-Type: text/html;charset=utf-8");
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "proyecto";

    // Crear la conexion a la base de datos
     $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // comprueba la conexion a la basd de datos
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
sleep(1);
//comprueba si el campo telefono solo se le puede añadir numeros y una cantidad del mismo
if (isset($_POST)) {
    $telefono = $_POST['telefono'];
    $pattern = "/[0-9]{9}/";
    $p = preg_match($pattern, $telefono);
    if (!$p) {
        echo '<div class="alert alert-danger"><strong>No es un Numero de Telefono Valido</div>';
    } else {
        echo '';
    }
}