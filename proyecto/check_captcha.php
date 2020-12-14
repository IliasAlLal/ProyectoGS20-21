<?php
//inicia sesion para tener los datos anteriormente añadido 
session_start();
//añades  la base de datos 
     require "conexion.php";
//comprueba si los campos del captcha son iguales lo que el usuario introduce 
if (isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['digit']){ 
         $captcha = (string)$_POST['captcha'];


    } else {
        echo '<div class="alert alert-danger"><strong>Oh no!</strong> Captcha erroneo</div>';
    }
?>