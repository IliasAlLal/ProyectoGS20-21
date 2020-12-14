<?php
//inicia sesion 
session_start();
//cierra las sesiones de usuario y de carrito
unset($_SESSION['user']);
unset($_SESSION['CARRITO']);
//te devuelve al index
header("Location: index.php");
?>