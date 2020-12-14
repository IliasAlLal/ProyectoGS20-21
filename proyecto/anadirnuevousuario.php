<?php
//iniciamos sesion para conservar la sesion anterior
session_start();
//comprobamos si los campos obligatios estan rellenados 
if (isset($_POST['email']) && $_POST['email'] && isset($_POST['contrasena']) && $_POST['contrasena']) {
    //pasamos los datos mediante post
    $user = $_POST['usuario'];
    $email = $_POST['email'];
    $pass = $_POST['contrasena'];
    $telefono = $_POST['telefono'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];

//realizamos la conexion a la base de datos 
    require "conexion.php";
//realiza el insert en la base de datos introduciendo los datos pasados anteriormente y ejecuta la querry
    $sql = "INSERT INTO usuario (Usuario, Email, Contrasena, tipo,Telefono,Nombre,Apellidos,Dirección) VALUES ('$user','$email','$pass','usuario','$telefono','$nombre','$apellido','$direccion')";
    $result = $conn->query($sql);
//comprueba si los datos se an guardado correctamente en la base de dato
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