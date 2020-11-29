<?php
session_start();
     require "conexion.php";

if (isset($_POST['captcha']) && $_POST['captcha'] == $_SESSION['digit']){ 
         $captcha = (string)$_POST['captcha'];


    } else {
        echo '<div class="alert alert-danger"><strong>Oh no!</strong> Captcha erroneo</div>';
    }
?>