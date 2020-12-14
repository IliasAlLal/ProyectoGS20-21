<?php
header("Content-Type: text/html;charset=utf-8");
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "proyecto";

    // Crea la conexion a la base de datos 
     $conn = new mysqli($servername, $username, $password, $dbname);
    $conn->set_charset("utf8");
    // Comprueba la conexion a la base de datos 
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
     }
sleep(1);
//compueba si existe el email en la base de datos
if (isset($_POST)) {
    $email = (string)$_POST['email'];
 
    $result = $conn->query(
        'SELECT * FROM usuario WHERE Email = "'.strtolower($email).'"'
    );
 
    if ($result->num_rows > 0) {
        echo '<div class="alert alert-danger"><strong>Oh no!</strong> Email ya exixte</div>';
    } else {
        echo '';
    }
}