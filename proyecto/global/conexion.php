<?php
$servidor ="mysql:dbname=".BD.";host=".SERVIDOR;
try{
	//instancia pdo para conectarnos a la bd.. el array cambiar los valores por default "codificacion"
	$pdo = new PDO($servidor, USUARIO, PASSWORD);

		//array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8")
	
	//echo "<script>alert('Conectado...')</script>";

}catch(PDOException $e){
	echo "<script>alert('Error...')</script>";
}
?>