<?php
header("Content-Type: text/html;charset=utf-8");
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "proyecto";

    // Realiza la conexion a la base de datos
     $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // Comprueba la conexion a la base de datos
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
sleep(1);
//comprueba si el usuario ya existe en la base de datos
if (isset($_POST)) {
    $username = (string)$_POST['usuario'];
 
    $result = $conn->query(
        'SELECT * FROM usuario WHERE Usuario = "'.strtolower($username).'"'
    );
 
    if ($result->num_rows > 0) {
        echo '<div class="alert alert-danger"><strong>Oh no!</strong> Nombre de usuario no disponible.</div>';
    } else {
        echo '';
    }
}