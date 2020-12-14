<?php
$servidor ="mysql:dbname=".BD.";host=".SERVIDOR;
//un metodo try catch para la generacion de errores o excepciones
try{
	//instancia pdo para conectarnos a la bd el array cambiar los valores por defecto "codificacion"
	$pdo = new PDO($servidor, USUARIO, PASSWORD);

		//array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
	
	//echo "<script>alert('Conectado...')</script>";

}catch(PDOException $e){
	//mensaje de error del try catch indica si generado una excepcion
	echo "<script>alert('Error...')</script>";
}
?>