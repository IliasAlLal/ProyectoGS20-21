<?php
//Iniciamos sesion para conservar la sesion
session_start();
 //hacemos un require para poder usar la base de datos 
require "conexion.php";
//pasamos los datos mediante post para poder usar los datos de la pagina anterior 
$usuario = $_POST['usuario'];;
$comentario = $_POST['comentario'];;
$publicacion = $_POST['publicacion'];;
//hacemos el inssert en la base de datos para guardar los datos 
$insertComent = $conn->query("INSERT INTO comentarios (usuario,comentario,fecha,publicacion) VALUES ('$usuario', '$comentario',now(), '$publicacion')");


?>