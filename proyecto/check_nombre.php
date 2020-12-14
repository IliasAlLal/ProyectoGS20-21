<?php
header("Content-Type: text/html;charset=utf-8");
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "proyecto";

    // Crea la conexion a la base de datos
     $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // compueba la conexion a la base de datos 
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
sleep(1);
//comprueba que en el nombre no hay  numeros 
if (isset($_POST)) {
    $nombre = $_POST['nombre'];
    $pattern = "/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/";
    $p = preg_match($pattern, $nombre);
    if (!$p) {
        echo '<div class="alert alert-danger"><strong>No se pueden Introducir Numeros en el Nombre</div>';
    } else {
        echo '';
    }
}