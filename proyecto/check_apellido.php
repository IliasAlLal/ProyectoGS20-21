<?php
header("Content-Type: text/html;charset=utf-8");
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "proyecto";

    // Creamos la Conexion a la base de datos
     $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // comprobamos la conexion de la base de datos
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
sleep(1);
//comprobamos el texto de apeliido que no haya tenga ninguna numero en el apellido
if (isset($_POST)) {
    $apellido = $_POST['apellido'];
    $pattern = "/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/";
    $p = preg_match($pattern, $apellido);
    if (!$p) {
        echo '<div class="alert alert-danger"><strong>No se pueden Introducir Numeros en el Apellido</div>';
    } else {
        echo '';
    }
}