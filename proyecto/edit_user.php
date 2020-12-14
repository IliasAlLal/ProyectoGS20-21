<?php
session_start();
if(empty($_REQUEST['id'])){// verifica si en la url hay un id
	header("location: index.php");//si no lo hay nada  te manda al index
} 
else{
	//si hay un id lo guarda en una variable
	$idusuario = $_REQUEST['id'];
	//conexion a la base de datois
	include 'conexion.php';

	//verifica si le hemso dado al boton de aceptar
	if(!empty($_POST)){
		$alert='';
		if(empty($_POST['usarionombre']) || empty($_POST['emailusu']) || empty($_POST['contrausu']) || empty($_POST['telefonousu']) ) {
			$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
		} else{
			//recogemos el valor del formulario.
			$idusuario = $_POST['idusuario']; 
			$usarionombre = $_POST['usarionombre'];
			$nombre = $_POST['nombre']; 
			$emailusu = $_POST['emailusu']; 
			$contrausu = $_POST['contrausu']; 
			$telefonousu = $_POST['telefonousu'];
			$sql = "UPDATE usuario SET Usuario='$usarionombre', Email='$emailusu', Contrasena='$contrausu', Telefono='$telefonousu',Nombre='$nombre', Apellidos='apellido' WHERE ID='$idusuario'";
			$result = $conn->query($sql);
			if($result){
				$alert = "<div class='alert alert-success' role='alert'>
				Usuario actualizado correctamente. <a href='index.php'> Volver</a>
				</div>";
			} else{
				echo"Error al Editar";
			}
		}
	}
	$sql = "SELECT * FROM Usuario WHERE ID='$idusuario'"; //se realiza otra query para mostrar los datos del usuario en el formulario y se guarda en una variable
	
	 $result = mysqli_query($conn, $sql);  //esta es otra forma de realizar $conn->query 
	 $result1 =mysqli_num_rows($result); //función devuelve el número de filas de la querry 

	 if($result1>0){ //valida si existe algun usuario con el id de la url
	 	while ($data = mysqli_fetch_array($result)) { //devuelve el resultado de las tablas en array para que podamos trabajar con los datos
	 		$usuario = $data['Usuario'];
	 		$email = $data['Email'];
	 		$contrasena = $data['Contrasena'];
	 		$telefono = $data['Telefono'];
	 		$nombre1 = $data['Nombre'];
	 		$apellido = $data['Apellidos'];
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
		<title>Editar un usuario</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light shadow ">
			<a class="navbar-brand" href="index.php">
				 <img class="mt-1 mb-1 col-11" width="440" height="200" src="imagenes/kingphone2.png">

			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			</div>
		</nav>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
				<li class="breadcrumb-item active" aria-current="page">Configuracion de Userio</li>
			</ol>
		</nav>
		<div class="container mt-5 shadow-lg p-3 mb-5 bg-white rounded" style="background-color: #F5F5F5;text-align:center;">
			<div class="row">
				<div class="col-12 mt-4">
					<h2>Deseas editar "<span><?php echo $usuario;?></span>"?</h2>
					<div class="row">
						<div class="col-12 mt-4">
							<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

							<form method="POST" action="">
								<!-- esto es para obtener el id del usuario cuando le demos a aceptar y los campos que queramos añadir-->
								<input type="hidden" name="idusuario" value="<?php echo $idusuario?>">
								<div class="form-group row">
									<label for="statictnombre" class="col-sm-2 col-form-label">Usuario</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="usarionombre" value="<?php echo $usuario?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="statictnombre" class="col-sm-2 col-form-label">Nombre</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="nombre" value="<?php echo $nombre1?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="emailusu" value="<?php echo $email?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPassword" class="col-sm-2 col-form-label">Contraeña</label>
									<div class="col-sm-10">
										<input type="text" class="form-control"  value="<?php echo $contrasena?>"name="contrausu"  placeholder="Password">
									</div>
								</div>

								<div class="form-group row">
									<label for="statictelefono" class="col-sm-2 col-form-label">Telefono</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="telefonousu" value="<?php echo $telefono?>">
									</div>
								</div>

								<input type="submit" name="Aceptar" class="btn btn-primary" value="Aceptar">
								<a href="index.php" class="btn btn-danger">Cancelar</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php include 'footer.php'; ?>
		</body>
		</html>