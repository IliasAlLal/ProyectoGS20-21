
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "proyecto";

    // creamos la conexion a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Comprobamos la conexion a la base de datos
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>