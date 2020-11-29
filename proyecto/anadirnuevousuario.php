<?php
 session_start();

 if (isset($_POST['email']) && $_POST['email'] && isset($_POST['contrasena']) && $_POST['contrasena']) {

    $user = $_POST['usuario'];
    $email = $_POST['email'];
    $pass = $_POST['contrasena'];
    $telefono = $_POST['telefono'];
    $nombre = $_POST['nombre'];


require "conexion.php";

        $sql = "INSERT INTO usuario (Usuario, Email, Contrasena, tipo,Telefono,Nombre,Apellidos,Dirección) VALUES ('$user','$email','$pass','usuario','$telefono','$nombre','vacio','vacio')";
        $result = $conn->query($sql);

        if ($result) {

            echo json_encode(array('success' => 1));

        } else {
            echo json_encode(array('success' => 0));
        }


    $conn->close();

 } 
 else {
    echo json_encode(array('success' => 0));
 }


 ?>