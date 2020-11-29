<?php
//Si existe una id en la url... luego verificamos si esa id la tiene un usuario y la mostramos por pantalla


if(empty($_REQUEST['id'])){
	header("location: index.php");
} else{
	$idusuario = $_REQUEST['id'];
	include 'conexion.php';


	if(!empty($_POST)){ //si le damos al boton aceptar
	$idusuario = $_POST['idusuario']; //recogemos el valor del formulario...metodo rapido para recoger el id del usuario
	$sql = "DELETE FROM Usuario WHERE ID='$idusuario'";
	//$sqlpubli = "DELETE FROM publicaciones WHERE user='$idusuario'"; //tambn borra las publicaciones que tiene

	//hay que borrar mas


    $result = $conn->query($sql);
    if($result){
    	header("location:index.php");
    } else{
    	echo"Error al eliminar";
    }
}

	$sql = "SELECT * FROM Usuario WHERE ID='$idusuario'"; //el idusuario es para comprobar si existe uno en la tabla
	
	 $result = mysqli_query($conn, $sql);  //se hace la consulta
	 $result1 =mysqli_num_rows($result); //nos devuelve una cantidad de filas

	 if($result1>0){ //validamos si nos ha dado esa cantidad de filas
	 	while ($data = mysqli_fetch_array($result)) { //devuelve el resultado de las tablas en array para que podamos trabajar con los datos
	 		$nombre = $data['Usuario'];
	 	}
	 }else{
	 	header("location: index.php");
	 }
	}
	?>

	<!DOCTYPE html>
	<html>
	<head>

		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<meta charset="utf-8">
		<title>Eliminar un usuario</title>
	</head>
	<body>
		<div class="container mt-5 shadow-lg p-3 mb-5 bg-white rounded" style="background-color: #F5F5F5;text-align:center;">
			<div class="row">
				<div class="col-12 mt-4">
					<h2>Estas seguro de eliminar el siguiente usuario "<span><?php echo $nombre;?></span>"?</h2>
					<div class="row">
						<div class="col-12 mt-4">
							<form method="POST" action="">
								<!-- esto es para pillar el id del usuario cunado le demos a aceptar-->
								<input type="hidden" name="idusuario" value="<?php echo $idusuario?>">
								<input type="submit" name="Aceptar" class="btn btn-primary" value="Aceptar">
								<a href="index.php" class="btn btn-danger">Cancelar</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</body>
		</html>