<?php

if(empty($_REQUEST['id'])){// verifica si en la url hay un id
	header("location: index.php");//si no lo hay nada  te manda al index
} 
else{
	//y si hay un id guarda el id en una variable para poder usarlo
	$idproducto = $_REQUEST['id'];
	//conexion a la base de datos
	include 'conexion.php';

	//verifica si le hemos dado al boton aceptar
	if(!empty($_POST)){
		$alert='';
		if(empty($_POST['nombreproducto']) ||  empty($_POST['precio']) || empty($_POST['descripcion']) ) {
			$alert = '<p class="msg_error">Todos los campos son obligatorios.</p>';
		} else{
			//recogemos el valor del formulario de abajo.
			$idproducto = $_POST['idproducto']; 
			$nombreproducto  = $_POST['nombreproducto'];
			$precio = $_POST['precio']; 
			$descripcion = $_POST['descripcion'];

			$sql = "UPDATE productos SET Nombre='$nombreproducto', Precio='$precio', Descripcion='$descripcion' WHERE ID='$idproducto'";
			$result = $conn->query($sql);
			if($result){
				$alert = "<div class='alert alert-success' role='alert'>
				Producto actualizado correctamente. <a href='index.php'> Volver</a>
				</div>";
			} else{
				echo"Error al Editar";
			}
		}
	}
	$sql = "SELECT * FROM productos WHERE ID='$idproducto'"; //se realiza otra query para mostrar los datos del usuario en el formulario y se guarda en una variable
	
	 $result = mysqli_query($conn, $sql);  //esta es otra forma de realizar $conn->query 
	 $result1 =mysqli_num_rows($result); //función devuelve el número de filas de la querry 

	 if($result1>0){ //valida si existe algun usuario con el id de la url
	 	while ($data = mysqli_fetch_array($result)) { //devuelve el resultado de las tablas en array para que podamos trabajar con los datos
	 		$nombreproducto = $data['Nombre'];
	 		$precio = $data['Precio'];
	 		$descripcion = $data['Descripcion'];
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
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="index.php">
				 <img class="mt-1 mb-1 col-11" width="440" height="200" src="imagenes/kingphone2.png">

			</a>


		</nav>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Inicio</a></li>
				<li class="breadcrumb-item active" aria-current="page">Configuracion de Producto</li>
			</ol>
		</nav>
		<div class="container mt-5 shadow-lg p-3 mb-5 bg-white rounded" style="background-color: #F5F5F5;text-align:center;">
			<div class="row">
				<div class="col-12 mt-4">
					<h2>Producto "<span><?php echo $nombreproducto;?></span>"</h2>
					<div class="row">
						<div class="col-12 mt-4">
							<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
							<form enctype="multipart/form-data" method="POST"  action="">
								<!-- esto es para coger el id del usuario cunado le demos a aceptar-->
								<input type="hidden" name="idproducto" value="<?php echo $idproducto?>">
								<div class="form-group row">
									<label for="statictnombre" class="col-sm-2 col-form-label">Producto</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="nombreproducto" value="<?php echo $nombreproducto?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="staticEmail" class="col-sm-2 col-form-label">Precio</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="precio" value="<?php echo $precio?>">
									</div>
								</div>
								<div class="form-group row">
									<label for="inputPassword" class="col-sm-2 col-form-label">Descripcion</label>
									<div class="col-sm-10">
										<input type="text" class="form-control"  value="<?php echo $descripcion?>"name="descripcion"  placeholder="Password">
									</div>
								</div>
								<div class="col-12  mb-2">
                                    <?php echo"<a href='modificar_imagen1.php?id=".$_REQUEST['id']."' class='btn btn-info btn-sm'> Modificar imagen1</a>";?>
                                </div>
                                <div class="col-12  mb-2">
                                    <?php echo"<a href='modificar_imagen2.php?id=".$_REQUEST['id']."' class='btn btn-info btn-sm'> Modificar imagen2</a>";?>
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
			<script src="scripts.js"></script>
		</body>
		</html>