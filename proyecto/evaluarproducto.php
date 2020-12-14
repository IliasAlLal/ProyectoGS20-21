<?php
//inicializa la sesion anterior
session_start();
 //realiza la conexion a la base de datos 
require "conexion.php";
//guarda los datos pasados mediante post
$usuario = $_POST['usuariol'];
$publicacion = $_POST['postl'];
$nota = $_POST['rating'];
//ejecuta el insert en la base de datos
$insertComent = $conn->query("INSERT INTO likes (usuario,post,fecha,rango) VALUES ('$usuario', '$publicacion',now(),'$nota')");
//verifica si se realiza la querry 
 if ($insertComent) {


           echo json_encode(array('success' => 1));

        } else {
            echo json_encode(array('success' => 0));
        }
?>